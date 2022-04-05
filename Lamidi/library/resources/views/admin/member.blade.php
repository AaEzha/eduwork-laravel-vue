@extends('layouts.admin')
@section('header','Member')
@section('css')
<!-- Datatables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('content')
<br><br>
<div id="controller">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header">
                        <a href="" @click="addData()" data-toggle="modal" class="btn btn-sm btn-primary pull-right">Create New member</a>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name="gender">
                            <option value="0"> All Gender</option>
                            <option value="M"> Men</option>
                            <option value="W"> Women</option>
                        </select>
                    </div>
                    <br><br>
                    <div class="card-body table-responsive p-0">
                        <table id="datatable" class="table table-head-fixed text-nowrap table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" :action="actionUrl" autocomplete="off" @submit="submitForm($event, data.id)">
                    <div class=" modal-header">
                        <h4 class="modal-title"> member</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="_method" value="PUT" v-if="editStatus">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" :value="data.name" required="">
                        </div>
                        <div class="form-group">
                            <label for="name" class=" control-label">Jenis Kelamin</label>
                            <select name="gender" :value="data.gender" id="gender" class="form-control required">
                                <option value="">Select Gender</option>
                                <option value="M">Men</option>
                                <option value="W">Women</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" :value="data.phone_number" required="">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" :value="data.address" required="">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" :value="data.email" required="">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<!-- Datatables & Plugins -->
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

<script type="text/javascript">
    var actionUrl = "{{url('members')}}";
    var apiUrl = "{{url('api/members')}}";

    var columns = [{
            data: 'DT_RowIndex',
            orderable: true
        },
        {
            data: 'name',
            orderable: true
        },
        {
            data: 'gender',
            orderable: true
        },
        {
            data: 'phone_number',
            orderable: true
        },
        {
            data: 'address',
            orderable: true
        },
        {
            data: 'email',
            orderable: true
        },
        {
            render: function(index, row, data, meta) {
                return ` 
                <a href="#" class="btn btn-warning btn-sm" onclick="controller.editData (event,${meta.row})"> Edit </a> 
                <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event,${data.id})">Delete </a>
                `;
            },
            orderable: false,
            width: '200px',
            class: 'text-center'
        },
    ];
</script>
<script src="{{asset('js/data.js')}}"></script>
<script type="text/javascript">
    $('select[name=gender]').on('change', function() {
        gender = $('select[name=gender]').val();
        if (gender == 0) {
            controller.table.ajax.url(apiUrl).load();
        } else {
            controller.table.ajax.url(apiUrl + '?gender=' + gender).load();
        }
    });
</script>
@endsection