@extends('layouts.finance')

@section('title', 'Manajemen Kategori')

@section('content')
<div>
    <h1 class="page-title">Kategori Transaksi</h1>
    <p class="page-subtitle">Halaman untuk menambah dan mengelola kategori</p>

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Data Kategori</h2>
            <div style="display: flex; gap: 12px;">
                <select style="padding: 10px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px;" onchange="window.location.href='?type='+this.value">
                    <option value="">Kas Keluar</option>
                    <option value="income">Kas Masuk</option>
                    <option value="expense">Kas Keluar</option>
                </select>
                <input type="text" placeholder="Kategori" style="padding: 10px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px;">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Tambah Kategori
                </a>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Sub Kategori</th>
                    <th>Jenis Kas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $index => $category)
                <tr>
                    <td>{{ $categories->firstItem() + $index }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->sub_category ?? '-' }}</td>
                    <td>
                        @if($category->type === 'income')
                            <span class="badge badge-success">Kas Masuk (Pendapatan)</span>
                        @else
                            <span class="badge badge-danger">Kas Keluar (Biaya)</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('categories.edit', $category) }}" class="action-btn" style="background: #dcfce7; color: #166534;" title="Edit">
                                ✏️
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display: inline;">
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
            @for($i = 1; $i <= $categories->lastPage(); $i++)
                <a href="{{ $categories->url($i) }}" class="pagination-btn {{ $categories->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
            @endfor
        </div>
    </div>
</div>
@endsection
