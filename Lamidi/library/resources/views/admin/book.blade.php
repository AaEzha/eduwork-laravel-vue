@extends('layouts.admin')
@section('header','Book')
@section('css')
<!-- Datatables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('content')
<div id="controller">
    <div class="row">
        <div class="col-md-5 offset-md-3">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <input type="text" class="form-control" autocomplete="off" placeholder="Search from title" v-model="search">
            </div>
        </div>
        <div class="col-md-2">
            <a href="#" class="btn btn-primary" @click="addData()" data-toggle="modal" data-target="#modal-default">Add New Book</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12" v-for="book in filteredList">
            <div class="info-box" v-on:click="editData(book)" data-toggle="modal" data-target="#modal-default">
                <span class="info-box-icon bg-aqua"><i class="fas fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">@{{book.title}} (@{{book.qty}})</span>
                    <span class="info-box-number">Rp.@{{numberWithCommas(book.price)}},-'</span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" :action="actionUrl" autocomplete="off">
                    <div class=" modal-header">
                        <h4 class="modal-title"> Book</h4>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="_method" value="PUT" v-if="editStatus">
                        <div class="form-group">
                            <label>ISBN</label>
                            <input type="number" class="form-control" name="isbn" :value="book.isbn" required="">
                        </div>
                        <div class="form-group">
                            <label>TITLE</label>
                            <input type="text" class="form-control" name="title" :value="book.title" required="">
                        </div>
                        <div class="form-group">
                            <label>YEAR</label>
                            <input type="text" class="form-control" name="year" :value="book.year" required="">
                        </div>
                        <div class="form-group">
                            <label>PUBLISHER ID</label>
                            <select name="publisher_id" class="form-control"> @foreach($publishers as $publisher)<option :selected="book.publisher_id=={{$publisher->id}}" value="{{$publisher->id}}">{{$publisher->name}}</option>@endforeach</select>
                        </div>
                        <div class="form-group">
                            <label>AUTHOR ID</label>
                            <select name="author_id" class="form-control"> @foreach($authors as $author)<option :selected="book.author_id=={{$author->id}}" value="{{$author->id}}">{{$author->name}}</option>@endforeach</select>
                        </div>
                        <div class="form-group">
                            <label>CATALOG ID</label>
                            <select name="catalog_id" class="form-control"> @foreach($catalogs as $catalog)<option :selected="book.catalog_id=={{$catalog->id}}" value="{{$catalog->id}}">{{$catalog->name}}</option>@endforeach</select>
                        </div>
                        <div class="form-group">
                            <label>QTY</label>
                            <input type="text" class="form-control" name="qty" :value="book.qty" required="">
                        </div>
                        <div class="form-group">
                            <label>PRICE</label>
                            <input type="text" class="form-control" name="price" :value="book.price" required="">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-default bg-danger" data-dismiss="modal" v-if=" editStatus" v-on:click="deleteData(book.id)">Delete</button>
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
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script type="text/javascript">
    var actionUrl = "{{url('books')}}";
    var apiUrl = "{{url('api/books')}}";
    var app = new Vue({
        el: '#controller',
        data: {
            books: [],
            search: '',
            actionUrl,
            apiUrl,
            book: {},
            editStatus: false
        },
        mounted: function() {
            this.get_books();
        },
        methods: {
            get_books() {
                const _this = this;
                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function(data) {
                        _this.books = JSON.parse(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            },
            addData() {
                this.book = {};
                this.editStatus = false;
                $('#modal-default').modal();
            },
            editData(book) {
                this.book = book;
                this.editStatus = true;
                this.actionUrl = "{{ url('books') }}" + '/' + this.book.id;
                $('#modal-default').modal();
            },
            deleteData(id) {
                // console.log(id);
                this.actionUrl = "{{url('books')}}" + '/' + id;
                if (confirm("Are you sure?")) {
                    axios.post(this.actionUrl, {
                        _method: 'DELETE'
                    }).then(response => {
                        location.reload();
                    });
                }
            },
            numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        },
        computed: {
            filteredList() {
                return this.books.filter(book => {
                    return book.title.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        }
    });
</script>
@endsection