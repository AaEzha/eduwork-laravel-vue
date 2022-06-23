@extends('layouts.admin')
@section('header', 'Member')

@section('css')

<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection

@section('content')
<div id="controller">

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSaya">
  Create New Member
</button>
  <br> <br>
  <table id="datatable" class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Gander</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
</table>

  <div class="modal fade" id="modalSaya">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="post" :action="actionUrl" autocomplete="off">
            <div class="modal-header">
              
              <h4 class="modal-title">Member</h4>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              @csrf

              <input type="hidden" name="method" value="PUT" v-if="editStatus">

              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" :value="data.name" required="">
              </div>

               <div class="form-group">
                <label>Gender</label>
                <input type="text" class="form-control" name="name" :value="data.email" required="">
              </div>

               <div class="form-group">
                <label>Phone Number</label>
                <input type="text" class="form-control" name="name" :value="data.phone_number" required="">
              </div>

              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="name" :value="data.phone_number" required="">
              </div>

               <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="name" :value="data.address" required="">
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
@endsection


@section('js')
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
    var actionUrl = '{{ url('members') }}';
    var apiUrl = '{{ url('api/members') }}';

    var columns = [
        {data: 'DT_RowIndex', class: 'text-center', orderable: true},
        {data: 'name', class: 'text-center', orderable: false},
        {data: 'gender', class: 'text-center', orderable: true},
        {data: 'phone_number', class: 'text-center', orderable: true},
        {data: 'address', class: 'text-center', orderable: true},
        {data: 'email', class: 'text-center', orderable: true},
        {render: function (index, row, data, meta) {
          return `
          <a href="#" class="btn btn-warning btn-sm" onclick="controller.editData(event, ${meta.row})">
          Edit
          </a>
          <a class="btn btn-danger btn-sm" onclick="controller.deletData(event, ${data.id})">
          Delete
          </a>`;
        }, orderable: false, width: '200px', class: 'text-center'},
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
      mounted: function () {
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
            columns: columns
          }).on('xhr', function () {
            _this.datas = _this.table.ajax.json().data;
          });
        },
         addData(data) {
            this.data = {}; 
            this.actionUrl= '{{ url('authors') }}';
            this.editStatus = false;
            $('modalSaya').modal();
        },
        editData(event, row) {
            this.data = this.datas[row];
             this.actionUrl = '{{ url('authors') }}'+'/'+this.data.id;
             this.editStatus = false;
            $('modalSaya').modal();
        },
        deletData(event, id) {
          this.actionUrl = '{{ url('authors') }}'+'/'+id;
          if (confirm("Are You Sure?")) {
            axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => {
              alert('Data has been removed');
            });
          }

        }
      }
    });

</script>
<!-- <script type="text/javascript">
  $(function () {
    $("#datatable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    // });
  });
</script>
<script type="text/javascript">
    var controller = new Vue({
      el: '#controller',
      data: {
        data: {},
        actionUrl : '{{ url('authors') }}'
        editStatus : false

      },
      mounted: function () {

      },
      methods: {
        addData(data) {
            this.data = {}; 
            this.actionUrl= '{{ url('authors') }}';
            this.editStatus = false;
            $('modalSaya').modal();
        },
        editData() {
             this.data = data;
             this.actionUrl = '{{ url('authors') }}'+'/'+data.id;
             this.editStatus = false;
            $('modalSaya').modal();
        },
        deletData() {
          this.actionUrl = '{{ url('authors') }}'+'/'+id;
          if (confirm("Are You Sure?")) {
            axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => {
              location.reload();
            });
          }

        }
      }

    });
  </script> -->
@endsection