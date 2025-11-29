@extends('layouts.finance')

@section('title', 'Tambah Rekening')

@section('content')
<div>
    <h1 class="page-title">Tambah Rekening</h1>
    <p class="page-subtitle">Halaman untuk menambah rekening baru</p>

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Form Tambah Rekening</h2>
            <a href="{{ route('accounts.index') }}" class="btn btn-secondary">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                </svg>
                Kembali
            </a>
        </div>

        <div style="padding: 32px;">
            <form action="{{ route('accounts.store') }}" method="POST">
                @csrf
                
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Nama Rekening <span style="color: #e53e3e;">*</span>
                        </label>
                        <input type="text" name="name" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            value="{{ old('name') }}"
                            placeholder="Contoh: BCA, DANA, Uang Tunai"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        @error('name')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Tipe Rekening <span style="color: #e53e3e;">*</span>
                        </label>
                        <select name="account_type" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                            <option value="">Pilih Tipe</option>
                            <option value="cash" {{ old('account_type') == 'cash' ? 'selected' : '' }}>Cash (Tunai)</option>
                            <option value="bank" {{ old('account_type') == 'bank' ? 'selected' : '' }}>Bank</option>
                        </select>
                        @error('account_type')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Saldo Awal <span style="color: #e53e3e;">*</span>
                        </label>
                        <input type="number" name="balance" required step="0.01" min="0"
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            value="{{ old('balance', 0) }}"
                            placeholder="0"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        @error('balance')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Deskripsi
                        </label>
                        <textarea name="description" rows="3"
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s; resize: vertical;"
                            placeholder="Deskripsi rekening (opsional)"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">{{ old('description') }}</textarea>
                        @error('description')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="margin-top: 32px; display: flex; gap: 12px; justify-content: flex-end;">
                    <a href="{{ route('accounts.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
