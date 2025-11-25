@extends('layouts.adminapp')

@section('title', 'Kunjungan Harian')

@section('content')
<style>
    :root {
        --primary-blue: #013e7e;
        --secondary-blue: #0056b3;
        --accent-blue: #007bff;
        --text-white: #ffffff;
        --text-light: rgba(255,255,255,0.9);
        --shadow: 0 4px 15px rgba(0,0,0,0.1);
        --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        --steel-gray: #4a5568;
        --dark-steel: #2d3748;
        --light-steel: #718096;
        --warning-orange: #ff8c00;
        --success-green: #38a169;
        --industrial-yellow: #ffc107;
        --carbon-black: #1a202c;
        --metallic-silver: #e2e8f0;
    }

    body {
        background: linear-gradient(135deg, var(--metallic-silver) 0%, #f7fafc 100%);
        font-family: 'Poppins', sans-serif;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: var(--text-white);
        padding: 2rem 0;
        margin: -2rem -2rem 2rem -2rem;
        border-radius: 0 0 20px 20px;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 2px,
            rgba(255, 255, 255, 0.05) 2px,
            rgba(255, 255, 255, 0.05) 4px
        );
        pointer-events: none;
    }

    .page-header h1 {
        margin: 0;
        font-weight: 700;
        font-size: 2.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 1;
    }

    .industrial-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: none;
        border-radius: 16px;
        box-shadow: 
            0 8px 32px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.8);
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
    }

    .industrial-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--warning-orange) 0%, var(--accent-blue) 100%);
        transition: var(--transition);
    }

    .industrial-card:hover {
        transform: translateY(-4px);
        box-shadow: 
            0 16px 48px rgba(0, 0, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.8);
    }

    .industrial-card:hover::before {
        width: 8px;
    }

    .card-title {
        color: var(--dark-steel);
        font-weight: 600;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.25rem;
    }

    .card-title i {
        background: linear-gradient(135deg, var(--warning-orange), rgba(255, 140, 0, 0.8));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 1.5rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: var(--text-white);
        padding: 2rem;
        border-radius: 16px;
        text-align: center;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
        border: 2px solid transparent;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 10px,
            rgba(255, 255, 255, 0.03) 10px,
            rgba(255, 255, 255, 0.03) 12px
        );
        pointer-events: none;
    }

    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        border-color: var(--warning-orange);
        box-shadow: 0 20px 40px rgba(1, 62, 126, 0.3);
    }

    .stat-card h3 {
        font-size: 3rem;
        font-weight: 800;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        background: linear-gradient(45deg, var(--text-white), var(--warning-orange));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-card p {
        margin: 0.5rem 0 0 0;
        font-weight: 600;
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .stat-card small {
        opacity: 0.7;
        font-size: 0.9rem;
    }

    .filter-section {
        background: linear-gradient(135deg, var(--carbon-black) 0%, var(--dark-steel) 100%);
        color: var(--text-white);
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .filter-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: repeating-linear-gradient(
            90deg,
            transparent,
            transparent 50px,
            rgba(255, 140, 0, 0.05) 50px,
            rgba(255, 140, 0, 0.05) 52px
        );
        pointer-events: none;
    }

    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        align-items: end;
        position: relative;
        z-index: 1;
    }

    .form-group {
        flex: 1;
        min-width: 200px;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--text-light);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form-group select,
    .form-group input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-white);
        font-size: 1rem;
        backdrop-filter: blur(10px);
        transition: var(--transition);
    }

    .form-group select:focus,
    .form-group input:focus {
        outline: none;
        border-color: var(--warning-orange);
        box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.2);
        background: rgba(255, 255, 255, 0.15);
    }

    .form-group select option {
        background: var(--dark-steel);
        color: var(--text-white);
    }

    .industrial-btn {
        background: linear-gradient(135deg, var(--warning-orange) 0%, rgba(255, 140, 0, 0.8) 100%);
        border: none;
        color: var(--text-white);
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        min-width: 150px;
    }

    .industrial-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .industrial-btn:hover::before {
        left: 100%;
    }

    .industrial-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 140, 0, 0.4);
    }

    .chart-container {
        background: var(--text-white);
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 1.5rem;
        height: 400px;
        box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .data-table {
        background: var(--text-white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    }

    .data-table table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .data-table th {
        background: linear-gradient(135deg, var(--dark-steel) 0%, var(--steel-gray) 100%);
        color: var(--text-white);
        padding: 1rem;
        font-weight: 600;
        text-align: left;
        border: none;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .data-table td {
        padding: 1rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        color: var(--dark-steel);
        font-weight: 500;
    }

    .data-table tr:hover {
        background: linear-gradient(90deg, rgba(255, 140, 0, 0.05), transparent);
    }

    .no-data {
        text-align: center;
        padding: 3rem;
        color: var(--light-steel);
        font-style: italic;
    }

    .recent-visits-table {
        background: var(--text-white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    }

    .recent-visits-table table {
        width: 100%;
        table-layout: fixed;
    }

    .recent-visits-table th {
        padding: 1.5rem 1rem;
        font-size: 0.85rem;
        white-space: nowrap;
    }

    .recent-visits-table td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        word-wrap: break-word;
    }

    .recent-visits-table th:nth-child(1),
    .recent-visits-table td:nth-child(1) {
        width: 8%;
        text-align: center;
    }

    .recent-visits-table th:nth-child(2),
    .recent-visits-table td:nth-child(2) {
        width: 25%;
    }

    .recent-visits-table th:nth-child(3),
    .recent-visits-table td:nth-child(3) {
        width: 20%;
    }

    .recent-visits-table th:nth-child(4),
    .recent-visits-table td:nth-child(4) {
        width: 22%;
    }

    .recent-visits-table th:nth-child(5),
    .recent-visits-table td:nth-child(5) {
        width: 15%;
        text-align: center;
    }

    .recent-visits-table .user-info {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        align-items: flex-start;
    }

    .recent-visits-table .user-badge {
        background: linear-gradient(135deg, var(--success-green), rgba(56, 161, 105, 0.8));
        color: var(--text-white);
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        min-width: 80px;
        text-align: center;
    }

    .recent-visits-table .guest-badge {
        background: linear-gradient(135deg, var(--light-steel), rgba(113, 128, 150, 0.8));
        color: var(--text-white);
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        min-width: 80px;
        text-align: center;
    }

    .recent-visits-table .user-id {
        color: var(--light-steel);
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }

    .recent-visits-table .ip-address {
        font-family: 'Courier New', monospace;
        background: rgba(1, 62, 126, 0.1);
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        font-size: 0.85rem;
        color: var(--primary-blue);
        display: inline-block;
    }

    .recent-visits-table .visit-id {
        background: linear-gradient(135deg, var(--warning-orange), rgba(255, 140, 0, 0.8));
        color: var(--text-white);
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .recent-visits-table .visit-time {
        background: rgba(255, 140, 0, 0.1);
        color: var(--warning-orange);
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-block;
    }

    @media (max-width: 768px) {
        .page-header {
            margin: -2rem -1rem 2rem -1rem;
            padding: 1.5rem 1rem;
        }
        
        .page-header h1 {
            font-size: 2rem;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .filter-form {
            flex-direction: column;
        }
        
        .form-group {
            min-width: auto;
        }

        .industrial-card {
            padding: 1.5rem;
        }

        .stat-card h3 {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 480px) {
        .data-table {
            font-size: 0.9rem;
        }
        
        .data-table th,
        .data-table td {
            padding: 0.75rem 0.5rem;
        }

        .chart-container {
            height: 300px;
        }
    }
</style>

<div class="page-header">
    <div class="container-fluid">
        <h1>📊 Statistik Kunjungan</h1>
    </div>
</div>

<!-- Filter Section -->
<div class="filter-section">
    <h3 class="card-title">
        <i class="fas fa-filter"></i>
        <span style="color: var(--text-white);
        ">Filter Periode</span>
    </h3>
    <form method="GET" action="{{ url()->current() }}" class="filter-form">
        <div class="form-group">
            <label for="period">Periode</label>
            <select name="period" id="period" onchange="toggleDateInputs()">
                <option value="daily" {{ ($period ?? 'daily') == 'daily' ? 'selected' : '' }}>Harian</option>
                <option value="monthly" {{ ($period ?? 'daily') == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                <option value="yearly" {{ ($period ?? 'daily') == 'yearly' ? 'selected' : '' }}>Tahunan</option>
            </select>
        </div>
        
        <div class="form-group" id="date-input" style="display: {{ ($period ?? 'daily') == 'daily' ? 'block' : 'none' }}">
            <label for="date">Tanggal</label>
            <input type="date" name="date" id="date" value="{{ $date ?? now()->format('Y-m-d') }}">
        </div>
        
        <div class="form-group" id="month-input" style="display: {{ ($period ?? 'daily') == 'monthly' ? 'block' : 'none' }}">
            <label for="month">Bulan</label>
            <input type="month" name="month" id="month" value="{{ $month ?? now()->format('Y-m') }}">
        </div>
        
        <div class="form-group" id="year-input" style="display: {{ ($period ?? 'daily') == 'yearly' ? 'block' : 'none' }}">
            <label for="year">Tahun</label>
            <select name="year" id="year">
                @for($y = now()->year; $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ ($year ?? now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        
        <div class="form-group">
            <button type="submit" class="industrial-btn">
                <i class="fas fa-search"></i>
                Tampilkan Data
            </button>
        </div>
    </form>
</div>

<!-- Statistics Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <h3>{{ isset($stats) ? number_format($stats['total']) : number_format($totalVisits ?? 0) }}</h3>
        <p>Total Kunjungan</p>
        <small>{{ isset($stats) ? $stats['period_label'] : 'Hari Ini' }}</small>
    </div>
    <div class="stat-card">
        <h3>{{ isset($stats) ? number_format($stats['guests']) : number_format($guestVisits ?? 0) }}</h3>
        <p>Pengunjung Guest</p>
        <small>{{ isset($stats) ? $stats['period_label'] : 'Hari Ini' }}</small>
    </div>
    <div class="stat-card">
        <h3>{{ isset($stats) ? number_format($stats['users']) : number_format($userVisits ?? 0) }}</h3>
        <p>User Login</p>
        <small>{{ isset($stats) ? $stats['period_label'] : 'Hari Ini' }}</small>
    </div>
    <div class="stat-card">
        @php
            $total = isset($stats) ? $stats['total'] : ($totalVisits ?? 0);
            $users = isset($stats) ? $stats['users'] : ($userVisits ?? 0);
            $ratio = $total > 0 ? ($users / $total) * 100 : 0;
        @endphp
        <h3>{{ number_format($ratio, 1) }}%</h3>
        <p>Rasio User/Guest</p>
        <small>{{ isset($stats) ? $stats['period_label'] : 'Hari Ini' }}</small>
    </div>
</div>

<!-- Chart Section -->
<div class="industrial-card">
    <h2 class="card-title">
        <i class="fas fa-chart-line"></i>
        Grafik Kunjungan - {{ isset($stats) ? $stats['period_label'] : 'Hari Ini' }}
    </h2>
    <div class="chart-container">
        <canvas id="visitChart"></canvas>
    </div>
</div>

<!-- Data Table -->
<div class="industrial-card">
    <h2 class="card-title">
        <i class="fas fa-table"></i>
        Data Kunjungan - {{ isset($stats) ? $stats['period_label'] : 'Hari Ini' }}
    </h2>
    <div class="data-table">
        <table>
            <thead>
                <tr>
                    @if(($period ?? 'daily') == 'daily')
                        <th>Tanggal</th>
                        <th>Hari</th>
                    @elseif(($period ?? 'daily') == 'monthly')
                        <th>Bulan</th>
                    @else
                        <th>Tahun</th>
                    @endif
                    <th>Total Kunjungan</th>
                    <th>Guest</th>
                    <th>User Login</th>
                    <th>Rasio User/Guest</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($tableData) && count($tableData) > 0)
                    @foreach($tableData as $data)
                    <tr>
                        @if(($period ?? 'daily') == 'daily')
                            <td>{{ $data->formatted_date }}</td>
                            <td>{{ $data->day_name }}</td>
                        @elseif(($period ?? 'daily') == 'monthly')
                            <td>{{ $data->formatted_month }}</td>
                        @else
                            <td>{{ $data->year }}</td>
                        @endif
                        <td><strong>{{ number_format($data->total) }}</strong></td>
                        <td>{{ number_format($data->guests) }}</td>
                        <td>{{ number_format($data->users) }}</td>
                        <td>{{ $data->total > 0 ? number_format(($data->users / $data->total) * 100, 1) : 0 }}%</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="{{ ($period ?? 'daily') == 'daily' ? 6 : 5 }}" class="no-data">
                            <i class="fas fa-inbox"></i><br>
                            Tidak ada data untuk periode yang dipilih
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Recent Visits -->
<div class="industrial-card">
    <h2 class="card-title">
        <i class="fas fa-clock"></i>
        Kunjungan Terbaru (10 Terakhir)
    </h2>
    <div class="recent-visits-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>IP Address</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentVisits as $visit)
                <tr>
                    <td><span class="visit-id">#{{ $visit->id }}</span></td>
                    <td>
                        <div class="user-info">
                            @if($visit->user_name)
                                <span class="user-badge">{{ $visit->user_name }}</span>
                                <div class="user-id">ID: {{ $visit->user_id }}</div>
                            @else
                                <span class="guest-badge">Guest</span>
                            @endif
                        </div>
                    </td>
                    <td><span class="ip-address">{{ $visit->ip_address }}</span></td>
                    <td>{{ $visit->visit_date }}</td>
                    <td><span class="visit-time">{{ \Carbon\Carbon::parse($visit->created_at)->format('H:i:s') }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="no-data">
                        <i class="fas fa-user-slash"></i><br>
                        Belum ada kunjungan yang tercatat
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    console.log('=== DEBUG INFO ===');
    console.log('Period:', @json($period ?? 'not set'));
    console.log('Chart Data Raw:', @json($chartData ?? []));
    console.log('Table Data Raw:', @json($tableData ?? []));
    
    @if(isset($chartData) && isset($period))
        console.log('Chart Data Available:', {{ count($chartData) }}, 'items');
        
        // Chart configuration
        const ctx = document.getElementById('visitChart').getContext('2d');
        const chartData = @json($chartData ?? []);
        console.log('Processed Chart Data:', chartData);
        
        let labels = [];
        let data = [];
        
        @if(($period ?? 'daily') == 'daily')
            console.log('Processing DAILY chart data');
            // Hours 0-23
            for(let i = 0; i < 24; i++) {
                labels.push(i + ':00');
                const found = chartData.find(item => item.hour == i);
                data.push(found ? found.count : 0);
                if(found) console.log(`Hour ${i}: ${found.count} visits`);
            }
        @elseif(($period ?? 'daily') == 'monthly')
            console.log('Processing MONTHLY chart data');
            // Days 1-31
            const daysInMonth = new Date({{ explode('-', $month ?? now()->format('Y-m'))[0] }}, {{ explode('-', $month ?? now()->format('Y-m'))[1] }}, 0).getDate();
            console.log('Days in month:', daysInMonth);
            for(let i = 1; i <= daysInMonth; i++) {
                labels.push(i);
                const found = chartData.find(item => item.day == i);
                data.push(found ? found.count : 0);
                if(found) console.log(`Day ${i}: ${found.count} visits`);
            }
        @else
            console.log('Processing YEARLY chart data');
            // Months 1-12
            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            for(let i = 1; i <= 12; i++) {
                labels.push(monthNames[i-1]);
                const found = chartData.find(item => item.month == i);
                data.push(found ? found.count : 0);
                if(found) console.log(`Month ${i}: ${found.count} visits`);
            }
        @endif
        
        console.log('Final Labels:', labels);
        console.log('Final Data:', data);
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Kunjungan',
                    data: data,
                    borderColor: '#ff8c00',
                    backgroundColor: 'rgba(255, 140, 0, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    pointBackgroundColor: '#ff8c00',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            font: {
                                family: 'Poppins',
                                weight: '600'
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                family: 'Poppins'
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            stepSize: 1,
                            font: {
                                family: 'Poppins'
                            }
                        }
                    }
                }
            }
        });
    @else
        console.log('NO CHART DATA - Creating empty chart');
        const ctx = document.getElementById('visitChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['No Data'],
                datasets: [{
                    label: 'Jumlah Kunjungan',
                    data: [0],
                    borderColor: '#ff8c00',
                    backgroundColor: 'rgba(255, 140, 0, 0.1)',
                    borderWidth: 3,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    @endif
    
    function toggleDateInputs() {
        const period = document.getElementById('period').value;
        const dateInput = document.getElementById('date-input');
        const monthInput = document.getElementById('month-input');
        const yearInput = document.getElementById('year-input');
        
        dateInput.style.display = period === 'daily' ? 'block' : 'none';
        monthInput.style.display = period === 'monthly' ? 'block' : 'none';
        yearInput.style.display = period === 'yearly' ? 'block' : 'none';
    }
    
    console.log('=== END DEBUG ===');
</script>

@endsection