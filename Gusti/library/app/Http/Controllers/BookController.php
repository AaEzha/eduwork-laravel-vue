<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Catalog;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $catalogs = Catalog::all();
        return view('admin.book.index', compact('publishers','authors','catalogs'));
    }

    public function api()
    {
        // $books = Book::all();

        $books = Book::with('publisher', 'author', 'catalog')->get();

        return json_encode($books);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'isbn' => ['required'],
            'title' => ['required'],
            'year' => ['required'],
            'publisher_id' => ['required'],
            'author_id' => ['required'],
            'catalog_id' => ['required'],
            'qty' => ['required'],
            'price' => ['required'],
        ]);
        
        Book::create($request->all());

        return redirect('books');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request, [
            'isbn' => ['required'],
            'title' => ['required'],
            'year' => ['required'],
            'publisher_id' => ['required'],
            'author_id' => ['required'],
            'catalog_id' => ['required'],
            'qty' => ['required'],
            'price' => ['required'],
        ]);

        $book->update($request->all());

        return redirect('books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        
        $book->delete();
        return redirect('books');
    }
}
