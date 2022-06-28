<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Publisher;
use App\Models\Catalog;
use App\Models\Author;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home ()
     {
        $total_anggota = Anggota::count();
        $total_buku = Buku::count();
        $toal_peminjaman = Peminjaman::wherMonth('tgl_pinjam', date('m'))->count();
        $total_penerbit = Penerbit::count();
    }
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
         // $catalogs = Catalog::with('books')->get();
        // $authors = Author::with('books')->get();

        //no 1
        $data = Member::select('*')
                    ->join('users','users.member_id','=','members.id')
                    ->get();

        //no 2
        $data2 = Member::select('*')
                    ->leftJoin('users','users.member_id','=','members.id')
                    ->where('users.id', NULL)
                    ->get();

        //no 3
        $data3 = Transaction::select('members.id','members.name')
                    ->rightJoin('members','members.id','=','transactions.member_id')
                    ->where('transactions.member_id',NULL)
                    ->get();

        //no 4
        $data4 = Member::select('members.id','members.name','members.phone_number')
                    ->join('transactions','transactions.member_id','=','member_id')
                    ->orderBy('members.id','asc')
                    ->get();

        //no 5
        $data5 = Member::select('members.id','members.name','members.phone_number')
                    ->join('transactions','transactions.member_id','=','member_id')
                    ->orderBy('member_id')
                    ->get();

        //no 6
        $data6 = Transaction::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')
                ->join('members','member_id','=','transactions.id')
                ->get();

        //no 7
        $data7 = Transaction::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')
                ->join('members','member_id','=','transactions.id')
                ->where('transactions.member_id','transactions.date_end')
                ->get();

        $data8 = Transaction::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')
                ->join('members','member_id','=','transactions.id')
                ->where('date_start','2021-05')
                ->orderBy('transactions.id')
                ->get();

         $data9 = Transaction::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')
                ->join('members','member_id','=','transactions.id')
                ->where('date_end','2021-06')
                ->orderBy('transactions.id')
                ->get();

         $data10 = Transaction::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')
                ->join('members','member_id','=','transactions.id')
                ->where('address','%Bandung%')
                ->orderBy('transactions.id')
                ->get();

        $data11 = Transaction::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')
                ->join('members','member_id','=','transactions.id')
                ->where('gender','%Bandung%','Female')
                ->orderBy('transactions.id')
                ->get();

        $data12 = Transaction::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end','books.isbn','books.qty')
                ->join('members','member_id','=','transactions.id')
                ->join('books','books.id','=','transactions.id')
                ->where('qty','>','1')
                ->get();

        $data13 = Transaction::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end','books.isbn','books.qty','books.price')
                ->join('members','member_id','=','transactions.id')
                ->join('books','books.id','=','transactions.id')
                ->where('qty','+','price')
                ->get();

        $data14 = Member::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end','books.isbn','books.qty','publishers.name','authors.name','catalogs.name')
                ->join('transactions','transactions.member_id','=','member_id')
                ->join('books','books.id','=','members.id')
                ->join('publishers','publishers.id','=','members.id')
                ->join('authors','authors.id','=','members.id')
                ->join('catalogs','catalogs.id','=','members.id')
                ->get();

        $data15 = Catalog::select('catalogs.id','catalogs.name','books.title')
                ->join('books','books.id','=','catalogs.id')
                ->get();

        $data16 = Book::select('*')
                ->join('publishers','publishers.id','=','books.id')
                ->get();

        $data17 = Book::select('*')
                ->where('publisher_id','%9%')
                ->get();

        $data18 = Book::select('*')
                ->get();

        $data20 = Member::select('*')
                ->get(); 

        // return $publishers;
        // return $members;
        return view('home');
    }
}
