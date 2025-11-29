@extends('layouts.finance')

@section('title', 'Edit Kategori')

@section('content')
<div>
    <h1 class="page-title">Edit Kategori</h1>
    <p class="page-subtitle">Halaman untuk mengedit kategori</p>

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Form Edit Kategori</h2>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                </svg>
                Kembali
            </a>
        </div>

        <div style="padding: 32px;">
            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Nama Kategori <span style="color: #e53e3e;">*</span>
                        </label>
                        <input type="text" name="name" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            value="{{ old('name', $category->name) }}"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        @error('name')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Sub Kategori
                        </label>
                        <input type="text" name="sub_category" 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            value="{{ old('sub_category', $category->sub_category) }}"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        @error('sub_category')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Jenis Kas <span style="color: #e53e3e;">*</span>
                        </label>
                        <select name="type" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                            <option value="">Pilih Jenis</option>
                            <option value="income" {{ old('type', $category->type) == 'income' ? 'selected' : '' }}>Kas Masuk (Pendapatan)</option>
                            <option value="expense" {{ old('type', $category->type) == 'expense' ? 'selected' : '' }}>Kas Keluar (Biaya)</option>
                        </select>
                        @error('type')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #4a5568; margin-bottom: 8px;">
                            Warna <span style="color: #e53e3e;">*</span>
                        </label>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <input type="color" name="color" required 
                                style="width: 60px; height: 44px; border: 1px solid #e2e8f0; border-radius: 10px; cursor: pointer;"
                                value="{{ old('color', $category->color) }}">
                            <input type="text" name="color_text" readonly
                                style="flex: 1; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; background: #f7fafc;"
                                value="{{ old('color', $category->color) }}"
                                id="colorText">
                        </div>
                        @error('color')
                            <span style="color: #e53e3e; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="margin-top: 32px; display: flex; gap: 12px; justify-content: flex-end;">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelector('input[type="color"]').addEventListener('input', function(e) {
        document.getElementById('colorText').value = e.target.value;
        document.querySelector('input[name="color"]').value = e.target.value;
    });
</script>
@endsection
