@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
    <!-- Back Button -->
    <div class="flex items-center mb-8">
        <a href="{{ route('account.index') }}" class="flex items-center gap-2 text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Back to Account</span>
        </a>
    </div>

    <!-- Page Header -->
    <div class="main-content mb-8 m-0">
        <h1 class="card-title mb-6">Transactions</h1>
        <p class="mb-6 text-gray-400">View your recent activity.</p>
    </div>

    <!-- Transactions Table -->
    <div class="table-wrapper">
        <div class="table-overflow">
            <table class="table hidden md:table">
                <thead class="table-head">
                    <tr>
                        <th class="table-header-cell">Date</th>
                        <th class="table-header-cell">Type</th>
                        <th class="table-header-cell">Description</th>
                        <th class="table-header-cell right">Amount</th>
                        <th class="table-header-cell right">Balance After</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr class="table-body-row">
                            <td class="table-body-cell text-gray-300">
                                {{ $transaction->transaction_date->format('Y-m-d H:i:s') }}
                            </td>
                            <td class="table-body-cell">
                                @if ($transaction->type === 'Deposit')
                                    <span class="badge badge-deposit">Deposit</span>
                                @elseif ($transaction->type === 'Withdrawal')
                                    <span class="badge badge-withdrawal">Withdrawal</span>
                                @else
                                    <span class="badge badge-transfer">Transfer</span>
                                @endif
                            </td>
                            <td class="table-body-cell table-cell-muted">
                                {{ $transaction->description ?? '—' }}
                            </td>
                            <td class="table-body-cell right">
                                @if ($transaction->type === 'Deposit')
                                    <span class="amount-positive">+€{{ number_format($transaction->amount, 2) }}</span>
                                @elseif ($transaction->type === 'Withdrawal')
                                    <span class="amount-negative">-€{{ number_format($transaction->amount, 2) }}</span>
                                @else
                                    <span class="amount-neutral">€{{ number_format($transaction->amount, 2) }}</span>
                                @endif
                            </td>
                            <td class="table-body-cell right text-gray-300">
                                €{{ number_format($transaction->balance_after, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="table-empty">No transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
