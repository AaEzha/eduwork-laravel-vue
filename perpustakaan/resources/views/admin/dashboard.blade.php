@extends('layouts.admin')
@section('header','Dashboard')

@section('content')
<div class="conttainer-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $bookTotal }}</h3>

                    <p>Books Total</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <a href="{{ url('books') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $memberTotal }}</h3>

                    <p>Members Total</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-people-outline"></i>
                </div>
                <a href="{{ url('members') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $publisherTotal }}</h3>

                    <p>Authors Total</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="{{ url('authors') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $transactionTotal }}</h3>

                    <p>Transaction Total</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ url('Transactions') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-6">
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Donut Chart</h3>

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
              <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Bar Chart</h3>

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
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
        </div>

        
      </div>
    </div>
</div>
@endsection

{{-- <script src="{{ asset('assets../../plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script> --}}

<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>

<script src="{{asset('assets/dist/js/adminlte.min.js?v=3.2.0')}}"></script>

<script type="text/javascript">
  var labelDonut = '{!! json_encode($labelDonut) !!}';
  var dataDonut = '{!! json_encode($dataDonut) !!}';
  var dataBar = '{!! json_encode($dataBar) !!}';
  var labelBar = '{!! json_encode($labelBar) !!}';
  var pieLabel = '{!! json_encode($pieLabel) !!}';
  var pieDatas = '{!! json_encode($pieDatas) !!}';

  $(function(){
    // donut chart
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData = {
            labels: JSON.parse(labelDonut),
            datasets: [{
                data: JSON.parse(dataDonut),
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
    })

    // //pie chart
    // var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    //     var pieData = {
    //         labels: JSON.parse(pieLabel),
    //         datasets: [{
    //             data: JSON.parse(pieDatas),
    //             backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
    //         }]
    //     }
    //     var pieOptions = {
    //         maintainAspectRatio: false,
    //         responsive: true,
    //     }
    //     //Create pie or douhnut chart
    //     // You can switch between pie and douhnut using the method below.
    //     new Chart(pieChartCanvas, {
    //         type: 'pie',
    //         data: pieData,
    //         options: pieOptions
    //     })
        //-------------
        //- BAR CHART -
        //-------------
        var areaChartData = {
            labels: JSON.parse(labelBar),
            datasets: JSON.parse(dataBar)
        }
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        // var temp0 = areaChartData.datasets[0]
        // var temp1 = areaChartData.datasets[1]
        // barChartData.datasets[0] = temp1
        // barChartData.datasets[1] = temp0
        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        }
        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })
  })
</script>