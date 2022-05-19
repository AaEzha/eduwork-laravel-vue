<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Book;
use App\Models\Catalog;
use App\Models\TransactionDetail;
use App\Models\Author;
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
        //no.1
        $data = Member::select('*')
                ->join('users','users.member_id', '=', 'members.id')
                ->get();

        //no.2
        $data2 = Member::select('*')
                ->leftJoin('users', 'users.member_id', '=','members.id')
                ->where('users.id', Null)
                ->get();
        
        //no.3
        $data3 = Transaction::select('members.id', 'members.name')
                ->rightJoin('members', 'members.id', '=', 'transactions.member_id')
                ->where('transactions.member_id', Null)
                ->get();
        
        //no.4
        $data4 = Member::select('members.id', 'members.name', 'members.phone_number')
                ->join('transactions', 'transactions.member_id', '=', 'members.id')
                ->orderBy('transactions.member_id')
                ->get();
        
        //no.5
        $data5 = DB::select('SELECT t.member_id, name, m.phone_number
        FROM members m
        JOIN transactions t ON m.id = t.member_id
        GROUP  BY t.member_id
        HAVING COUNT(t.member_id) >1');

        //no.6
        $data6 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
                ->join('transactions', 'transactions.member_id', '=', 'members.id')
                ->orderBy('transactions.member_id', 'asc')
                ->get();

        //no.7
        $data7 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
                ->join('transactions', 'transactions.member_id', '=', 'members.id')
                ->whereMonth('transactions.date_start', '06')
                ->get();
        
        //no.8
        $data8 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
                ->join('transactions', 'transactions.member_id', '=', 'members.id')
                ->whereMonth('transactions.date_start', '05')
                ->get();
        
        //no.9
        $data9 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
                ->join('transactions', 'transactions.member_id', '=', 'members.id')
                ->whereMonth('transactions.date_start', '06')
                ->whereMonth('transactions.date_end', '06')
                ->orderBy('transactions.date_start')
                ->get();

        //no.10
        $data10 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
                ->join('transactions', 'transactions.member_id', '=', 'members.id')
                ->where('members.address', 'bandung')
                ->orderBy('transactions.date_start')
                ->get();

        //no.11
        $data11 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
                ->join('transactions', 'transactions.member_id', '=', 'members.id')
                ->where('members.address', 'bandung')
                ->where('members.gender', 'W')
                ->orderBy('members.name', 'asc')
                ->get();

        //no.12
        $data12 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end', 'transaction_details.transaction_id', 'transaction_details.qty')
                ->join('transactions', 'transactions.member_id', '=', 'members.id')
                ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
                ->where('transaction_details.qty', '>', 1)
                ->orderBy('members.name', 'asc')
                ->get();

        //no.13
        $data13 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end', 'transaction_details.transaction_id', 'transaction_details.qty', 'books.title', 'books.price')
                ->join('transactions', 'transactions.member_id', '=', 'members.id')
                ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
                ->join('books', 'transaction_details.book_id', '=', 'books.isbn')
                ->where('transaction_details.qty', '>', 1)
                ->orderBy('members.name', 'asc')
                ->get();

        //no.14
        $data14 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end', 'transaction_details.transaction_id', 'transaction_details.qty', 'books.title', 'books.price', 'authors.name', 'publishers.name','catalogs.name')
                ->join('transactions', 'transactions.member_id', '=', 'members.id')
                ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
                ->join('books', 'transaction_details.book_id', '=', 'books.isbn')
                ->join('authors', 'books.author_id', '=', 'authors.id')
                ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
                ->join('catalogs', 'books.catalog_id', '=', 'catalogs.id')
                ->where('transaction_details.qty', '>', 1)
                ->orderBy('members.name', 'asc')
                ->get();

        //no.15
        $data15 = Catalog::select('catalogs.id', 'catalogs.name', 'books.title')
                ->join('books', 'catalogs.id', '=', 'books.catalog_id')
                ->orderBy('catalogs.id')
                ->get();

        //no.16
        $data16 = Book::select('books.isbn', 'books.title', 'books.created_at', 'publishers.name', 'books.author_id', 'books.catalog_id', 'books.qty', 'books.price')
                ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
                ->get();

        //no.17
        $data17 = Book::select('*')
                ->where('books.author_id','=', 5 )
                ->get();

        //no.18
        $data18 = Book::select('*')
                ->where('books.price','=', 10000 )
                ->get();

        //no.19
        $data19 = Book::select('*')
                ->where('books.publisher_id','=', 1 )
                ->where('books.qty', '>', 10)
                ->get();

        //no.20
        $data20 = Member::select('*')
                ->whereMonth('members.created_at', '06')
                ->get();

        return $data20;
        return view('home');
    }
}
