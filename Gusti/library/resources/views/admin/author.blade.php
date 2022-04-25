@extends('layouts.admin')

{{-- @include('admin.includes.sidebar') --}}

@section('header', 'Author')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')

    <div id="controller">
        {{-- <div class="container"> --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="#" @click="addData()" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus"></i>
                                Add New Author</a>

                        </div>

                        <div class="card-body p-3">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form :action="actionUrl" method="post" autocomplete="off" @submit="submitForm(event, data.id)">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add New Author</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @csrf

                                    <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" :value="data.name"
                                            placeholder="Enter name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" :value="data.email"
                                            placeholder="Enter email" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="phone_number"
                                            :value="data.phone_number" placeholder="Enter phone number" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" :value="data.address"
                                            placeholder="Enter address" required>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Create_at</label>
                                        <input type="text" class="form-control" name="create_at" :value="data.address"
                                            placeholder="Enter address" required>
                                    </div> --}}
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

        {{-- </div> --}}
    </div>
@endsection

@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script type="text/javascript">
        var actionUrl = '{{ url('authors') }}';
        var apiUrl = '{{ url('api/authors') }}';

        var columns = [        
            {data: 'DT_RowIndex', class: 'text-center', orderable: true},
            {data: 'name', class: 'text-center', orderable: true},
            {data: 'email', class: 'text-center', orderable: true},
            {data: 'phone_number', class: 'text-center', orderable: true},
            {data: 'address', class: 'text-center', orderable: true},
            {data: 'date', class: 'text-center', orderable: true},
            {
                render: function(index, row, data, meta) {
                    return `
                <a href="#" class="btn btn-primary btn-sm bi bi-pencil-square" onclick="controller.editData(event, ${meta.row})">
                </a>
                <a href="#" class="btn btn-danger btn-sm bi bi-trash" onclick="controller.deleteData(event, ${data.id})">
                </a>`;
                },
                orderable: false,
                width: '100px',
                class: 'text-center'
            },
        ];

        var controller = new Vue({
            el: '#controller',
            data: {
                datas: [],
                data: {},
                actionUrl,
                apiUrl,
                editStatus: false,
            },
            mounted: function() {
                this.datatable();
            },
            methods: {
                datatable() {
                    const _this = this;
                    _this.table = $('#datatable').DataTable({
                        ajax: {
                            url: _this.apiUrl,
                            type: 'GET',
                        },
                        columns
                    }).on('xhr', function() {
                        _this.datas = _this.table.ajax.json().data;
                    });
                },
                addData() {
                    this.data = {};
                    this.editStatus = false;
                    $('#modal-default').modal();
                },
                editData(event, row) {
                    this.data = this.datas[row];
                    this.editStatus = true;
                    $('#modal-default').modal();
                },
                deleteData(event, id) {
                    if (confirm('Are you sure?')) {
                        $(event.target).parents('tr').remove();
                        axios.post(this.actionUrl + '/' + id, {
                            _method: 'DELETE'
                        }).then(response => {
                            alert('Data has benn removed');
                        });
                    }
                },
                submitForm(event, id) {
                    event.preventDefault();
                    const _this = this;
                    var actionUrl = !this.editStatus ? this.actionUrl : this.actionUrl + '/' + id;
                    axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {
                        $('#modal-default').modal('hide');
                        _this.table.ajax.reload();
                    });
                },
            }
        });
    </script>

    <!-- Page specific script -->
    {{-- <script>
    $(function () {
      $("#datatable").DataTable();
    });
  </script> --}}

    {{-- CRUD VueJS --}}
    {{-- <script type="text/javascript">
    
        var controller = new Vue ({
            el : '#controller',
            data : {
                data : {},
                actionUrl : '{{ url('authors') }}',
                editStatus : false
            },
            mounted : function(){

            },
            methods : {
                addData() {
                    this.data = {};
                    this.actionUrl = '{{ url('authors') }}';
                    this.editStatus = false;
                    $('#modal-default').modal();
                },
                editData(data) {
                    this.data = data;
                    this.actionUrl = '{{ url('authors') }}'+'/'+ data.id;
                    this.editStatus = true;
                    $('#modal-default').modal();
                },
                deleteData(id) {
                    this.actionUrl = '{{ url('authors') }}'+'/'+ id;
                    if(confirm('Are you sure?')){
                        axios.post(this.actionUrl, {_method: 'DELETE'}).then(response =>{
                            location.reload();
                        });
                    }
                }
            }
        });

</script> --}}
@endsection
