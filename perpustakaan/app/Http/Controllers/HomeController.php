<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Catalog;
use App\Models\Member;
use App\Models\Publisher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        // $member = Member::with('user')->get();
        // $book = Book::with('publisher')->get();
        // $publisher = Publisher::with('books')->get();
        // $author = Author::with('books')->get();
        $catalog = Catalog::with('books')->get();
        return $catalog;

        return view('home');
    }
}
