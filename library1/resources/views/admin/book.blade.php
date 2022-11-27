@extends('layouts.admin')
@section('header', 'Book')

@section('css')
    {{-- LINK DATATABLES --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
                    <input class="form-control" autocomplete="off" type="text" placeholder="Search from title"
                        v-model="search">
                </div>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary" @click="addData()">Create New Book</button>
            </div>
        </div>
        <hr>

        {{-- CARD --}}
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12" v-for="book in filteredList">
                <div class="info-box" v-on:click="editData(book)">
                    <div class="info-box-content">
                        <span class="info-box-text h3">@{{ book.title }} (@{{ book.qty }})</span>
                        <span class="info-box-number">Rp.@{{ numberWithSpaces(book.price) }} ,-</span>
                    </div>
                </div>
            </div>
        </div>
        {{-- END CARD --}}


        {{-- MODAL --}}
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form :action="actionUrl" method="POST" autocomplete="off">
                        <div class="modal-header">
                            <h4 class="modal-title">Books</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf

                            <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                            <div class="form-group">
                                <label for="">ISBN</label>
                                <input type="number" class="form-control" name="isbn" placeholder="Enter number ISBN"
                                    required :value="book.isbn">
                            </div>
                            <div class="form-group">
                                <label for="">Title book</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter title book"
                                    required :value="book.title">
                            </div>
                            <div class="form-group">
                                <label for="">Year</label>
                                <input type="number" class="form-control" name="year" placeholder="Enter year"
                                    :value="book.year">
                            </div>
                            <div class="form-group">
                                <label for="">Publisher</label>
                                <select name="publisher_id" id="publisher_id" class="form-control">
                                    @foreach ($publishers as $publisher)
                                        <option :selected="book.publisher_id == {{ $publisher->id }}"
                                            value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Author</label>
                                <select name="author_id" id="author_id" class="form-control">
                                    @foreach ($authors as $author)
                                        <option :selected="book.author_id == {{ $author->id }}"
                                            value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Catalog</label>
                                <select name="catalog_id" id="catalog_id" class="form-control">
                                    @foreach ($catalogs as $catalog)
                                        <option :selected="book.catalog_id == {{ $catalog->id }}"
                                            value="{{ $catalog->id }}">{{ $catalog->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Qty Stock</label>
                                <input type="number" class="form-control" name="qty" placeholder="Enter qty" required
                                    :value="book.qty">
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" class="form-control" name="price" placeholder="Enter price" required
                                    :value="book.price">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" v-if="editStatus"
                                v-on:click="deleteData(book.id)">Delete</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- END MODAL --}}
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        var actionUrl = '{{ url('books') }}';
        var apiUrl = '{{ url('api/books') }}';

        var app = new Vue({
            el: '#controller',
            data: {
                books: [],
                search: '',
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
                    $('#modal-default').modal();
                },
                deleteData(id) {
                    if (confirm("Are you sure?")) {
                        axios.post(this.actionUrl + '/' + id, {
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
                filteredList() {
                    return this.books.filter(book => {
                        return book.title.toLowerCase().includes(this.search.toLowerCase());
                    })
                }
            }
        });
    </script>
@endsection
