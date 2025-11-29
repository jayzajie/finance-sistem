@extends('layouts.finance')

@section('title', 'Laporan Keuangan')

@section('content')
<div>
    <h1 class="page-title">Rekapitulasi Laporan</h1>
    <p class="page-subtitle">Halaman untuk melihat laporan keuangan</p>

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Laporan Keuangan</h2>
            <div style="display: flex; gap: 12px;">
                <button class="btn btn-secondary">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                    </svg>
                    Export PDF
                </button>
                <button class="btn btn-secondary">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                    </svg>
                    Export Excel
                </button>
            </div>
        </div>

        <div style="padding: 100px; text-align: center; color: #a0aec0;">
            <svg width="64" height="64" fill="currentColor" viewBox="0 0 20 20" style="margin: 0 auto 16px;">
                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
            </svg>
            <p>Financial reports coming soon</p>
        </div>
    </div>
</div>
@endsection
