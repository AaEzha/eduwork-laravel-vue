@extends('layouts.admin')
@section('header', 'Dashboard')

@section('css')
    {{-- LINK DATATABLES --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Book</span>
                    <span class="info-box-number">
                        {{ $total_book }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Member</span>
                    <span class="info-box-number">{{ $total_member }}</span>
                </div>
            </div>
        </div>


        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Publisher</span>
                    <span class="info-box-number">{{ $total_publisher }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Transaction</span>
                    <span class="info-box-number">{{ $total_transaction }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Browser Usage</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="chart-responsive">
                            <canvas id="donutChart" height="400"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets../../plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/chart.js/chart.min.js') }}"></script>
    <script type="text/javascript">
        var data_donut = '{!! json_encode($data_donut) !!}';
        var label_donut = '{!! json_encode($label_donut) !!}';

        $(function() {
            // DONUT CHART //
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: JSON.parse(label_donut),
                datasets: [{
                    data: JSON.parse(data_donut),
                    backgroundColor: ['yellow', 'purple', 'pink', 'blue', 'grey', 'dark', 'white',
                        'red', 'green', 'gold'
                    ]
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true
            }
            // Create pie or donut chart
            // you can switch between pie and donut using the method below
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })
            // END DONUT CHART //

        })
    </script>

@endsection
