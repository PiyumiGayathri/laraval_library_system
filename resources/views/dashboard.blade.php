@extends('layout.app')

@section('content')

<h2>&#127978; Dashboard</h2>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card text-center bg-secondary text-white">
            <div class="card-body">
                <h3>{{ $totalBooks }}</h3>
                <p>Total Books</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center bg-secondary text-white">
            <div class="card-body">
                <h3>{{ $totalUsers }}</h3>
                <p>Total Users</p>
            </div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row mt-5">
    <div class="col-md-4">
        <h5>Books Per Category</h5>
        <canvas id="pieChart" width="250" height="250" style="margin-top:-30px;"></canvas>
    </div>
    <div class="col-md-4">
        <h5>Books Borrowed Over Time</h5>
        <canvas id="barChart" style="margin-top:30px;"></canvas>
    </div>
    <div class="col-md-4">
        <h5>Books Borrowed per Category</h5>
        <canvas id="borrowedBooksChart" style="margin-top:30px;"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>

<script>
    // Pie Chart (Books pewr category)
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: @json($categoryLabels),
            datasets: [{
                label: 'Books per Category',
                data: @json($categoryCounts),
                backgroundColor: [
                    '#007bff', '#28a745', '#ffc107', '#dc3545', '#6c757d', '#20c997', '#6610f2'
                ]
            }]
        },
        options: {
            layout: {
                padding: {
                    top: -10,
                    bottom: 0
                }
            },
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 15,
                        color: '#333'
                    }
                },
                datalabels: {
                    color: '#fff',
                    formatter: (value, context) => {
                        const total = context.chart._metasets[0].total;
                        const percentage = ((value / total) * 100).toFixed(1) + '%';
                        const label = context.chart.data.labels[context.dataIndex];
                        return `${label}\n${percentage}`;
                    },
                    font: {
                        weight: 'bold',
                        size: 12
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    // Bar Chart (Monthly borrowed book count)
    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: @json($borrowMonths),
            datasets: [{
                label: 'Books Borrowed per Month',
                data: @json($borrowCounts),
                backgroundColor: '#17a2b8',
                borderColor: '#000000'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    },
                    title: {
                        display: true,
                        text: 'Number of Books Borrowed'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            }
        }
    });
    
    //Bar chart 2(Cattegory to borrowed books)

    const ctx = document.getElementById('borrowedBooksChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($categories),
            datasets: [{
                label: 'Books Borrowed',
                data: @json($counts),
                borderWidth: 1,
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: '#333'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0 
                    },
                    title: {
                        display: true,
                        text: 'Number of Books'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Category'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Borrowed Books per Category'
                }
            }
        }
    });
</script>

@endsection