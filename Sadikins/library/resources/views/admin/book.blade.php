@extends('layouts.admin')
@section('title', 'Book')
@section('content')

<div id="controller">
    <div class="col-md-10 ms-3">
        <div class="form-group">
            <div class="input-group">
                <input v-model="search" type="text" class="form-control form-control-lg me-3" placeholder="Search book..." >
                <div class="input-group-append mt-1">
                     <a href="#" @click="addData()" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add New Book &nbsp;+
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr class="my-5">
    <div class="row">
        <div class="col-3 mb-3" v-for="book in filteredList">
           <div class="card" style="width: 18rem;" v-on:click="editData(book)"  data-bs-toggle="modal" data-bs-target="#exampleModal">
            <div class="card-body">
                <h5 class="card-title">@{{ book.title }} (@{{ book.qty }})</h5>
                <h6 class="card-subtitle mb-2 text-muted">ISBN : @{{ book.isbn }}</h6>
                <small class="card-subtitle mb-2 text-muted">Year : @{{ book.year }}</small>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="text-primary" style="text-decoration: none;">Rp @{{ numberWithSpace(book.price) }}</a>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    <form :action="actionUrl"  method="post" autocomplete="off">
      <div class="modal-header">
        <h5> <b>Book</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          @csrf
          <input type="hidden" name="_method" value="PUT" v-if="status">
        <div class="row  mb-3">
            <div class="form-group col-md-6">
                <label for="">ISBN</label>
                <input type="number" class="form-control form-control-lg @error('isbn') is-invalid @enderror" name="isbn" :value="book.isbn" placeholder="Enter isbn.." required>
                @error('isbn')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="">Title</label>
                <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" name="title" :value="book.title" placeholder="Enter title.." required>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row  mb-3">
            <div class="form-group col-md-6">
                <label for="">Year</label>
                <input type="number" class="form-control form-control-lg @error('year') is-invalid @enderror" name="year" :value="book.year" placeholder="Enter year.." required>
                @error('year')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="">Publisher</label>
                <select name="publisher_id" class="form-control-lg form-select" >
                    @foreach ($publishers as $publisher)
                    <option :selected="book.publisher_id == {{ $publisher->id }}" value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                    @endforeach
                </select>
                @error('publisher')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

         </div>
         <div class="row  mb-3">
              <div class="form-group col-md-6">
                <label for="">Author</label>
                <select name="author_id" class="form-control-lg form-select" >
                    @foreach ($authors as $author)
                    <option :selected="book.atuhor_id == {{ $author->id }}" value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
                @error('author')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="">Catalog</label>
                <select name="catalog_id" class="form-control-lg form-select" >

                    @foreach ($catalogs as $catalog)
                    <option :selected="book.catalog_id == {{ $catalog->id }}" value="{{ $catalog->id }}">{{ $catalog->name }}</option>
                    @endforeach
                </select>
                @error('catalog')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
      </div>
      <div class="row mb-3">
            <div class="form-group col-md-6">
                <label for="">Qty Stock</label>
                <input type="number" class="form-control form-control-lg @error('qty') is-invalid @enderror" name="qty" :value="book.qty" placeholder="Enter qty.." required>
                @error('qty')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        <div class="form-group  col-md-6">
            <label for="">Price</label>
            <input type="number" class="form-control form-control-lg @error('price') is-invalid @enderror" name="price" :value="book.price" placeholder="Enter price.." required>
            @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
      </div>
        <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-danger" v-if="status" v-on:click="deleteData(book.id)">Delete</button>
                <button type="submit" class="btn btn-primary" >Save Change</button>

        </div>
    </div>
    </form>
  </div>
    </div>
</div>


</div> {{-- End of Controller --}}



@endsection

@section('js')
<script>
    var actionUrl = '{{  url('books') }}';
    var apiUrl = '{{  url('api/books') }}';
    var app = new Vue({
        el: '#controller',
        data: {
            books:[],
            actionUrl,
            apiUrl,
            search:'',
            book:{},
            status:false,
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
                    success: function (data) {
                        // masukkan ke variable books serta looping di lakukan parse
                        _this.books = JSON.parse(data);
                    },
                    error:function(error) {
                        console.log(error);
                    }
                });
            },
            addData() {
                this.book={};
                this.actionUrl='{{ url('books') }}';
                this.status=false;
                $('#exampleModal').modal();
            },
             editData(book) {
                //  console.log(book);
                this.book = book;
                this.actionUrl = '{{ url('books') }}'+'/'+this.book.id;
                this.status=true;
                $('#exampleModal').modal();
            },
             deleteData(id) {
                //  console.log(id);
                 this.actionUrl =  '{{ url('books') }}'+'/'+id ;
                 if(confirm("Are you sure ?")) {
                     axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => { location.reload();
                    });
                 }

            },
            send: function(e) {

                    alert('Send method!');

                },
            numberWithSpace(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            },
        },
    computed: {
        filteredList(){
            return this.books.filter(book => {
                return book.title.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    }
    });
</script>

@endsection
