@extends('layouts.finance')

@section('title', 'Invoice')

@section('content')
<div>
    <h1 class="page-title">Invoice Management</h1>
    <p class="page-subtitle">Halaman untuk mengelola invoice</p>

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Data Invoice</h2>
            <a href="#" class="btn btn-primary">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                Tambah Invoice
            </a>
        </div>

        <div style="padding: 100px; text-align: center; color: #a0aec0;">
            <svg width="64" height="64" fill="currentColor" viewBox="0 0 20 20" style="margin: 0 auto 16px;">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
            </svg>
            <p>Invoice management coming soon</p>
        </div>
    </div>
</div>
@endsection
