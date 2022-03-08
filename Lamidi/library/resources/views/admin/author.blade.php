@extends('layouts.admin')
@section('header','Author')
@section('css')
<!-- Datatables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('content')
HALAMAN Author
<br><br>
<div id="controller">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header">
                        <a href="" @click="addData()" data-toggle="modal" class="btn btn-sm btn-primary pull-right">Create New author</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table id="example1" class="table table-head-fixed text-nowrap table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Total Books</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($authors as $key => $author)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$author->name}}</td>
                                    <td>{{$author->email}}</td>
                                    <td>{{$author->phone_number}}</td>
                                    <td>{{$author->address}}</td>
                                    <td>{{count($author->books)}}</td>
                                    <td class=" text-center">
                                        <a href="" @click="editData({{$author}})" data-toggle="modal" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="" @click="deleteData({{$author->id}})" data-toggle="modal" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
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
                <form method="post" :action="actionUrl" autocomplete="off">
                    <div class="modal-header">
                        <h4 class="modal-title"> Author</h4>
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
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" :value="data.email" required="">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" :value="data.phone_number" required="">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" :value="data.address" required="">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
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
<script src=" {{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src=" {{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src=" {{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
    $(function() {
        $("#example1").DataTable();
    });
</script>
<script type="text/javascript">
    var controller = new Vue({
        el: '#controller',
        data: {
            data: {},
            actionUrl: "{{url('authors')}}"
        },
        mounted: function() {

        },
        methods: {
            addData() {
                this.data = {};
                this.actionUrl = "{{url('authors')}}";
                this.editStatus = false;
                $('#modal-default').modal();

            },
            editData(data) {
                this.data = data;
                this.actionUrl = "{{url('authors')}}" + '/' + data.id;
                this.editStatus = true;
                $('#modal-default').modal();

            },
            deleteData(id) {
                this.actionUrl = "{{url('authors')}}" + '/' + id;
                if (confirm("Are you sure?")) {
                    axios.post(this.actionUrl, {
                        _method: 'DELETE'
                    }).then(response => {
                        location.reload();
                    });
                }
            }
        }
    });
</script>
@endsection