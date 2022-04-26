<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Publisher;
use App\Models\Catalog;
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
    public function index(Request $request)
    {
        // $notifications = auth()->user()->unreadNotifications;
        $notifications = [];
        $transactions = Transaction::find(1);
        $members = Member::all();
        $total_anggota = Member::count();
        $total_buku = Book::count();
        $total_peminjaman = Transaction::count();
        $total_penerbit = Publisher::count();


        $data_donut = Book::select(DB::raw("COUNT(publisher_id) as total"))->groupby('publisher_id')->orderby('publisher_id', 'asc')->pluck('total');
        $label_donut = Publisher::orderBy('publishers.id', 'asc')->join('books', 'books.publisher_id', '=', 'publishers.id')->groupby('name')->pluck('name');
        $pieDatas = Book::select(DB::raw("COUNT(catalog_id) as total"))->groupby('catalog_id')->orderby('catalog_id', 'asc')->pluck('total');
        $pieLabel = Catalog::orderBy('catalogs.id', 'asc')->join('books', 'books.catalog_id', '=', 'catalogs.id')->groupby('name')->pluck('name');
        $label_bar = ['transaction'];
        $data_bar = [];

        foreach ($label_bar as $key => $value) {
            $data_bar[$key]['label'] = $label_bar[$key];
            $data_bar[$key]['backgroundcolor'] = $key == 0 ? 'rgba(60,141,188,0.9)' : 'rgba(210,214,222,1)';
            $data_month = [];

            foreach (range(1, 12) as $month) {
                if ($key == 0) {
                    $data_month[] = Transaction::select(db::raw("count(*)as total"))->wheremonth('date_start', $month)->first()->total;
                } else {
                    $data_month[] = Transaction::select(db::raw("count(*)as total"))->wheremonth('date_end', $month)->first()->total;
                }
            }

            $data_bar[$key]['data'] = $data_month;
        }
        return view('home', compact('total_buku', 'total_anggota', 'total_peminjaman', 'total_penerbit', 'data_donut', 'label_donut', 'data_bar', 'pieDatas', 'pieLabel', 'transactions', 'notifications'));
        //$members = Member::with('user')->get();
        //$books = Book::with('publisher')->get();
        //$books = Book::with('author')->get();
        //$books = Book::with('catalog')->get();
        //$authors = Author::with('books')->get();
        //$catalogs = Catalog::with('books')->get();
        //$publishers = Publisher::with('books')->get();
        //no 1
        //$data = Member::select('*')->join('users', 'users.member_id', '=', 'members.id')->get();
        //no 2
        //$data2 = Member::select('*')->leftjoin('users', 'users.member_id', '=', 'members.id')->where('users.id', null)->get();
        //no 3
        //$data3 = Transaction::select('members.id', 'members.name')->rightjoin('members', 'members.id', '=', 'transactions.member_id')->where('transactions.member_id', null)->get();
        //no 4
        //$data4 = Member::select('members.id', 'members.name', 'members.phone_number')->join('transactions', 'transactions.member_id', '=', 'members.id')->orderby('members.id', 'asc')->get();
        //no 5
        //$data5 = Member::select('members.id', 'members.name', 'members.phone_number')->join('transactions', 'transactions.member_id', '=', 'members.id')->groupby('members.id', 'members.name', 'members.phone_number')->having(DB::raw('count(members.id)'), '>', 1)->get();
        //no 6
        //$data6 = Transaction::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')->join('members', 'members.id', '=', 'transactions.member_id')->get();
        //no 7
        //$start_date = date('Y-m-d', strtotime('2021-06-01'));
        //$end_date = date('Y-m-d', strtotime('2021-06-31'));
        //$data7 = Transaction::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')->join('members', 'members.id', '=', 'transactions.member_id')->wheredate('transactions.date_start', '>=', $start_date)->wheredate('transactions.date_end', '<=', $end_date)->get();
        //no 8
        //$start_date2 = date('Y-m-d', strtotime('2021-05-01'));
        //$end_date2 = date('Y-m-d', strtotime('2021-05-31'));
        //$data8 = Transaction::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')->join('members', 'members.id', '=', 'transactions.member_id')->wheredate('transactions.date_start', '>=', $start_date2)->wheredate('transactions.date_end', '<=', $end_date2)->get();
        //no 9
        //$data9 = Transaction::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')->join('members', 'members.id', '=', 'transactions.member_id')->wheremonth('transactions.date_start', '=', 6)->wheremonth('transactions.date_end', '=', 6)->get();
        //no 10
        //$data10 = Transaction::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')->join('members', 'members.id', '=', 'transactions.member_id')->where('address', 'like', '%Bandung%')->get();
        //no 11
        // $data11 = Transaction::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')->join('members', 'members.id', '=', 'transactions.member_id')->where('address', 'like', '%Bandung%', 'and', 'sex=p')->get();
        //no 12
        // $data12 = TransactionDetail::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end', 'books.isbn', 'transaction_details.qty',)->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')->join('books', 'books.id', '=', 'transaction_details.book_id')->join('members', 'members.id', '=', 'transactions.member_id')->where('transaction_details.qty', '>', 1)->get();
        //no 13
        // $data13 = TransactionDetail::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end', 'books.isbn', 'transaction_details.qty', 'books.title', 'books.price')->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')->join('books', 'books.id', '=', 'transaction_details.book_id')->join('members', 'members.id', '=', 'transactions.member_id')->where('transaction_details.qty', '*', 'books.price')->get();
        //no 14
        //$data14 = TransactionDetail::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end', 'books.isbn', 'transaction_details.qty', 'books.title', 'publishers.name', 'authors.name', 'catalogs.name as nama_katalog')->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')->join('books', 'books.id', '=', 'transaction_details.book_id')->join('members', 'members.id', '=', 'transactions.member_id')->join('publishers', 'publishers.id', '=', 'books.publisher_id')->join('authors', 'authors.id', '=', 'books.author_id')->join('catalogs', 'catalogs.id', '=', 'books.catalog_id')->get();
        //no 15
        // $data15 = Catalog::select('catalogs.id', 'name', 'books.title')->join('books', 'books.catalog_id', '=', 'catalogs.id')->get();
        //no 16
        //$data16 = Book::select('isbn', 'title', 'year', 'publisher_id', 'author_id', 'catalog_id', 'qty', 'price', 'publishers.name as publisher')->leftjoin('publishers', 'publishers.id', '=', 'books.publisher_id')->get();
        //no 17
        //$data17 = Book::select('author_id')->where('author_id', '=', 'PG05')->count();
        //no 18
        //$data18 = Book::all()->where('price', '>', '10000');
        //no 19
        //$data19 = Book::all()->where('publishers.name', '=', 'Penerbit01')->where('qty', '>', '10')->join('publishers', 'publishers.id', '=', 'books.publisher_id');
        //no 20
        //$data20 = DB::table('members')->wheremonth('created_at', '6')->get();
        //return $data20;
        //return view('home');
    }
}
