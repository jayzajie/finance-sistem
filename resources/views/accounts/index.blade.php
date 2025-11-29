@extends('layouts.finance')

@section('title', 'Manajemen Rekening')

@section('content')
<div>
    <h1 class="page-title">Rekening Perusahaan</h1>
    <p class="page-subtitle">Halaman untuk mengelola rekening perusahaan</p>

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Data Rekening</h2>
            <div style="display: flex; gap: 12px;">
                <input type="text" placeholder="Cari Rekening" style="padding: 10px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px;">
                <a href="{{ route('accounts.create') }}" class="btn btn-primary">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Tambah Rekening
                </a>
            </div>
        </div>

        <div style="padding: 20px 24px; background: #f7fafc; border-bottom: 1px solid #e2e8f0;">
            <div style="font-size: 14px; color: #718096; margin-bottom: 4px;">Total Kas Masuk</div>
            <div style="font-size: 24px; font-weight: 700; color: #1a202c;">Rp. {{ number_format($totalBalance, 0, ',', '.') }}</div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Saldo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($accounts as $index => $account)
                <tr>
                    <td>{{ $accounts->firstItem() + $index }}</td>
                    <td>{{ $account->name }}</td>
                    <td>Rp. {{ number_format($account->balance, 0, ',', '.') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('accounts.edit', $account) }}" class="action-btn" style="background: #dcfce7; color: #166534;" title="Edit">
                                ✏️
                            </a>
                            <form action="{{ route('accounts.destroy', $account) }}" method="POST" style="display: inline;">
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

        <div style="padding: 20px 24px; background: #f7fafc; border-top: 1px solid #e2e8f0;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="font-size: 14px; font-weight: 600; color: #1a202c;">Total</div>
                <div style="font-size: 18px; font-weight: 700; color: #1a202c;">Rp. {{ number_format($totalBalance, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="pagination">
            @for($i = 1; $i <= $accounts->lastPage(); $i++)
                <a href="{{ $accounts->url($i) }}" class="pagination-btn {{ $accounts->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
            @endfor
        </div>
    </div>
</div>
@endsection
