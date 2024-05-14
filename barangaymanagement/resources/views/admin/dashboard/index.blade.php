@extends('admin.layouts')
@section('content')
<div class="row" style="gap: 20px;">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <div style="height: 400px;">
                    <canvas id="myPie"></canvas>
                </div>
            </div>
            <div class="card-footer uppercase font-bold text-slate-600">
              <span>Purok total residents</span> : <span class="text-blue-500">{{ number_format($resident_count) }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <div style="height: 400px;">
                    <canvas id="myPies"></canvas>
                </div>
            </div>
            <div class="card-footer uppercase font-bold text-slate-600 flex gap-3">
                <div>
                    <span>Purok total female</span> : <span class="text-blue-500">{{ number_format($purok_female) }}</span>
                </div>
                <div>
                    <span>Purok total male</span> : <span class="text-blue-500">{{ number_format($purok_male) }}</span>
                </div>
              </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <div style="height: 400px;">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="card-footer uppercase font-bold text-slate-600 flex gap-3">
                <div>
                    <span>Purok total Residents</span> : <span class="text-blue-500">{{ number_format($age_sum) }}</span>
                </div>
              </div>
        </div>
    </div>
</div>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Age 1 ~ 18', 'Age to 19 ~ 59', 'Age 60 +'],
            datasets: [{
                label: 'Total',
                data: @json($age),
                backgroundColor: [
                    '#FF00FF',
                    '#808000',
                    '#008080'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('myPie').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($datas[0]),
            datasets: [{
                label: 'Total Residents',
                data: @json($datas[1]),
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {

            colorschemes: {

            scheme: 'tableau.Tableau20'

            }

            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('myPies').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($purok[0]),
            datasets: [{
                label: 'Total Male',
                data: @json($purok[1]),
                borderWidth: 1
            },
            {
                label: 'Total Female',
                data: @json($purok[2]),
                borderWidth: 1
            }
        ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {

            colorschemes: {

            scheme: 'tableau.Tableau20'

            }

            }
        }
    });
</script>

@endsection
