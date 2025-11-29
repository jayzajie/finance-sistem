@extends('layouts.finance')

@section('title', 'Dashboard')

@section('content')
<div>
    <h1 class="page-title">Selamat Datang Admin</h1>
    <p class="page-subtitle">Halaman dashboard berisi insight & ringkasan data, widget bayar spp.</p>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-label">Pengguna</div>
                <div class="stat-icon" style="background: #e0e7ff; color: #6366f1;">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ $totalUsers }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-label">Kas Masuk</div>
                <div class="stat-icon" style="background: #dcfce7; color: #16a34a;">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ number_format($totalIncome, 0, ',', '.') }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-label">Kas Keluar</div>
                <div class="stat-icon" style="background: #fee2e2; color: #dc2626;">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ number_format($totalExpense, 0, ',', '.') }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-label">Saldo Akhir</div>
                <div class="stat-icon" style="background: #dbeafe; color: #2563eb;">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ number_format($finalBalance, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin-bottom: 32px;">
        <!-- Income Chart -->
        <div class="chart-card">
            <h2 class="chart-title">Kas Masuk</h2>
            <div class="chart-container">
                <canvas id="incomeChart"></canvas>
            </div>
            <div class="chart-legend">
                @foreach($incomeBreakdown as $item)
                <div class="legend-item">
                    <div class="legend-label">
                        <div class="legend-color" style="background: {{ $item['color'] }};"></div>
                        <div class="legend-name">{{ $item['category'] }}</div>
                    </div>
                    <div class="legend-value">
                        <div class="legend-percentage">{{ $item['percentage'] }}%</div>
                        <div class="legend-amount">Rp.{{ number_format($item['amount'], 0, ',', '.') }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Expense Chart -->
        <div class="chart-card">
            <h2 class="chart-title">Kas Keluar</h2>
            <div class="chart-container">
                <canvas id="expenseChart"></canvas>
            </div>
            <div class="chart-legend">
                @foreach($expenseBreakdown as $item)
                <div class="legend-item">
                    <div class="legend-label">
                        <div class="legend-color" style="background: {{ $item['color'] }};"></div>
                        <div class="legend-name">{{ $item['category'] }}</div>
                    </div>
                    <div class="legend-value">
                        <div class="legend-percentage">{{ $item['percentage'] }}%</div>
                        <div class="legend-amount">Rp.{{ number_format($item['amount'], 0, ',', '.') }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Income Chart
    const incomeCtx = document.getElementById('incomeChart').getContext('2d');
    const incomeChart = new Chart(incomeCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($incomeBreakdown->pluck('category')) !!},
            datasets: [{
                data: {!! json_encode($incomeBreakdown->pluck('amount')) !!},
                backgroundColor: {!! json_encode($incomeBreakdown->pluck('color')) !!},
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += 'Rp.' + context.parsed.toLocaleString('id-ID');
                            return label;
                        }
                    }
                }
            },
            cutout: '70%',
        }
    });

    // Expense Chart
    const expenseCtx = document.getElementById('expenseChart').getContext('2d');
    const expenseChart = new Chart(expenseCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($expenseBreakdown->pluck('category')) !!},
            datasets: [{
                data: {!! json_encode($expenseBreakdown->pluck('amount')) !!},
                backgroundColor: {!! json_encode($expenseBreakdown->pluck('color')) !!},
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += 'Rp.' + context.parsed.toLocaleString('id-ID');
                            return label;
                        }
                    }
                }
            },
            cutout: '70%',
        }
    });
</script>
@endpush
@endsection
