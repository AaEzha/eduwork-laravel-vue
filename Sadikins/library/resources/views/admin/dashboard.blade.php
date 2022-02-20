@extends('layouts.admin')
@section('title','Dashboard')
@section('css')
  {{-- <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}"> --}}

@endsection
@section('content')

 <div class="col-md-6 col-lg-12 grid-margin stretch-card">
    <div class="card card-rounded">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">

                        <div>
                        <p class="text-small mb-2">Total Members</p>
                        <h4 class="mb-0 fw-bold">{{ $total_members }} Member</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                        <div>
                        <p class="text-small mb-2">Total Books</p>
                        <h4 class="mb-0 fw-bold">{{ $total_books }} Book</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                        <div class="circle-progress-width">
                        <div id="totalVisitors" class="progressbar-js-circle pr-2"></div>
                        </div>
                        <div>
                        <p class="text-small mb-2">Total Publishers</p>
                        <h4 class="mb-0 fw-bold">{{ $total_publishers }} Publisher</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                        <div class="circle-progress-width">
                        <div id="totalVisitors" class="progressbar-js-circle pr-2"></div>
                        </div>
                        <div>
                        <p class="text-small mb-2">Total Transactions</p>
                        <h4 class="mb-0 fw-bold">{{ $total_transactions }} transaction</h4>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
    <div class="row flex-grow mt-5">
        <div class="col-4 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title card-title-dash">Publisher</h4>
                </div>
                <canvas class="my-auto" id="doughnutChart" height="200"></canvas>
                <div id="doughnut-chart-legends" class="my-5"></div>
                </div>
            </div>
            </div>
        </div>
        </div>

          <div class="col-8 grid-margin stretch-card">
            <div class="card ">
                <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                        <h4 class="card-title card-title-dash">Authors</h4>
                        </div>
                        <div>
                        </div>
                    </div>
                    <div class="mt-3"
                    >
                        <div class="chart">
                        <canvas id="lineChart" style="min-height:250px; height:550px; max-height:600px; max-width:100%;"></canvas>
                    </div>
                    </div>
                    </div>
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
                    <div class="mt-3"
                    >
                        <div class="chart">
                        <canvas id="barChart" style="min-height:250px; height:550px; max-height:600px; max-width:100%;"></canvas>
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

  <script>
      var  data_donut = '{!! json_encode($data_donut) !!}';
      var  label_donut = '{!! json_encode($label_donut) !!}';
      var  data_bar = '{!! json_encode($data_bar) !!}';
      var  data_line = '{!! json_encode($data_line) !!}';

      if ($("#doughnutChart").length) {
      var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
      var doughnutPieData = {
        datasets: [{
          data: JSON.parse(data_donut),
          backgroundColor: [
            "#7579E7",
            "#9AB3F5",
            "#A3D8F4",
            "#B9FFFC"
          ],
          borderColor: [
            "#7579E7",
            "#9AB3F5",
            "#A3D8F4",
            "#B9FFFC"
          ],
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: JSON.parse([label_donut])
      };
      var doughnutPieOptions = {
        cutoutPercentage: 50,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        responsive: true,
        maintainAspectRatio: true,
        showScale: true,
        legends: false,
        legendCallback: function (chart) {
          var text = [];
          text.push('<div class="chartjs-legends"><ul class="justify-content-center">');
          for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
            text.push('<li><span style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '">');
            text.push('</span>');
            if (chart.data.labels[i]) {
              text.push(chart.data.labels[i]);
            }
            text.push('</li>');
          }
          text.push('</div></ul>');
          return text.join("");
        },

        layout: {
          padding: {
            left: 0,
            right: 0,
            top: 0,
            bottom: 0
          }
        },
        tooltips: {
          callbacks: {
            title: function(tooltipItem, data) {
              return data['labels'][tooltipItem[0]['index']];
            },
            label: function(tooltipItem, data) {
              return data['datasets'][0]['data'][tooltipItem['index']];
            }
          },

          backgroundColor: '#fff',
          titleFontSize: 14,
          titleFontColor: '#0B0F32',
          bodyFontColor: '#737F8B',
          bodyFontSize: 11,
          displayColors: false
        }
      };
      var doughnutChart = new Chart(doughnutChartCanvas, {
        type: 'doughnut',
        data: doughnutPieData,
        options: doughnutPieOptions
      });
      document.getElementById('doughnut-chart-legends').innerHTML = doughnutChart.generateLegend();
    }


    //== Bar Chart ===
    var areaChartData = {
        labels : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', ' October', 'November', 'December'],
        datasets: JSON.parse(data_bar)
    }
    var barChartCanvas = $('#barChart').get(0).getContext('2d');
    var barChartData = $.extend(true, {}, areaChartData);

    var barChartOptions = {
        responsive : true,
        maintainAspectRatio : false,
        datasetFill : false
    }

    new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    });

    // Line Chart
    const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'Author Report',
      backgroundColor: '#E0C3FC',
      borderColor: '#E0C3FC',
      data: JSON.parse(data_line),
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {}
  };

   const lineChart = new Chart(
    document.getElementById('lineChart'),
    config
  );
  </script>



@endsection


