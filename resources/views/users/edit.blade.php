@extends('layouts.finance')

@section('title', 'Edit Pengguna')

@section('content')
<div>
    <h1 class="page-title">Edit Pengguna</h1>
    <p class="page-subtitle">Halaman untuk mengedit pengguna</p>

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Form Edit Pengguna</h2>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                </svg>
                Kembali
            </a>
        </div>

        <div style="padding: 32px;">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Nama Lengkap <span style="color: #e53e3e;">*</span>
                        </label>
                        <input type="text" name="full_name" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            value="{{ old('full_name', $user->full_name) }}"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        @error('full_name')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Username <span style="color: #e53e3e;">*</span>
                        </label>
                        <input type="text" name="name" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            value="{{ old('name', $user->name) }}"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        @error('name')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Email <span style="color: #e53e3e;">*</span>
                        </label>
                        <input type="email" name="email" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            value="{{ old('email', $user->email) }}"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        @error('email')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Nomor Telepon
                        </label>
                        <input type="text" name="phone" 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            value="{{ old('phone', $user->phone) }}"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        @error('phone')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Password <small>(Kosongkan jika tidak ingin mengubah)</small>
                        </label>
                        <input type="password" name="password" 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        @error('password')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Role <span style="color: #e53e3e;">*</span>
                        </label>
                        <select name="role" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                            <option value="">Pilih Role</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="finance" {{ old('role', $user->role) == 'finance' ? 'selected' : '' }}>Finance</option>
                        </select>
                        @error('role')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Status <span style="color: #e53e3e;">*</span>
                        </label>
                        <select name="status" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                            <option value="">Pilih Status</option>
                            <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="margin-top: 32px; display: flex; gap: 12px; justify-content: flex-end;">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
