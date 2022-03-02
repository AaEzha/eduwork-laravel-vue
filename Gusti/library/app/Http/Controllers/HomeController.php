<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Member;

use App\Models\Book;
use App\Models\Catalog;
use App\Models\Publisher;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $members = Member::with('user')->get();
        // $books = Book::with('publisher')->get();
        // $publishers = Publisher::with('books')->get();
        // $books = Book::with('author')->get();
        // $authors = Author::with('books')->get();
        // $members = Member::with('transaction')->get();
        // $transactions = Transaction::with('books')->get();
        // $books = Book::with('transactions')->get();
        
        // return $books;
        return view('home');
    }
}
