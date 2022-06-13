<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Member;
use App\Models\Catalog;
use App\Models\Publisher;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function home()
    // {
    //     $total_member = Member::count();
    //     $total_book = Book::count();
    //     $total_transaction = Transaction::whereMonth('tgl_pinjam', date('m'))->count();
    //     $total_publisher = Publisher::count(); 

    //     return view('home', compact('total_book', 'total_member','total_transaction','total_publisher'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $total_members = Member::count();
        $total_books = Book::count();
        $total_transactions = Transaction::count();
        $total_publishers = Publisher::count();
        // Doughnut
        $data_donut = Book::select(DB::raw("COUNT(publisher_id) as total"))->groupBy('publisher_id')->orderBy('publisher_id', 'ASC')->pluck('total');
        $label_donut = Publisher::orderBy('publishers.id', 'ASC')->join('books', 'books.publisher_id', 'publishers.id')->groupBy('publishers.name')->pluck('publishers.name');

        // Line
        // $data_line = Book::select(DB::raw("COUNT(author_id) as total"))->groupBy('author_id')->orderBy('author_id', 'ASC')->pluck('total');
        // $label_line = Author::orderBy('authors.id', 'ASC')->join('books', 'books.author_id', 'authors.id')->groupBy('authors.name')->pluck('authors.name');


        // Bar
        $label_bar = ['Borrowing', 'Returning'];
        $data_bar = [];

        foreach ($label_bar as $key => $value) {
            $data_bar[$key]['label'] = $label_bar[$key];
            $data_bar[$key]['backgroundColor'] = $key == 0 ? '#B983FF' : "#99FEFF";
            $data_month = [];

            foreach (range(1, 12) as $month) {
                if ($key == 0) {
                    $data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_start', $month)->first()->total;
                } else {
                    $data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_end', $month)->first()->total;
                }
            }
            $data_bar[$key]['data'] = $data_month;
            

        }
        // return $data_bar;

        return view('admin.dashboard', compact('total_books', 'total_members', 'total_transactions', 'total_publishers', 'data_donut', 'label_donut', 'data_bar'));
    }


    public function catalog() {
        $data_catalog = Catalog::all();
        
        return view('admin.catalog.index', compact('data_catalog'));
    }


    public function publisher(){
        return view('admin.publisher.publisher');
    }
    

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
