@extends('layouts.finance')

@section('title', 'Tambah Transaksi')

@section('content')
<div>
    <h1 class="page-title">Tambah Transaksi</h1>
    <p class="page-subtitle">Halaman untuk menambah transaksi baru</p>

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Form Tambah Transaksi</h2>
            <a href="{{ request('type') == 'income' ? route('transactions.income') : route('transactions.expense') }}" class="btn btn-secondary">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                </svg>
                Kembali
            </a>
        </div>

        <div style="padding: 32px;">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Judul Transaksi <span style="color: #e53e3e;">*</span>
                        </label>
                        <input type="text" name="title" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            value="{{ old('title') }}"
                            placeholder="Contoh: Pembayaran Gaji, Penjualan Produk"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        @error('title')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Jenis Transaksi <span style="color: #e53e3e;">*</span>
                        </label>
                        <select name="type" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'"
                            onchange="filterCategories(this.value)">
                            <option value="">Pilih Jenis</option>
                            <option value="income" {{ old('type', request('type')) == 'income' ? 'selected' : '' }}>Kas Masuk (Pendapatan)</option>
                            <option value="expense" {{ old('type', request('type')) == 'expense' ? 'selected' : '' }}>Kas Keluar (Pengeluaran)</option>
                        </select>
                        @error('type')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Kategori <span style="color: #e53e3e;">*</span>
                        </label>
                        <select name="category_id" required id="categorySelect"
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-type="{{ $category->type }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }} {{ $category->sub_category ? '(' . $category->sub_category . ')' : '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Rekening <span style="color: #e53e3e;">*</span>
                        </label>
                        <select name="account_id" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                            <option value="">Pilih Rekening</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}" {{ old('account_id') == $account->id ? 'selected' : '' }}>
                                    {{ $account->name }} (Saldo: Rp. {{ number_format($account->balance, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                        @error('account_id')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Nominal <span style="color: #e53e3e;">*</span>
                        </label>
                        <input type="number" name="amount" required step="0.01" min="0"
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            value="{{ old('amount') }}"
                            placeholder="0"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        @error('amount')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Tanggal Transaksi <span style="color: #e53e3e;">*</span>
                        </label>
                        <input type="date" name="transaction_date" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            value="{{ old('transaction_date', date('Y-m-d')) }}"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        @error('transaction_date')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Deskripsi
                        </label>
                        <textarea name="description" rows="3"
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s; resize: vertical;"
                            placeholder="Deskripsi transaksi (opsional)"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">{{ old('description') }}</textarea>
                        @error('description')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="margin-top: 32px; display: flex; gap: 12px; justify-content: flex-end;">
                    <a href="{{ request('type') == 'income' ? route('transactions.income') : route('transactions.expense') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function filterCategories(type) {
    const categorySelect = document.getElementById('categorySelect');
    const options = categorySelect.querySelectorAll('option');
    
    options.forEach(option => {
        if (option.value === '') {
            option.style.display = 'block';
            return;
        }
        
        const optionType = option.getAttribute('data-type');
        if (type === '' || optionType === type) {
            option.style.display = 'block';
        } else {
            option.style.display = 'none';
        }
    });
    
    // Reset selection if current selection is hidden
    const selectedOption = categorySelect.options[categorySelect.selectedIndex];
    if (selectedOption && selectedOption.style.display === 'none') {
        categorySelect.value = '';
    }
}

// Filter on page load
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.querySelector('select[name="type"]');
    if (typeSelect.value) {
        filterCategories(typeSelect.value);
    }
});
</script>
@endsection
