@extends('layouts.admin')
@section('title','publisher')
@section('css')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" /> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" />
@endsection
@section('content')
<div id="controller">
    <div class="col-md-12" >
        <div class="card p-3">
        <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h4 class="card-title mt-3">Publishers </h4>
            <div>
                    <!-- Button trigger modal -->
                <a href="#" @click="addData()" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add New publisher
                </a>
            </div>
            </div>
            <div class="table-responsive">
            <table id="tabel-data" class="table table-hover table-bordered my-3">
                <thead>
                <tr>
                    <th width="10">#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th >Total Books</th>
                    <th >Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($publishers as $key => $publisher)
                    <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $publisher->name }}</td>
                    <td>{{ $publisher->email }}</td>
                    <td>{{ $publisher->phone_number }}</td>
                    <td>{{ $publisher->address }}</td>
                    <td >{{ count($publisher->books) }}</td>
                    <td>
                        <div class="d-flex justify-content-around">
                        <a href="#" @click="editData({{ $publisher }})" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</a>
                        <a href="#" @click="deleteData({{ $publisher->id }})" class="btn btn-sm btn-danger">Delete</a>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
        </div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form :action="actionUrl" method="post" autocomplete="off">
      <div class="modal-header">
        <h5> <b>publisher</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          @csrf
          <input type="hidden" name="_method" value="PUT" v-if="status">
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" :value="input.name" placeholder="Enter name.." required>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" :value="input.email" placeholder="Enter email.." required>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Phone Number</label>
                <input type="text" class="form-control form-control-lg @error('phone_number') is-invalid @enderror" name="phone_number" :value="input.phone_number" placeholder="Enter phone number.." required>
                @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        <div class="form-group">
            <label for="">Address</label>
            <input type="text" class="form-control form-control-lg @error('address') is-invalid @enderror" name="address" :value="input.address" placeholder="Enter addrees.." required>
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </div>
    </form>
  </div>
    </div>
</div>

    </div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
    $('#tabel-data').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );
</script>
<script>
    var controller = new Vue({
        el : "#controller",
        data: {
            input: {},
            actionUrl:'{{ url('publishers') }}',
            status:false,

        },
        methods: {
            addData() {
                this.actionUrl = '{{ url('publishers') }}';
                this.input= {};
                this.status=false;
                $('#exampleModal').modal();
            },
            editData(data) {
                // console.log(data);
                this.actionUrl = '{{ url('publishers') }}'+'/'+data.id ;
                this.input=data;
                this.status=true;
                $('#exampleModal').modal();

            },
            deleteData(id) {
                // console.log(id);
                this.actionUrl =  '{{ url('publishers') }}'+'/'+id ;

                if(confirm("Are you sure ?"))
                {
                    axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => { location.reload();
                     });
                }


            },

        }
    })

</script>

@endsection
