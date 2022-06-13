<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Member;

use App\Models\Book;
use App\Models\Catalog;
use App\Models\Publisher;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

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
    // public function home()
    // {
    //     $total_member = Member::count();
    //     $total_book = Book::count();
    //     $total_transaction = Transaction::whereMonth('tgl_pinjam', date('m'))->count();
    //     $total_publisher = Publisher::count(); 

    //     return view('home', compact('total_book', 'total_member','total_transaction','total_publisher'));
    // }
    
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
        
        //No.1
        // $data = DB::table('members')
        //             ->join('users','users.member_id','=','members.id')
        //             ->get();


        // $data2 = Member::select('*')
        //             ->leftjoin('users','users.member_id','=','members.id')
        //             ->where ('users.id',NULL)
        //             ->get();
       
        // $data2 = DB::table('members')
        //             ->leftjoin('users','users.member_id','=','members.id')
        //             ->where ('users.id',NULL)
        //             ->get();
       
       
                    
        // $data3 = DB::table('members')
        //             ->select('members.id','members.name')
        //             ->leftjoin('transactions','members.id','transactions.member_id')
        //             ->where ('transactions.member_id', NULL)
        //             ->get();
                    
                    
        // $data3 = Member::select('members.id','members.name')
        //             ->leftjoin('transactions','members.id','transactions.member_id')
        //             ->where ('transactions.member_id', NULL)
        //             ->get();

        
        // $data4 = DB::table('members')
        //             ->select('members.id','members.name','members.phone_number')
        //             ->join('transactions','members.id','transactions.member_id')
        //             ->orderBy('transactions.member_id')
        //             ->get();
        
        
        // $data4 = Member::select('members.id','members.name','members.phone_number')
        //             ->join('transactions','members.id','transactions.member_id')
        //             ->orderBy('transactions.member_id')
        //             ->get();
        
        // $data5 = DB::table('members')
        //             ->select('transactions.member_id','members.name','members.phone_number')
        //             -> join('transactions','members.id','=','transactions.member_id')
        //             ->groupBy('member_id')
        //             ->having ('transactions.member_id','>',1)
        //             ->get();
        
                    
        // $data5 = Member::select('transactions.member_id','members.phone_number')
        //             -> join('transactions','members.id','=','transactions.member_id')
        //             ->groupBy('member_id')
        //             ->having ('transactions.member_id','>',1)
        //             ->get();
        
        
        // $data6 = Member::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')
        //             ->join('transactions','members.id','=','transactions.members_id')
        //             ->orderBy('members.name','asc')
        //             ->get();

        // $data7 = Member::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')
        //             ->join('transactions','members.id','=','transactions.members_id')
        //             ->whereMonth('date_end','=','06')
        //             ->get();

        // $data8 = Member::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')
        //             ->join('transactions','members.id','=','transactions.members_id')
        //             ->whereMonth('date_start','=','06')
        //             ->get();

        // $data9 = Member::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')
        //             ->join('transactions','members.id','=','transactions.members_id')
        //             ->whereMonth('date_start','=','06')
        //             ->whereMonth('date_end','=','06')
        //             ->orderBy('date_start')
        //             ->get();

                   
        // $data10 = Member::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')
        //             ->join('transactions','members.id','=','transactions.members_id')
        //             ->where('members.id','like','%Virginia%')
        //             ->orderBy('members.name')
        //             ->get();
 
        // $data11 = Member::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')
        //             ->join('transactions','members.id','=','transactions.members_id')
        //             ->where('members.id','like','%Virginia%')
        //             ->where('members.gender','L')
        //             ->orderBy('members.name')
        //             ->get();
 
                    
        // $data12 = Author::select('authors.name','authors.phone_number','authors.address','transactions.date_start','transactions.date_end','books.isbn','books.qty')
        //             ->join('books','authors.id','=','books.author_id')
        //             ->join('transactions','books.id','=','transactions.book_id')
        //             ->where('transaction','>','1')
        //             ->orderBy('authors.name')
        //             ->get();
 
        // $data13 = Author::select('authors.name','authors.phone_number','authors.address','transactions.date_start','transactions.date_end','books.isbn','books.qty')
        //             ->join('books','authors.id','=','books.author_id')
        //             ->join('transactions','books.id','=','transactions.book_id')
        //             ->orderBy('authors.name')
        //             ->get();
 
        // $data14 = Author::select('authors.name','authors.phone_number','authors.address','transactions.date_start','transactions.date_end','books.isbn','books.qty')
        //             ->join('books','authors.id','=','books.author_id')
        //             ->join('transactions','books.id','=','transactions.book_id')
        //             ->orderBy('authors.name')
        //             ->get();

        


        

        // return view('home');
    }
}
