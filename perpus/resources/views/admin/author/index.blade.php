@extends('layouts.admin')
@section('header', 'Author')

@section('content')
    <div id="controller">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-header">
                            <a href="" @click="addData()" class="btn btn-primary">Create New Author</a>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($authors as $key => $a)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $a->name }}</td>
                                            <td>{{ $a->email }}</td>
                                            <td>{{ $a->phone_number }}</td>
                                            <td>{{ $a->address }}</td>
                                            <td>
                                                <a href="" class="btn btn-warning btn-sm" @click="editData({{ $a }})">edit</a>
                                                <a href="" class="btn btn-danger btn-sm" @click="deleteData({{ $a->id }})">delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <form :action="actionUrl" method="POST" autocomplete="off">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Author</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
    
                        <div class="form-group">
                            <label for="name">Enter Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required :value="data.name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required :value="data.email">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="Enter Phone Number" required :value="data.phone_number">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" required :value="data.address">
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
    {{-- END MODAL --}}
@endsection

@section('js')
<script type="text/javascript">
    var controller = new Vue({
        el: '#controller',
        data: {
            data: {};
            actionUrl: '{{ url('authors') }}';
        },
        mounted: function(){},
        methods: {
            addData(){
                this.data = {};
                this.actionUrl = '{{ url('authors') }}' + '/' + data.id;
                $('#modal-default').modal();
            },
            editData(data){
                this.data = data;
                this.actionUrl = '{{ url('authors') }}' + '/' + data.id;
                $('#modal-default').modal();
            },
            deleteData(id){
                this.actionUrl = '{{ url('authors') }}' + '/' + id;
                if(confirm("Are you sure?")){
                    axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => {
                        location.reload();
                    });
                }

            }
        },
    });
</script>
@endsection


