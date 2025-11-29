@extends('layouts.finance')

@section('title', 'Hutang & Piutang')

@section('content')
<div>
    <h1 class="page-title">Hutang & Piutang</h1>
    <p class="page-subtitle">Halaman untuk mengelola hutang dan piutang</p>

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Data Hutang & Piutang</h2>
            <div style="display: flex; gap: 12px;">
                <select style="padding: 10px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px;" onchange="window.location.href='?type='+this.value">
                    <option value="">Semua</option>
                    <option value="debt" {{ request('type') == 'debt' ? 'selected' : '' }}>Hutang</option>
                    <option value="receivable" {{ request('type') == 'receivable' ? 'selected' : '' }}>Piutang</option>
                </select>
                <a href="{{ route('debts.create') }}" class="btn btn-primary">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Tambah Data
                </a>
            </div>
        </div>

        <div style="padding: 20px 24px; background: #f7fafc; border-bottom: 1px solid #e2e8f0; display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
            <div>
                <div style="font-size: 14px; color: #718096; margin-bottom: 4px;">Total Hutang</div>
                <div style="font-size: 24px; font-weight: 700; color: #dc2626;">Rp. {{ number_format($totalDebt, 0, ',', '.') }}</div>
            </div>
            <div>
                <div style="font-size: 14px; color: #718096; margin-bottom: 4px;">Total Piutang</div>
                <div style="font-size: 24px; font-weight: 700; color: #16a34a;">Rp. {{ number_format($totalReceivable, 0, ',', '.') }}</div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis</th>
                    <th>Nama Pihak</th>
                    <th>Nominal</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($debts as $index => $debt)
                <tr>
                    <td>{{ $debts->firstItem() + $index }}</td>
                    <td>
                        @if($debt->type === 'debt')
                            <span class="badge badge-danger">Hutang</span>
                        @else
                            <span class="badge badge-success">Piutang</span>
                        @endif
                    </td>
                    <td>{{ $debt->party_name }}</td>
                    <td>Rp. {{ number_format($debt->amount, 0, ',', '.') }}</td>
                    <td>{{ $debt->due_date->format('d-m-Y') }}</td>
                    <td>
                        @if($debt->status === 'paid')
                            <span class="badge badge-success">Lunas</span>
                        @elseif($debt->status === 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @else
                            <span class="badge badge-danger">Terlambat</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('debts.edit', $debt) }}" class="action-btn" style="background: #dcfce7; color: #166534;" title="Edit">
                                ✏️
                            </a>
                            <form action="{{ route('debts.destroy', $debt) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn" style="background: #fee2e2; color: #991b1b;" title="Delete" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: #a0aec0;">
                        Belum ada data hutang/piutang
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($debts->hasPages())
        <div class="pagination">
            @for($i = 1; $i <= $debts->lastPage(); $i++)
                <a href="{{ $debts->url($i) }}" class="pagination-btn {{ $debts->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
            @endfor
        </div>
        @endif
    </div>
</div>
@endsection
