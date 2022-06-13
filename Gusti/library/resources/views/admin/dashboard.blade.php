@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')

    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <p class="text-small mb-2">Total Members</p>
                                <h4 class="mb-0 fw-bold">{{ $total_members }} Member</h4>
                            </div>
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>
                            <a href="{{ url('members') }}" class="small-box-footer">More Info<i
                                    class="fas fa-arrow"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <p class="text-small mb-2">Total Books </p>
                                <h4 class="mb-0 fw-bold">{{ $total_books }} Book</h4>
                            </div>
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>
                            <a href="{{ url('books') }}" class="small-box-footer">More Info<i
                                    class="fas fa-arrow"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <p class="text-small mb-2">Total Publishers</p>
                                <h4 class="mb-0 fw-bold">{{ $total_publishers }} Publisher</h4>
                            </div>
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>
                            <a href="{{ url('publishers') }}" class="small-box-footer">More Info<i
                                    class="fas fa-arrow"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <p class="text-small mb-2">Total Transaction</p>
                                <h4 class="mb-0 fw-bold">{{ $total_transactions }} Transaction</h4>
                            </div>
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>
                            <a href="{{ url('transactions') }}" class="small-box-footer">More Info<i
                                    class="fas fa-arrow"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex">
            <div class="col-md-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Publisher</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="donutChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 487px;"
                            width="487" height="250" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Author</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="barChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 487px;"
                                width="487" height="250" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row flex-grow mt-5">

            <div class="col-12 grid-margin stretch-card">
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h4 class="card-title card-title-dash">Transaction Report</h4>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="chart">
                                        <canvas id="barChart"
                                            style="min-height:250px; height:550px; max-height:600px; max-width:100%;"></canvas>
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

        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('assets/dist/js/adminlte.min.js?v=3.2.0') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
       
        <script type="text/javascript">
            var label_donut = '{!! json_encode($label_donut) !!}';
            var data_donut = '{!! json_encode($data_donut) !!}';
            var data_bar = '{!! json_encode($data_bar) !!}';

            $(function() {

                        //DONUT CHART

                        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                        var donutData = {
                            labels: JSON.parse(label_donut),
                            datasets: [{
                                data: JSON.parse(data_donut),
                                background: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                            }]
                        }

                        var donutOptions = {
                            maintainAspectRation: false,
                            responsive: true,
                        }

                        //create pie or donut chart

                        new Char(donutChartCanvas, {
                            type: 'doughnut',
                            data: donutData,
                            option: donutOptions

                        })

                        //---------
                        //BAR CHART
                        //---------

                        var areaChartData = {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                                'October', 'November', 'December'
                            ],
                            datasets: JSON.parse(data_bar)
                        }

                        var barChartCanvas = $('#barChart').get(0).getContext('2d')
                        var barChartData = $.extend(true, {}, areaChartData)
                        // var temp0          = areaChartData.datasets[0]
                        // var temp1          = areaChartData.datasets[1]
                        // barChartData.datasets[0] = temp1
                        // barChartData.datasets[1] = temp0

                        var barChartOptions = {
                            responsive: true,
                            maintainAspectRatio: false,
                            dataSetFill: false
                        }

                        new Chart(barChartCanvas, {
                            type: 'bar',
                            data: barChartData,

                        })
        </script>

    @endsection
