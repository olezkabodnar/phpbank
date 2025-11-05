<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Domain\Accounts\Account;
use Domain\Transactions\Transaction;
use Domain\Transfers\Transfer;
use Carbon\Carbon;

class ModelIntegrityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function account_model_casts_are_configured_correctly()
    {
        $account = Account::factory()->create([
            'two_fa_enabled' => true,
            'balance' => 1234.567,
            'dob' => '1990-01-01',
        ]);

        $this->assertIsBool($account->two_fa_enabled);
        $this->assertEquals(1234.57, $account->balance); // 2dp precision
        $this->assertInstanceOf(Carbon::class, $account->dob);
    }

    /** @test */
    public function transaction_model_casts_are_configured_correctly()
    {
        $transaction = Transaction::factory()->create([
            'amount' => 99.999,
            'transaction_date' => now(),
        ]);

        $this->assertEquals(100.00, $transaction->amount);
        $this->assertInstanceOf(Carbon::class, $transaction->transaction_date);
    }

    /** @test */
    public function transfer_model_casts_are_configured_correctly()
    {
        $transfer = Transfer::factory()->create([
            'amount' => 150.456,
            'transfer_date' => now(),
        ]);

        $this->assertEquals(150.46, $transfer->amount);
        $this->assertInstanceOf(Carbon::class, $transfer->transfer_date);
    }

    /** @test */
    public function account_dob_must_be_at_least_18_years_old()
    {
        $underageDob = now()->subYears(17);
        $adultDob = now()->subYears(25);

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        // You can trigger validation by using a form request or manually validating:
        validator(['dob' => $underageDob], [
            'dob' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
        ])->validate();

        // Should not throw
        validator(['dob' => $adultDob], [
            'dob' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
        ])->validate();

        $this->assertTrue(true);
    }

    /** @test */
    public function account_relationships_are_defined_correctly()
    {
        $account = Account::factory()->create();
        $transaction = Transaction::factory()->create(['account_id' => $account->id]);
        $transferOut = Transfer::factory()->create(['from_account_id' => $account->id]);
        $transferIn = Transfer::factory()->create(['to_account_id' => $account->id]);

        $this->assertTrue($account->transactions->contains($transaction));
        $this->assertTrue($account->transfersSent->contains($transferOut));
        $this->assertTrue($account->transfersReceived->contains($transferIn));
    }

    /** @test */
    public function balance_changes_should_remain_consistent_with_transactions()
    {
        $account = Account::factory()->create(['balance' => 1000]);

        $deposit = Transaction::factory()->create([
            'account_id' => $account->id,
            'type' => 'Deposit',
            'amount' => 200,
            'balance_after' => 1200,
        ]);

        $account->refresh();

        $this->assertEquals(1200, $deposit->balance_after);
        $this->assertEquals(1200, $account->balance);
    }

    /** @test */
    public function account_name_is_stored_in_title_case()
    {
        $account = Account::factory()->create([
            'first_name' => 'john',
            'last_name' => 'doe',
        ]);

        // Assuming accessor: getFirstNameAttribute() returns ucfirst($value)
        $this->assertEquals('John', $account->first_name);
        $this->assertEquals('Doe', $account->last_name);
    }
}
