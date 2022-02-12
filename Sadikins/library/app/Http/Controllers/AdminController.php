<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Member;
use App\Models\Catalog;
use App\Models\Publisher;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $members = Member::with('user')->get();
        $books = Book::with('publisher', 'author', 'catalog')->get();
        $publisher = Publisher::with('books')->get();
        $catalog = Catalog::with('books')->get();
        $author = Author::with('books')->get();
        return $author;
        return view('admin/dashboard');
    }
}
