@extends('layouts.admin')

@section('header', 'Publisher')

@section('css')

@endsection

@section('content')
    <div id="controller">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div class="card">
                        <div class="card-header">
                            <a href="#" @click="addData()" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus"></i>
                                Add New Publisher</a>

                        </div>

                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 10px">No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($publishers as $publisher)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $publisher->name }}</td>
                                            <td>{{ $publisher->email }}</td>
                                            <td>{{ $publisher->phone_number }}</td>
                                            <td>{{ $publisher->address }}</td>
                                            <td class="text-center">
                                                <a href="#" @click="editData({{ $publisher }})"
                                                    class="btn btn-sm btn-primary">Edit
                                                    {{-- <i class="bi bi-pencil"></i> --}}
                                                </a>
                                                {{-- <i class="bi bi-pencil"></i></a> --}}

                                                <a href="#" @click="deleteData({{ $publisher->id }})" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer clearfix px-2">
                            <ul class="pagination pagination-sm float-right">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form :action="actionUrl" method="post" autocomplete="off">
                                <div class="modal-header">
                                    <h4 class="modal-title">Publisher</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @csrf

                                    <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" :value="data.name" placeholder="Enter name"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" :value="data.email" placeholder="Enter email"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="phone_number" :value="data.phone_number"
                                            placeholder="Enter phone number" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" :value="data.address" placeholder="Enter address"
                                            required>
                                    </div>
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
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        var controller = new Vue ({
            el : '#controller',
            data: {
                data: {},
                actionUrl: '{{ url('publishers') }}',
                editStatus : false
            },
            mounted: function() {

            },
            methods: {
                addData() {
                    this.data = {};
                    this.actionUrl = '{{ url('publishers') }}';
                    this.editStatus = false;
                    $('#modal-default').modal()
                },
                editData(data) {
                    this.data = data;
                    this.actionUrl = '{{ url('publishers') }}'+'/'+data.id;
                    this.editStatus = true;
                    $('#modal-default').modal()

                },
                deleteData(id) {
                    this.actionUrl = '{{ url('publishers') }}'+'/'+id;
                    if(confirm('Are you sure?')) {
                        axios.post(this.actionUrl, {_method : "DELETE"}). then(response=>{
                            location.reload();
                            });
                        }  
                    }
                }     
            });
        
    </script>
@endsection
