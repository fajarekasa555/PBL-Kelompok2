<h1 class="page-header">Dashboard</h1>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <!-- TOTAL DOSEN -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card-primary">
            <div class="gradient-overlay"></div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Total Dosen</div>
                        <h3 class="stat-value"><?= $counts['total_members'] ?></h3>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PUBLICATIONS -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card-danger">
            <div class="gradient-overlay"></div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Publications</div>
                        <h3 class="stat-value"><?= $counts['total_publications'] ?></h3>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PROJECTS -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card-success">
            <div class="gradient-overlay"></div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Projects</div>
                        <h3 class="stat-value"><?= $counts['total_projects'] ?></h3>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ACTIVITIES -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card-warning">
            <div class="gradient-overlay"></div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Activities</div>
                        <h3 class="stat-value"><?= $counts['total_activities'] ?></h3>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 1 -->
<div class="row g-4 mb-4">
    <div class="col-xl-8">
        <div class="chart-card">
            <div class="card-header">Publikasi & Projects Overview</div>
            <div class="card-body">
                <canvas id="chartCombined" height="100"></canvas>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="chart-card">
            <div class="card-header">Keahlian Dosen</div>
            <div class="card-body">
                <canvas id="chartExpertise" style="height: 257px;"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 2 -->
<div class="row g-4">
    <div class="col-xl-6">
        <div class="chart-card">
            <div class="card-header">Aktivitas Per Bulan</div>
            <div class="card-body">
                <canvas id="chartActivities"></canvas>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="chart-card">
            <div class="card-header">Publikasi Per Tahun</div>
            <div class="card-body">
                <canvas id="chartPublications"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
const pubYear = <?= json_encode($pubYear) ?>;
const projYear = <?= json_encode($projYear) ?>;
const actMonth = <?= json_encode($actMonth) ?>;
const expertise = <?= json_encode($expertise) ?>;

Chart.defaults.color = '#64748b';

const colors = {
    primary: '#667eea',
    danger: '#f5576c',
    success: '#00d4ff',
    warning: '#fa709a',
    purple: '#764ba2',
    orange: '#fd7e14'
};

// Buat array tahun gabungan agar garis lurus
const allYears = Array.from(new Set([...pubYear.map(p => p.year), ...projYear.map(p => p.year)])).sort();

// Data publikasi & proyek per tahun (0 jika tidak ada)
const pubData = allYears.map(year => {
    const found = pubYear.find(p => p.year == year);
    return found ? found.total : 0;
});
const projData = allYears.map(year => {
    const found = projYear.find(p => p.year == year);
    return found ? found.total : 0;
});

// Combined Line Chart: Publikasi & Projects
new Chart(document.getElementById('chartCombined'), {
    type: 'line',
    data: {
        labels: allYears,
        datasets: [{
            label: 'Publikasi',
            data: pubData,
            borderColor: colors.primary,
            backgroundColor: 'rgba(102, 126, 234, 0.1)',
            fill: true,
            tension: 0.4,
            pointRadius: 5,
            pointHoverRadius: 7,
            pointBackgroundColor: colors.primary
        }, {
            label: 'Projects',
            data: projData,
            borderColor: colors.success,
            backgroundColor: 'rgba(0, 212, 255, 0.1)',
            fill: true,
            tension: 0.4,
            pointRadius: 5,
            pointHoverRadius: 7,
            pointBackgroundColor: colors.success
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        interaction: { intersect: false, mode: 'index' },
        plugins: {
            tooltip: {
                backgroundColor: '#1e293b',
                padding: 12,
                titleColor: '#fff',
                bodyColor: '#fff',
                borderColor: '#334155',
                borderWidth: 1,
                displayColors: true
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: '#f1f5f9', drawBorder: false },
                ticks: { padding: 8, color: '#64748b' }
            },
            x: {
                grid: { display: false, drawBorder: false },
                ticks: { padding: 8, color: '#64748b' }
            }
        }
    }
});

// Expertise Doughnut Chart
new Chart(document.getElementById('chartExpertise'), {
    type: 'doughnut',
    data: {
        labels: expertise.map(e => e.expertise),
        datasets: [{
            data: expertise.map(e => e.total),
            backgroundColor: [colors.primary, colors.success, colors.danger, colors.warning, colors.purple],
            borderWidth: 0,
            hoverOffset: 15
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'left',
                align: 'start',
                labels: {
                    padding: 20,
                    font: { size: 14 }
                }
            },
            tooltip: {
                backgroundColor: '#1e293b',
                padding: 12,
                titleColor: '#fff',
                bodyColor: '#fff'
            }
        },
        cutout: '60%'
    }
});

// Aktivitas Per Bulan Bar Chart
new Chart(document.getElementById('chartActivities'), {
    type: 'bar',
    data: {
        labels: actMonth.map(a => a.month),
        datasets: [{
            label: 'Aktivitas',
            data: actMonth.map(a => a.total),
            backgroundColor: colors.warning,
            borderRadius: 8,
            barPercentage: 0.7
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            tooltip: {
                backgroundColor: '#1e293b',
                padding: 12,
                titleColor: '#fff',
                bodyColor: '#fff'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                suggestedMin: 0,
                suggestedMax: Math.max(...actMonth.map(a => a.total)) * 1.2 || 10,
                grid: { color: '#f1f5f9', drawBorder: false },
                ticks: { padding: 8, color: '#64748b' }
            },
            x: {
                grid: { display: false, drawBorder: false },
                ticks: { padding: 8, color: '#64748b' }
            }
        }
    }
});

new Chart(document.getElementById('chartPublications'), { 
    type: 'bar', 
    data: { 
        labels: pubYear.map(p => p.year), 
        datasets: [{ 
            label: 'Publikasi', 
            data: pubYear.map(p => p.total), 
            backgroundColor: colors.primary, 
            borderRadius: 8, 
            barPercentage: 0.6 }] }, 
            options: { 
                responsive: true, 
                maintainAspectRatio: true, 
                plugins: { 
                    tooltip: { 
                        backgroundColor: '#1e293b', 
                        padding: 12, titleColor: '#fff', 
                        bodyColor: '#fff' 
                        } 
                }, 
                scales: { 
                    y: { 
                        beginAtZero: true, 
                        grid: { color: '#f1f5f9', drawBorder: false }, 
                        ticks: { padding: 8, color: '#64748b' } 
                    }, 
                    x: { 
                        grid: { display: false, drawBorder: false }, 
                        ticks: { padding: 8, color: '#64748b' } 
                    }
                } 
            } 
        });
</script>
