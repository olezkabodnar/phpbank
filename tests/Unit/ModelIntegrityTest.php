<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use App\Models\Transaction;
use App\Models\Transfer;
use Carbon\Carbon;

class ModelIntegrityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function account_model_casts_are_configured_correctly()
    {
        $account = Account::factory()->create([
            'balance' => 1234.567,
            'dob' => '1990-01-01',
        ]);

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
        $account = Account::factory()->create();
        $transfer = Transfer::factory()->create([
            'from_account_id' => $account->account_id,
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

        validator(['dob' => $underageDob], [
            'dob' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
        ])->validate();

        validator(['dob' => $adultDob], [
            'dob' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
        ])->validate();

        $this->assertTrue(true);
    }

    // /** @test */
    // public function account_relationships_are_defined_correctly()
    // {
    //     $account = Account::factory()->create();
    //     $transaction = Transaction::factory()->create(['account_id' => $account->id]);
    //     $transferOut = Transfer::factory()->create(['from_account_id' => $account->id]);
    //     $transferIn = Transfer::factory()->create(['to_account_id' => $account->id]);

    //     $this->assertTrue($account->transactions->contains($transaction));
    //     $this->assertTrue($account->transfersSent->contains($transferOut));
    //     $this->assertTrue($account->transfersReceived->contains($transferIn));
    // }

    // /** @test */
    // public function balance_changes_should_remain_consistent_with_transactions()
    // {
    //     $account = Account::factory()->create(['balance' => 1000]);

    //     $deposit = Transaction::factory()->create([
    //         'account_id' => $account->id,
    //         'type' => 'Deposit',
    //         'amount' => 200,
    //         'balance_after' => 1200,
    //     ]);

    //     $account->refresh();

    //     $this->assertEquals(1200, $deposit->balance_after);
    //     $this->assertEquals(1200, $account->balance);
    // }

    /** @test */
    public function account_name_is_stored_in_title_case()
    {
        $account = Account::factory()->create([
            'first_name' => 'john',
            'last_name' => 'doe',
        ]);

        $this->assertEquals('John', $account->first_name);
        $this->assertEquals('Doe', $account->last_name);
    }

    /** @test */
    public function it_redirects_to_login_if_no_session_for_index()
    {
        $response = $this->get(route('account.index'));

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error', 'Please login first');
    }

    /** @test */
    public function it_redirects_to_login_if_account_not_found_in_index()
    {
        Session::put('account_id', 9999);

        $response = $this->get(route('account.index'));

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error', 'Account not found');
    }

    /** @test */
    public function it_loads_index_view_with_account_if_logged_in()
    {
        $account = Account::factory()->create();
        Session::put('account_id', $account->account_id);

        $response = $this->get(route('account.index'));

        $response->assertStatus(200);
        $response->assertViewIs('account.index');
        $response->assertViewHas('account', $account);
    }

    /** @test */
    public function it_shows_topup_form_when_logged_in()
    {
        $account = Account::factory()->create();
        Session::put('account_id', $account->account_id);

        $response = $this->get(route('account.topup'));

        $response->assertStatus(200);
        $response->assertViewIs('account.topup');
        $response->assertViewHas('account', $account);
    }

    /** @test */
    public function it_redirects_to_login_if_not_logged_in_for_topup_validation()
    {
        $response = $this->withoutMiddleware()->post(route('account.topup.post'), [
            'amount' => 10,
            'card_name' => 'John Doe',
            'card_number' => '1234567890123456',
            'exp_date' => now()->addYear()->format('m/y'),
            'cvv' => '123',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function it_validates_topup_fields_correctly()
    {
        $account = Account::factory()->create();
        Session::put('account_id', $account->account_id);

        $response = $this->withoutMiddleware()->post(route('account.topup.post'), [
            'amount' => '',
            'card_name' => '1234',
            'card_number' => '1234',
            'exp_date' => '13/99',
            'cvv' => '12',
        ]);

        $response->assertSessionHasErrors([
            'amount', 'card_name', 'card_number', 'exp_date', 'cvv',
        ]);
    }

    /** @test */
    public function it_processes_topup_successfully_and_updates_balance()
    {
        $account = Account::factory()->create(['balance' => 100]);
        Session::put('account_id', $account->account_id);

        $validData = [
            'amount' => 50,
            'card_name' => 'John Doe',
            'card_number' => '1234567890123456',
            'exp_date' => now()->addYear()->format('m/y'),
            'cvv' => '123',
        ];

        $response = $this->withoutMiddleware()->post(route('account.topup.post'), $validData);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $account->refresh();
        $this->assertEquals(150, $account->balance);
    }

    // /** @test */
    // public function it_returns_recover_password_view()
    // {
    //     $response = $this->get(route('password.recovery'));

    //     $response->assertStatus(200);
    //     $response->assertViewIs('account.recover-password');
    // }
}
