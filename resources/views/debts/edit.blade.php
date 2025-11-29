@extends('layouts.finance')

@section('title', 'Edit Hutang/Piutang')

@section('content')
<div>
    <h1 class="page-title">Edit Hutang/Piutang</h1>
    <p class="page-subtitle">Halaman untuk mengedit data hutang atau piutang</p>

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Form Edit Hutang/Piutang</h2>
            <a href="{{ route('debts.index') }}" class="btn btn-secondary">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                </svg>
                Kembali
            </a>
        </div>

        <div style="padding: 32px;">
            <form action="{{ route('debts.update', $debt) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Jenis <span style="color: #e53e3e;">*</span>
                        </label>
                        <select name="type" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                            <option value="">Pilih Jenis</option>
                            <option value="debt" {{ old('type', $debt->type) == 'debt' ? 'selected' : '' }}>Hutang</option>
                            <option value="receivable" {{ old('type', $debt->type) == 'receivable' ? 'selected' : '' }}>Piutang</option>
                        </select>
                        @error('type')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Nama Pihak <span style="color: #e53e3e;">*</span>
                        </label>
                        <input type="text" name="party_name" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            value="{{ old('party_name', $debt->party_name) }}"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        @error('party_name')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Nominal <span style="color: #e53e3e;">*</span>
                        </label>
                        <input type="number" name="amount" required step="0.01" min="0"
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            value="{{ old('amount', $debt->amount) }}"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        @error('amount')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Tanggal Jatuh Tempo <span style="color: #e53e3e;">*</span>
                        </label>
                        <input type="date" name="due_date" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            value="{{ old('due_date', $debt->due_date->format('Y-m-d')) }}"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        @error('due_date')
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
                            <option value="pending" {{ old('status', $debt->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ old('status', $debt->status) == 'paid' ? 'selected' : '' }}>Lunas</option>
                            <option value="overdue" {{ old('status', $debt->status) == 'overdue' ? 'selected' : '' }}>Terlambat</option>
                        </select>
                        @error('status')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Deskripsi
                        </label>
                        <textarea name="description" rows="3"
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s; resize: vertical;"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">{{ old('description', $debt->description) }}</textarea>
                        @error('description')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="margin-top: 32px; display: flex; gap: 12px; justify-content: flex-end;">
                    <a href="{{ route('debts.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
