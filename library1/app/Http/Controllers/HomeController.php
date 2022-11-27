<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Publisher;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // $publisher = Publisher::with('books')->get();
        // return $publisher;

        // conect to card di home atau dashboard
        $total_book = Book::count();
        $total_member = Member::count();
        $total_publisher = Publisher::count();
        $total_transaction = Transaction::whereMonth('date_start', date('m'))->count();

        // connect to chart donut
        $data_donut = Book::select(DB::raw("count(publisher_id) as total"))->groupBy('publisher_id')->orderBy('publisher_id', 'asc')->pluck('total');
        $label_donut = Publisher::orderBy('publishers.id', 'asc')->join('books', 'books.publisher_id', '=', 'publishers.id')->groupBy('name')->pluck('name');


        return view('home', compact('total_book', 'total_member', 'total_publisher', 'total_transaction', 'data_donut', 'label_donut'));
    }
}
