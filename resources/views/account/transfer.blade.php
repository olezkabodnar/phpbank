@extends('layouts.app')

@section('title', 'Transfer Funds')

@section('content')
    <!-- User Info Header -->
    <div class="user-info-header">
        <svg class="user-info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
        <span class="text-sm">{{ $account->first_name }} {{ $account->last_name }}</span>
    </div>

    <!-- Transfer Form Card -->
    <div class="card">
        <div class="transfer-header">
            <h2 class="card-title">Transfer Funds</h2>
            <div class="transfer-balance">
                <span class="balance-label">Available Balance:</span>
                <span class="balance-amount">${{ number_format($account->balance, 2) }}</span>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="success-message">
                <div class="success-message-content">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="error-alert">
                <div class="error-alert-content">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <form action="{{ route('account.transfer.process') }}" method="POST" class="transfer-form">
            @csrf
            <input type="hidden" name="transfer_type" value="internal">
            
            <!-- Internal Transfer Fields -->
            <div class="transfer-fields">
                <div class="form-group">
                    <label for="recipient_email" class="form-label">Recipient Email</label>
                    <div class="form-icon-wrapper">
                        <input type="email" id="recipient_email" name="recipient_email" 
                               class="form-input" placeholder="Enter recipient's email address"
                               value="{{ old('recipient_email') }}">
                        <svg class="form-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
            </div>



            <!-- Amount Field -->
            <div class="form-group">
                <label for="amount" class="form-label">Transfer Amount</label>
                <div class="form-icon-wrapper">
                    <input type="number" id="amount" name="amount" step="0.01" min="0.01" 
                           class="form-input" placeholder="0.00"
                           value="{{ old('amount') }}">
                    <svg class="form-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
                <p class="form-helper-text">Minimum transfer amount: €1.00</p>
            </div>

            <!-- Reference/Note Field -->
            <div class="form-group">
                <label for="reference" class="form-label">Reference (Optional)</label>
                <div class="form-icon-wrapper">
                    <input type="text" id="reference" name="reference" 
                           class="form-input" placeholder="Enter reference or note"
                           value="{{ old('reference') }}" maxlength="100">
                    <svg class="form-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <p class="form-helper-text">This will appear on the transaction record</p>
            </div>

            <!-- Submit Button -->
            <div class="form-submit-section">
                <button type="submit" class="btn-primary transfer-submit">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                    Transfer Funds
                </button>
                <a href="{{ route('account.index') }}" class="btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        // Form functionality
        document.addEventListener('DOMContentLoaded', function() {

            // Amount formatting
            const amountInput = document.getElementById('amount');
            amountInput.addEventListener('input', function() {
                let value = this.value;
                
                // Remove any non-digit or decimal point characters
                value = value.replace(/[^\d.]/g, '');
                
                // Ensure only one decimal point
                const parts = value.split('.');
                if (parts.length > 2) {
                    value = parts[0] + '.' + parts.slice(1).join('');
                }
                
                // Limit to 2 decimal places
                if (parts[1] && parts[1].length > 2) {
                    value = parts[0] + '.' + parts[1].substring(0, 2);
                }
                
                this.value = value;
            });

            // Form validation
            const form = document.querySelector('.transfer-form');
            form.addEventListener('submit', function(e) {
                const amount = parseFloat(document.getElementById('amount').value);
                const availableBalance = {{ $account->balance }};

                // Check if amount exceeds balance
                if (amount > availableBalance) {
                    e.preventDefault();
                    alert('Transfer amount cannot exceed your available balance.');
                    return;
                }

                // Validate recipient email
                const recipientEmail = document.getElementById('recipient_email').value.trim();
                if (!recipientEmail) {
                    e.preventDefault();
                    alert('Please enter the recipient\'s email address.');
                    return;
                }
            });
        });
    </script>
@endsection