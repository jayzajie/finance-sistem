@extends('layouts.finance')

@section('title', 'Manajemen Pengguna')

@section('content')
<div>
    <h1 class="page-title">Pengguna</h1>
    <p class="page-subtitle">Halaman untuk mengelola pengguna</p>

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Data Pengguna</h2>
            <div style="display: flex; gap: 12px;">
                <input type="text" placeholder="Cari Pengguna" style="padding: 10px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px;">
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Tambah Pengguna
                </a>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                <tr>
                    <td>{{ $users->firstItem() + $index }}</td>
                    <td>{{ $user->full_name ?? $user->name }}</td>
                    <td>{{ explode('@', $user->email)[0] }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->status === 'active')
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Non Aktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="action-btn" style="background: #fef3c7; color: #92400e;" title="View">
                                👁️
                            </button>
                            <a href="{{ route('users.edit', $user) }}" class="action-btn" style="background: #dbeafe; color: #1e40af;" title="Edit">
                                ✏️
                            </a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;">
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
            @for($i = 1; $i <= $users->lastPage(); $i++)
                <a href="{{ $users->url($i) }}" class="pagination-btn {{ $users->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
            @endfor
        </div>
    </div>
</div>
@endsection
