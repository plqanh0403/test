@extends('admin.layout.layoutAdmin1') {{-- kế thừa layout --}}

@section('content') {{-- đổ content vào layout --}}
<div class="dashboard-cards">

    <div class="stat-card purple">
        <h6>Total Users</h6>
        <h2>{{ $userCount }}</h2>
    </div>

    <div class="stat-card pink">
        <h6>Total Blogs</h6>
        <h2>{{ $blogCount }}</h2>
    </div>

    <div class="stat-card orange">
        <h6>Contacts & Email</h6>
        <h2>{{ $submitCount }}</h2>
    </div>

    <div class="stat-card blue">
        <h6>Services</h6>
        <h2>{{ $serviceCount }}</h2>
    </div>

</div>

<div class="dashboard-chart card p-4 mt-5">
    <h5 class="mb-3">Submissions Last 7 Days</h5>

    <canvas id="contactChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('contactChart');

    new Chart(ctx, {
        type: 'line',

        data: {
            labels: @json($labels),

            datasets: [{
                    label: 'Submit Email',
                    data: @json($emailData)
                },
                {
                    label: 'Submit Contact',
                    data: @json($contactData)
                }
            ]
        },

        options: {
            responsive: true,

            plugins: {
                legend: {
                    position: 'top'
                }
            },

            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
@endsection

{{-- @yield: nơi layout hiển thị nội dung --}}