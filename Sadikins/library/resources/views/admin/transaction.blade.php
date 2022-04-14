@extends('layouts.admin')
@section('title','Transaction')
@section('css')
{{-- Data table --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" />
@endsection
@section('content')
<div id="controller">
    <div class="col-md-12" >
         <h2 class="mb-5"> Transactions </h2>
        <div class="card p-3">
        <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div class="me-auto">
                    <!-- Button trigger modal -->
                <a href="#" @click="addData()" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add New transaction  &nbsp;+
                </a>
            </div>

            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">Loan Status</option>
                     <option value="Not Returned">Not Returned</option>
                    <option value="1">Returned</option>
                </select>
            </div>
            <div class="col-md-2 ps-4">
                <select name="date_start" class="form-select">
                    <option value="">2022-01-03</option>
                    <option value="">2022-04-21</option>
                </select>
            </div>
        </div>
        <hr>
            <table id="datatable" class="table table-hover">
                <thead>
                <tr>
                    <th width="10">#</th>
                    <th >Loan Date</th>
                    <th >Return Date</th>
                    <th >Name</th>
                    <th >Loan Priode</th>
                    <th >Total Book</th>
                    <th >Total Paymant</th>
                    <th >Loan Status</th>
                    <th >Action</th>
                </tr>
                </thead>

            </table>
        </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form :action="actionUrl" method="post" autocomplete="off" @submit="submitForm($event, data.id)">
      <div class="modal-header">
        <h5> <b>transaction</b></h5>
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
<script>
    var actionUrl= '{{ url('transactions') }}';
    var apiUrl= '{{ url('api/transactions') }}';
    var columns = [
        {data: 'DT_RowIndex', orderable: true},
        {data: 'date_start', orderable: true},
        {data: 'date_end', orderable: true},
        {data: 'name', orderable: true},
        {data: 'priode', class: 'text-center', orderable: true},
        {data: 'total_book', class: 'text-center',  orderable: true},
        {data: 'rupiah', orderable: true},
        {data: 'status', orderable: true},
        {render: function(index, row, data, meta) {
            return `
            <a href="#" class="btn btn-rounded btn-info  py-2 ms-1" onclick="controller.detailData(event, ${meta.row})" data-bs-toggle="modal" data-bs-target="#exampleModal"> Show </a>
            <a href="#" class="btn btn-rounded btn-warning  py-2 ms-1" onclick="controller.editData(event, ${meta.row})" data-bs-toggle="modal" data-bs-target="#exampleModal"> Edit </a>
            <a  class="btn btn-rounded btn-danger  py-2 ms-1" onclick="controller.deleteData(event, ${data.id})"> Delete </a>
            `;
        }, orderable: false, width: '10%', class: 'text-center'},
    ];


</script>
<script src="{{ asset('js/data.js') }}"></script>
{{-- Filter --}}
<script type="text/javascript">
    $('select[name=status]').on('change', function() {
        status = $('select[name=status]').val();
        if(status == '') {
            controller.table.ajax.url(apiUrl).load();
        }else {
            controller.table.ajax.url(apiUrl+'?status='+status).load();
        }
    });
</script>
@endsection
