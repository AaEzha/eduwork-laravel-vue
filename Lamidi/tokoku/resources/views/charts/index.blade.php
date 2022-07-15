@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$total_order}}</h3>
                    <p>TOTAL ORDERS</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <a href="{{url('orders')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$total_supplier}}</h3>
                    <p>TOTAL SUPPLIERS</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-boxes-packing"></i>
                </div>
                <a href="{{url('suppliers')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$total_customer}}</h3>
                    <p>TOTAL CUSTOMERS</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-people-group"></i>
                </div>
                <a href="{{url('customers')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$total_cashier}}</h3>
                    <p>TOTAL CASHIER</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-person"></i>
                </div>
                <a href="{{url('users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <br>
    <div id="reportPage" class="row">
        <div class="col-md-6">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">ORDERS CHARTS</h3>

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
            </div>
        </div>
        <br>
        <div class="col-md-6">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">SUPPLIERS CHARTS</h3>
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
                    <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-6">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">CUSTOMER CHARTS</h3>
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
                    <canvas id="pieChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-6">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">CASHIER CHARTS</h3>
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
                    <canvas id="donutChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <a href="#" id="downloadPdf" class="btn btn-default"><i class="fas fa-print"></i> Print Charts</a>
    <table id="example1" class="table table-bordered table-left">
        <thead>
            <tr>
                <th><input type="checkbox" id="check_all"></th>
                <th>NO</th>
                <th>ORDER NAME</th>
                <th>PAID AMOUNT</th>
                <th>BALANCE</th>
                <th>PAYMENT METHOD</th>
                <th>CASHIER NAME</th>
                <th>TRANSACTION DATE</th>
                <th>TRANSACTION AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            @if($orders->count())
            <a href="#" style="margin: 5px;" class="btn btn-danger" id="multiple_deleted">Delete Selected Data</a>
            @foreach ($orders as $key => $order)
            <tr id="sid{{$order->id}}">
                <td><input type="checkbox" name="ids" class="checkboxclass" value="{{$order->id}}"></td>
                <td>{{$key+1}}</td>
                <td>{{$order->nameo}}</td>
                <td>{{rupiah($order->paid_amount)}}</td>
                <td>{{rupiah($order->balance)}}</td>
                <td>{{$order->payment_method}}</td>
                <td>{{$order->nameu}}</td>
                <td>{{$order->transac_date}}</td>
                <td>{{rupiah($order->transac_amount)}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "excel", "pdf", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    $(function(e) {
        $("#check_all").click(function() {
            $(".checkboxclass").prop('checked', $(this).prop('checked'));
        });
        $("#multiple_deleted").click(function(e) {
            e.preventDefault();
            var allids = [];
            $("input:checkbox[name=ids]:checked").each(function() {
                allids.push($(this).val());
            });
            $.ajax({
                url: "{{route('multiple_deleted')}}",
                type: "DELETE",
                data: {
                    _token: $("input[name=_token]").val(),
                    ids: allids
                },
                success: function(response) {
                    $.each(allids, function(key, val) {
                        $("#sid" + val).remove();
                    })
                }
            })
        })
    });
    var label_donut = '{!! json_encode($label_donut) !!}';
    var data_donut = '{!! json_encode($data_donut) !!}';
    var label_donut2 = '{!! json_encode($label_donut2) !!}';
    var data_donut2 = '{!! json_encode($data_donut2) !!}';
    var pieLabel = '{!! json_encode($pieLabel) !!}';
    var pieDatas = '{!! json_encode($pieDatas) !!}';
    var pieLabel2 = '{!! json_encode($pieLabel2) !!}';
    var pieDatas2 = '{!! json_encode($pieDatas2) !!}';
    $(function() {
        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
        var donutData = {
            labels: JSON.parse(label_donut),
            datasets: [{
                data: JSON.parse(data_donut),
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        };
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
            title: {
                display: true,
                text: "ORDERS CHARTS"
            },
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions,
        });
        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        var pieData = {
            labels: JSON.parse(pieLabel),
            datasets: [{
                data: JSON.parse(pieDatas),
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        };
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
            title: {
                display: true,
                text: "SUPPLIERS CHARTS"
            },
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions,
        });
        //-------------
        //- PIE CHART CUSTOMER -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart2').get(0).getContext('2d');
        var pieData = {
            labels: JSON.parse(pieLabel2),
            datasets: [{
                data: JSON.parse(pieDatas2),
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        };
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
            title: {
                display: true,
                text: "CUSTOMERS CHARTS"
            },
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        });
        //-------------
        //- DONUT CHART CASHIER-
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart2').get(0).getContext('2d');
        var donutData = {
            labels: JSON.parse(label_donut2),
            datasets: [{
                data: JSON.parse(data_donut2),
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        };
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
            title: {
                display: true,
                text: "CASHIER CHARTS"
            },
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        });

    });
    $('#downloadPdf').click(function(event) {
        // get size of report page
        var reportPageHeight = $('#reportPage').innerHeight();
        var reportPageWidth = $('#reportPage').innerWidth();

        // create a new canvas object that we will populate with all other canvas objects
        var pdfCanvas = $('<canvas />').attr({
            id: "canvaspdf",
            width: reportPageWidth,
            height: reportPageHeight
        });

        // keep track canvas position
        var pdfctx = $(pdfCanvas)[0].getContext('2d');
        var pdfctxX = 0;
        var pdfctxY = 0;
        var buffer = 100;

        // for each chart.js chart
        $("canvas").each(function(index) {
            // get the chart height/width
            var canvasHeight = $(this).innerHeight();
            var canvasWidth = $(this).innerWidth();

            // draw the chart into the new canvas
            pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
            pdfctxX += canvasWidth + buffer;

            // our report page is in a grid pattern so replicate that in the new canvas
            if (index % 2 === 1) {
                pdfctxX = 0;
                pdfctxY += canvasHeight + buffer;
            }
        });

        // create new pdf and add our new canvas as an image
        var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
        pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);

        // download the pdf
        pdf.save('filename.pdf');
    });
</script>
@endsection