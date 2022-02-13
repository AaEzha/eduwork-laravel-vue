@extends('layouts.admin')
@section('title','publisher')
@section('css')
{{-- Data table --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" />
@endsection
@section('content')
<div id="controller">
    <div class="col-md-12" >
        <div class="card">
        <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h4 class="card-title mt-3">publishers </h4>
            <div>
                    <!-- Button trigger modal -->
                <a href="#" @click="addData()" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add New publisher
                </a>
            </div>
            </div>
            <div class="table-responsive">
            <table id="datatable" class="table table-hover table-bordered my-3 ">
                <thead>
                <tr>
                    <th width="10">#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th >Action</th>
                </tr>
                </thead>

            </table>
            </div>
        </div>
        </div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form :action="actionUrl" method="post" autocomplete="off" @submit="submitForm($event, data.id)">
      <div class="modal-header">
        <h5> <b>publisher</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          @csrf
          <input type="hidden" name="_method" value="PUT" v-if="status">
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" :value="data.name" placeholder="Enter name.." required>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" :value="data.email" placeholder="Enter email.." required>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Phone Number</label>
                <input type="text" class="form-control form-control-lg @error('phone_number') is-invalid @enderror" name="phone_number" :value="data.phone_number" placeholder="Enter phone number.." required>
                @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        <div class="form-group">
            <label for="">Address</label>
            <input type="text" class="form-control form-control-lg @error('address') is-invalid @enderror" name="address" :value="data.address" placeholder="Enter addrees.." required>
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
{{-- Data table --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script>
    var actionUrl= '{{ url('publishers') }}';
    var apiUrl= '{{ url('api/publishers') }}';
    var columns = [
        {data: 'DT_RowIndex', class: 'text-center', orderable: true},
        {data: 'name', class: 'text-center', orderable: true},
        {data: 'email', class: 'text-center', orderable: true},
        {data: 'phone_number', class: 'text-center', orderable: true},
        {data: 'address', class: 'text-center', orderable: true, width:'30%'},
        {render: function(index, row, data, meta) {
            return `
            <a href="#" class="btn btn-warning btn-sm" onclick="controller.editData(event, ${meta.row})" data-bs-toggle="modal" data-bs-target="#exampleModal"> Edit </a>
            <a  class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})"> Delete </a>
            `;
        }, orderable: false, width: '10%', class: 'text-center'},
    ];
</script>
<script src="{{ asset('js/data.js') }}"></script>
@endsection
