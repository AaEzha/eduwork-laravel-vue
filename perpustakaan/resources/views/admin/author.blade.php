@extends('layouts.admin')
@section('header', 'Author')

@section('css')
    
@endsection


@section('content')
<div id="controller">
    <div class="card">
        <div class="card-header">
            <a href="#" @click="addData()" class="btn btn-primary">Create New Author</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
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
                            <td>{{ $key+1 }}</td>
                            <td>{{ $a->name }}</td>
                            <td>{{ $a->email }}</td>
                            <td>{{ $a->phone_number }}</td>
                            <td>{{ $a->address }}</td>
                            <td class="text-right">
                                <a href="#" @click="editData({{ $a }})" class="btn btn-warning btn-sm">edit</a>
                                <a class="btn btn-danger btn-sm" href="#" @click="deleteData({{ $a->id }})">delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form :action="actionUrl" method="POST" autocomplete="off">
    
                        <div class="modal-header">
                            <h4 class="modal-title">Author</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf

                            <input type="hidden" name="_method" id="" value="PUT" v-if="editStatus">
        
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" id="name" :value="data.name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" id="email" :value="data.email" required>
                            </div>
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="number" class="form-control" name="phone_number" id="phone_number" :value="data.phone_number" required>
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" class="form-control" name="address" id="address" :value="data.address" required>
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
@endsection

@section('js')
    <script type="text/javascript">
        var controller = new Vue({
            el: '#controller',
            // membuat variable
            data:{
                data:{},
                actionUrl: '{{ url('authors') }}',
                editStatus: false
            },
            // menjalankan funtion
            mounted:function(){

            },
            // menyimpan data function
            methods:{
                addData(){
                    this.data = {};
                    this.actionUrl = '{{ url('authors') }}';
                    this.editStatus = false;
                    $('#modal-default').modal();
                },
                editData(data){
                    this.data = data;
                    this.actionUrl = '{{ url('authors') }}' + '/' + data.id;
                    this.editStatus = true;
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
            }
        });
    </script>
@endsection