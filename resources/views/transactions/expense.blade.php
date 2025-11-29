@extends('layouts.finance')

@section('title', 'Data Kas Keluar')

@section('content')
<div>
    <h1 class="page-title">Data Kas Keluar</h1>
    <p class="page-subtitle">Halaman untuk mengelola dan menambahkan kas keluar</p>

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Transaksi Kas Keluar</h2>
            <div style="display: flex; gap: 12px;">
                <a href="{{ route('transactions.create') }}?type=expense" class="btn btn-primary">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Tambah Kas Keluar
                </a>
                <button class="btn btn-secondary">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"/>
                    </svg>
                    Filter Rentang Tanggal
                </button>
                <input type="text" placeholder="Cari Data Kas Keluar" style="padding: 10px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px;">
            </div>
        </div>

        <div style="padding: 20px 24px; background: #f7fafc; border-bottom: 1px solid #e2e8f0;">
            <div style="font-size: 14px; color: #718096; margin-bottom: 4px;">Total Kas Keluar</div>
            <div style="font-size: 24px; font-weight: 700; color: #1a202c;">Rp. {{ number_format($totalExpense, 0, ',', '.') }}</div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Rekening</th>
                    <th>Nominal</th>
                    <th>Tanggal Keluar</th>
                    <th>Nama Penerima</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $index => $transaction)
                <tr>
                    <td>{{ $transactions->firstItem() + $index }}</td>
                    <td>{{ $transaction->title }}</td>
                    <td>{{ $transaction->category->name }}</td>
                    <td>{{ $transaction->account->name }}</td>
                    <td>Rp. {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                    <td>{{ $transaction->transaction_date->format('d-m-Y') }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="action-btn" style="background: #fef3c7; color: #92400e;" title="View">
                                👁️
                            </button>
                            <a href="{{ route('transactions.edit', $transaction) }}" class="action-btn" style="background: #dcfce7; color: #166534;" title="Edit">
                                ✏️
                            </a>
                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn" style="background: #fee2e2; color: #991b1b;" title="Delete" onclick="return confirm('Are you sure?')">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            @for($i = 1; $i <= $transactions->lastPage(); $i++)
                <a href="{{ $transactions->url($i) }}" class="pagination-btn {{ $transactions->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
            @endfor
        </div>
    </div>
</div>
@endsection
