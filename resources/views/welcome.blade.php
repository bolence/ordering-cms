@extends('layouts.app')
@section('content')
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary fw-bold text-uppercase">Ukupno porudžbina</p>
                                <h4 class="my-1 text-info">{{ $orders->count() }}</h4>

                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                <i class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary fw-bold text-uppercase">Suma porudžbina</p>
                                <h4 class="my-1 text-danger">{{ number_format($orders->sum('price'), 2) }}</h4>

                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto">
                                <i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Bounce Rate</p>
                                <h4 class="my-1 text-success">34.6%</h4>

                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                <i class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary fw-bold text-uppercase">Ukupno mušterija</p>
                                <h4 class="my-1 text-warning">{{ $customers->count() }}</h4>

                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
                                <i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

        <div class="row row-cols-1 row-cols-lg-3">
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Prodaja po mesecima</h6>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3 mb-5">
                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                    style="color: #14abef"></i>Bedževi</span>
                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                    style="color: #ffc107"></i>Majice</span>
                        </div>
                        <div class="chart-container-1">
                            <canvas id="chart1"></canvas>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Statusi porudžbina</h6>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-1">
                            <canvas id="chart4"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($order_statuses as $status)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                {{ $status->status }} <span
                                    class="badge bg-gradient-quepal rounded-pill">{{ $status->status_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Porudžbine po proizvodu</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-2 mt-4">
                            <canvas id="chart2"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush mt-0">
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Broj bedževa <span class="badge bg-success rounded-pill">{{ $count_badges }}</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Broj majica <span class="badge bg-danger rounded-pill">{{ $count_tshirt }}</span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!--end row-->

        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-3">Poslednjih 10 poručenih proizvoda</h6>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Proizvod</th>
                                <th>Broj porudžbine</th>
                                <th>Veličina majice / bedža </th>
                                <th>Boja majice / tip kačenja</th>
                                <th>Tip majice / plastifikacija</th>
                                <th>Količina</th>
                                <th>Datum</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_items as $item)
                                <tr>
                                    <td>{{ ucfirst($item->type) }}</td>
                                    <td>{{ $item->order->order_number }}</td>
                                    <td>{{ ucfirst($item->tshirt_size ?? $item->badge_size) }}</td>
                                    <td>{{ $item->tshirt_color ? ucfirst($item->tshirt_color) : json_encode($item->tip_kacenja) }}
                                    </td>
                                    <td>{{ ucfirst($item->tshirt_type ?? $item->plastifikacija) }}
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->created_at->format('d.m.Y') }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/js/Chart.extension.js') }}"></script>


    <script>
        $(document).ready(function() {

            var count_badges = <?php echo $count_badges; ?>;
            var count_tshirt = <?php echo $count_tshirt; ?>;

            var ctx = document.getElementById("chart2").getContext('2d');

            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#fc4a1a');
            gradientStroke1.addColorStop(1, '#f7b733');

            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke2.addColorStop(0, '#4776e6');
            gradientStroke2.addColorStop(1, '#8e54e9');

            var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke3.addColorStop(0, '#ee0979');
            gradientStroke3.addColorStop(1, '#ff6a00');

            var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke4.addColorStop(0, '#42e695');
            gradientStroke4.addColorStop(1, '#3bb2b8');

            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Majice", "Bedzevi"],
                    datasets: [{
                        backgroundColor: [
                            gradientStroke1,
                            gradientStroke2,

                        ],
                        hoverBackgroundColor: [
                            gradientStroke1,
                            gradientStroke2,

                        ],
                        data: [count_tshirt, count_badges],
                        borderWidth: [1, 1, 1, 1]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutoutPercentage: 75,
                    legend: {
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth: 8
                        }
                    },
                    tooltips: {
                        displayColors: false,
                    }
                }
            });

            var order_statuses = <?php echo $statuses_json; ?>;
            var statuses = [];
            var count_statuses = [];

            $.each(order_statuses, function(k, v) {
                statuses.push(v.status);
                count_statuses.push(v.status_count);
            });

            var ctx = document.getElementById("chart4").getContext('2d');

            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#ee0979');
            gradientStroke1.addColorStop(1, '#ff6a00');

            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke2.addColorStop(0, '#283c86');
            gradientStroke2.addColorStop(1, '#39bd3c');

            var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke3.addColorStop(0, '#7f00ff');
            gradientStroke3.addColorStop(1, '#e100ff');

            var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke4.addColorStop(0, '#42e695');
            gradientStroke4.addColorStop(1, '#3bb2b8');

            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: statuses,
                    datasets: [{
                        backgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3,
                            gradientStroke4
                        ],

                        hoverBackgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3,
                            gradientStroke4
                        ],

                        data: count_statuses,
                        borderWidth: [1, 1, 1]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutoutPercentage: 0,
                    legend: {
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth: 8
                        }
                    },
                    tooltips: {
                        displayColors: false,
                    },
                }
            });


            // chart 1

            var ctx = document.getElementById("chart1").getContext('2d');

            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#6078ea');
            gradientStroke1.addColorStop(1, '#17c5ea');

            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke2.addColorStop(0, '#ff8359');
            gradientStroke2.addColorStop(1, '#ffdf40');

            var counts_tshirt_per_month = <?php echo $tshirt_count_per_month; ?>;
            var counts_badge_per_month = <?php echo $badge_count_per_month; ?>;

            var tshirt_per_month = [];
            var badge_per_month = [];

            $.each(counts_tshirt_per_month, function(k, v) {
                tshirt_per_month.push(v.count_item);
            });

            $.each(counts_badge_per_month, function(k, v) {
                badge_per_month.push(v.count_item);
            });

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Majice',
                        data: tshirt_per_month,
                        borderColor: gradientStroke1,
                        backgroundColor: gradientStroke1,
                        hoverBackgroundColor: gradientStroke1,
                        pointRadius: 0,
                        fill: true,
                        borderWidth: 0
                    }, {
                        label: 'Bedževi',
                        data: badge_per_month,
                        borderColor: gradientStroke2,
                        backgroundColor: gradientStroke2,
                        hoverBackgroundColor: gradientStroke2,
                        pointRadius: 0,
                        fill: false,
                        borderWidth: 0
                    }]
                },

                options: {
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth: 8
                        }
                    },
                    tooltips: {
                        displayColors: false,
                    },
                    scales: {
                        xAxes: [{
                            barPercentage: .5
                        }]
                    }
                }
            });

        });
    </script>
@endpush
