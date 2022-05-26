@extends('layouts.admin')
@section('header', 'Book')

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
                    <input class="form-control" autocomplete="off" type="text" placeholder="Search from title" v-model="search">
                </div>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary" @click="addData()">Create New Book</button>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12" v-for="book in filterList">
                <div class="info-box" v-on:click="editData(book)">
                    <div class="info-box-content">
                        <span class="info-box-text h3">@{{ book.title }} (@{{ book.qty }})</span>
                        <span class="info-box-number">Rp. @{{ numberWithSpaces(book.price) }},- <small></small></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal --}}
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form :action="actionUrl" method="POST" autocomplete="off">
                        <div class="modal-header">
                            <h4 class="modal-title">Book</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf

                            <input type="hidden" name="_method" id="" value="PUT" v-if="editStatus">
        
                            <div class="form-group">
                                <label for="">isbn</label>
                                <input type="number" class="form-control" name="isbn" id="isbn" required :value="book.isbn">
                            </div>
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control" name="title" id="title" required :value="book.title">
                            </div>
                            <div class="form-group">
                                <label for="">year</label>
                                <input type="number" class="form-control" name="year" id="year" required :value="book.year">
                            </div>
                            <div class="form-group">
                                <label for="">Publisher</label>
                                <select name="publisher_id" id="" class="form-control">
                                    @foreach ($publishers as $p)
                                        <option :selected="book.publisher_id == {{ $p->id }}" value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Author</label>
                                <select name="author_id" id="" class="form-control">
                                    @foreach ($authors as $a)
                                        <option :selected="book.author_id == {{ $a->id }}" value="{{ $a->id }}">{{ $a->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Catalog</label>
                                <select name="catalog_id" id="" class="form-control">
                                    @foreach ($catalogs as $c)
                                        <option :selected="book.catalog_id == {{ $c->id }}" value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Qty</label>
                                <input type="number" class="form-control" name="qty" id="qty" required :value="book.qty">
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" class="form-control" name="price" id="price" required :value="book.price">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default bg-danger" v-if="editStatus" v-on:click="deleteData(book.id)">Delete</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">
    var actionUrl = '{{ url('books') }}';
    var apiUrl = '{{ url('api/books') }}';

    var app = new Vue({
        el: '#controller',
        data:{
            books: [],
            search: '',
            book: {},
            editStatus: false,
            actionUrl,
        },
        mounted: function(){
            this.getBooks();
        },
        methods: {
            getBooks(){
                const _this = this;
                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function(data){
                        _this.books = JSON.parse(data);
                    },
                    error: function(error){
                        console.log(error);
                    }
                });
            },
            addData(){
                this.book = {};
                this.editStatus = false;
                $('#modal-default').modal();
            },
            editData(book){
                this.book = book;
                this.actionUrl = '{{ url('books') }}' + '/' + this.book.id;
                this.editStatus = true;
                $('#modal-default').modal();
            },
            deleteData(id){
                this.actionUrl = '{{ url('books')}}' + '/' + id;
                if (confirm("Are you sure?")) {
                    axios.post(this.actionUrl, {
                        _method: 'DELETE'
                    }).then(response => {
                        location.reload();
                    });
                }
            },
            numberWithSpaces(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        },
        computed: {
            filterList(){
                return this.books.filter(book => {
                    return book.title.toLowerCase().includes(this.search.toLowerCase());
                })
            }
        }
    });
</script>
@endsection