@extends('layouts.admin')

@section('header', 'Data Transaksi')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')

    <div id="controller">
        <div class="col-md-12">
            <h2 class="mb-5"> Transactions </h2>
            <div class="card p-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="me-auto">
                            <!-- Button trigger modal -->
                            <a href="{{ route('transactions.create') }}" type="button" class="btn btn-primary">
                                Add New transaction &nbsp;+
                            </a>
                        </div>

                        <div class="col-md-2">
                            {{-- <label for="">Load Status</label> --}}
                            <select name="status" class="form-select form-control form-control-lg">
                                <option value="">Loan Status</option>
                                <option value="Not Returned">Not Returned</option>
                                <option value="1">Returned</option>
                            </select>
                        </div>
                        <div class="col-md-2 ps-4">
                            <input type="text" name="date_start" onfocus="(this.type = 'date')"
                                class="form-control form-control-lg" placeholder="Loan Date">
                        </div>
                    </div>
                    <hr>
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th width="10">#</th>
                                <th>Loan Date</th>
                                <th>Return Date</th>
                                <th>Name</th>
                                <th>Loan Priode</th>
                                <th>Total Book</th>
                                <th>Total Paymant</th>
                                <th>Loan Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>



        </div>
    @endsection
    @section('js')
        {{-- Data table --}}
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
        <script>
            var actionUrl = '{{ url('transactions') }}';
            var apiUrl = '{{ url('api/transactions') }}';
            var columns = [{
                    data: 'DT_RowIndex',
                    orderable: true
                },
                {
                    data: 'date_start',
                    orderable: true
                },
                {
                    data: 'date_end',
                    orderable: true
                },
                {
                    data: 'name',
                    orderable: true
                },
                {
                    data: 'priode',
                    class: 'text-center',
                    orderable: true
                },
                {
                    data: 'total_book',
                    class: 'text-center',
                    orderable: true
                },
                {
                    data: 'rupiah',
                    orderable: true
                },
                {
                    data: 'status',
                    orderable: true
                },
                {
                    render: function(index, row, data, meta) {
                        return `
                <a href="${actionUrl}/${data.id}/" class="btn btn-rounded btn-info  py-2 ms-1" onclick="controller.detailData(event, ${meta.row})"> view </a>
                <a href="${actionUrl}/${data.id}/edit" class="btn btn-rounded btn-warning  py-2 ms-1" onclick="controller.editData(event, ${meta.row})"> Edit </a>
                <a  class="btn btn-rounded btn-danger  py-2 ms-1" onclick="controller.deleteData(event, ${data.id})"> Delete </a>
                `;
                    },
                    orderable: false,
                    width: '10%',
                    class: 'text-center'
                },
            ];
        </script>
        <script src="{{ asset('js/data.js') }}"></script>
        {{-- Filter --}}
        <script type="text/javascript">
            $('select[name=status]').on('change', function() {
                status = $('select[name=status]').val();
                if (status == '') {
                    controller.table.ajax.url(apiUrl).load();
                } else {
                    controller.table.ajax.url(apiUrl + '?status=' + status).load();
                }
            });
            $('input[name=date_start]').on('change', function() {
                date_start = $('input[name=date_start]').val();
                if (date_start == '') {
                    controller.table.ajax.url(apiUrl).load();
                } else {
                    controller.table.ajax.url(apiUrl + '?date_start=' + date_start).load();
                }
            });
        </script>

    @endsection
