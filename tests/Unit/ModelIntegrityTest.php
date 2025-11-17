<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use App\Models\Transaction;
use App\Models\Transfer;
use Carbon\Carbon;
use App\Models\TwoFACode;
use App\Mail\TwoFACodeMail;
use App\Services\TwoFAService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;


class ModelIntegrityTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function account_model_casts_are_configured_correctly()
    {
        $account = Account::factory()->create([
            'balance' => 1234.567,
            'dob' => '1990-01-01',
        ]);

        $this->assertEquals(1234.57, $account->balance); // 2dp precision
        $this->assertInstanceOf(Carbon::class, $account->dob);
    }

    #[Test]
    public function transaction_model_casts_are_configured_correctly()
    {
        $transaction = Transaction::factory()->create([
            'amount' => 99.999,
            'transaction_date' => now(),
        ]);

        $this->assertEquals(100.00, $transaction->amount);
        $this->assertInstanceOf(Carbon::class, $transaction->transaction_date);
    }

    #[Test]
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

    #[Test]
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

    #[Test]
    public function account_name_is_stored_in_title_case()
    {
        $account = Account::factory()->create([
            'first_name' => 'john',
            'last_name' => 'doe',
        ]);

        $this->assertEquals('John', $account->first_name);
        $this->assertEquals('Doe', $account->last_name);
    }

    #[Test]
    public function it_redirects_to_login_if_no_session_for_index()
    {
        $response = $this->get(route('account.index'));

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error', 'Please login first');
    }

    #[Test]
    public function it_redirects_to_login_if_account_not_found_in_index()
    {
        Session::put('account_id', 9999);

        $response = $this->get(route('account.index'));

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error', 'Account not found');
    }

    #[Test]
    public function it_loads_index_view_with_account_if_logged_in()
    {
        $account = Account::factory()->create();
        Session::put('account_id', $account->account_id);

        $response = $this->get(route('account.index'));

        $response->assertStatus(200);
        $response->assertViewIs('account.index');
        $response->assertViewHas('account', $account);
    }

    #[Test]
    public function it_shows_topup_form_when_logged_in()
    {
        $account = Account::factory()->create();
        Session::put('account_id', $account->account_id);

        $response = $this->get(route('account.topup'));

        $response->assertStatus(200);
        $response->assertViewIs('account.topup');
        $response->assertViewHas('account', $account);
    }

    #[Test]
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

    #[Test]
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

    #[Test]
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

   #[Test]
    public function two_fa_mail_has_expected_envelope_and_content()
    {
        $account = Account::factory()->create(['first_name' => 'John', 'last_name' => 'Doe']);

        $code = TwoFACode::create([
            'account_id' => $account->account_id,
            'code' => '654321',
            'expires_at' => Carbon::now()->addMinutes(10),
            'used' => false,
            'created_at' => Carbon::now(),
        ]);

        $mail = new TwoFACodeMail($code, $account);

        $envelope = $mail->envelope();
        $this->assertEquals('Your PHP Bank Security Code', $envelope->subject);

        $content = $mail->content();
        $this->assertEquals('emails.two-fa-code', $content->view);
        $this->assertArrayHasKey('code', $content->with);
        $this->assertEquals('654321', $content->with['code']);
    }

    #[Test]
    public function account_mutators_and_deposit_work_and_dob_validation_throws()
    {
        $account = Account::factory()->create([
            'first_name' => 'bob',
            'last_name' => 'johnson',
            'balance' => 100.00,
        ]);

        $this->assertEquals('Bob', $account->first_name);
        $this->assertEquals('Johnson', $account->last_name);

        $account->deposit(50, 'Test deposit');
        $this->assertEquals(150.00, $account->balance);
        $this->assertDatabaseHas('transactions', ['account_id' => $account->account_id, 'type' => 'Deposit']);

        // dob setter should throw for underage
        $this->expectException(ValidationException::class);
        $account->dob = now()->subYears(10)->toDateString();
    }

    #[Test]
    public function transaction_and_transfer_casts_are_applied()
    {
        $account = Account::factory()->create(['balance' => 1000]);

        $transaction = Transaction::factory()->create([
            'account_id' => $account->account_id,
            'amount' => 99.999,
            'transaction_date' => now(),
        ]);

        $this->assertEquals(100.00, $transaction->amount);
        $this->assertInstanceOf(\Carbon\Carbon::class, $transaction->transaction_date);

        $recipient = Account::factory()->create();
        $transfer = Transfer::factory()->create([
            'from_account_id' => $account->account_id,
            'to_account_id' => $recipient->account_id,
            'amount' => 150.456,
            'transfer_date' => now(),
        ]);

        $this->assertEquals(150.46, $transfer->amount);
        $this->assertInstanceOf(\Carbon\Carbon::class, $transfer->transfer_date);
        $this->assertEquals($account->account_id, $transfer->sender->account_id);
        $this->assertEquals($recipient->account_id, $transfer->recipient->account_id);
    }

    #[Test]
    public function generate_code_returns_six_digits()
    {
        $code = TwoFACode::generateCode();

        $this->assertIsString($code);
        $this->assertEquals(6, strlen($code));
        $this->assertMatchesRegularExpression('/^\d{6}$/', $code);
    }

    #[Test]
    public function create_for_account_creates_new_code_and_deletes_old()
    {
        $account = Account::factory()->create();

        $first = TwoFACode::createForAccount($account->account_id);
        $this->assertDatabaseHas('two_fa_codes', ['account_id' => $account->account_id, 'code' => $first->code]);

        $second = TwoFACode::createForAccount($account->account_id);
        $this->assertDatabaseHas('two_fa_codes', ['account_id' => $account->account_id, 'code' => $second->code]);
        $this->assertNotEquals($first->code, $second->code);

        $this->assertDatabaseMissing('two_fa_codes', ['id' => $first->id]);
    }

     #[Test]
    public function is_enabled_checks_account_flag()
    {
        $service = new TwoFAService();
        $account = Account::factory()->create(['two_fa_enabled' => false]);

        $this->assertFalse($service->isEnabled($account));

        $account->two_fa_enabled = 'Y';
        $this->assertTrue($service->isEnabled($account));
    }

    #[Test]
    public function enable_and_disable_toggle_flag_and_cleanup()
    {
        $service = new TwoFAService();
        $account = Account::factory()->create(['two_fa_enabled' => false]);

        $this->assertTrue($service->enable($account));
        $this->assertTrue($account->fresh()->two_fa_enabled);

        // create a code to be cleaned up
        TwoFACode::createForAccount($account->account_id);

        $this->assertTrue($service->disable($account));
        $this->assertFalse($account->fresh()->two_fa_enabled);
        $this->assertDatabaseMissing('two_fa_codes', ['account_id' => $account->account_id]);
    }

    #[Test]
    public function send_code_sends_mail_and_returns_true()
    {
        Mail::fake();

        $service = new TwoFAService();
        $account = Account::factory()->create(['email' => 'test@example.com']);

        $result = $service->sendCode($account);

        $this->assertTrue($result);
        Mail::assertSent(TwoFACodeMail::class, function ($mail) use ($account) {
            return $mail->hasTo($account->email);
        });
    }

}
