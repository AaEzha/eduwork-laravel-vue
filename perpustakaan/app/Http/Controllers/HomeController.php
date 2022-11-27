<?php

namespace App\Http\Controllers;


use App\Models\Book;
use App\Models\Author;
use App\Models\Member;
use App\Models\Catalog;
use App\Models\Publisher;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(){
        $memberTotal = Member::count();
        $bookTotal = Book::count();
        $transactionTotal = Transaction::whereMonth('date_start', date('m'))->count();
        $publisherTotal = Publisher::count();

        $pieDatas = Book::select(DB::raw("COUNT(publisher_id) as total"))->groupBy('publisher_id')->orderBy('publisher_id', 'asc')->pluck('total');
        $pieLabel = Publisher::orderBy('publishers.id', 'asc')->join('books', 'books.publisher_id', '=', 'publishers.id')->groupBy('name')->pluck('name');
        // $dataDonut = Book::select(DB::raw("COUNT(publisher_id) as total"))->groupBy('publisher_id')->orderBy('publisher_id', 'asc')->pluck('total');
        // $labelDonut = Publisher::orderBy('publishers.id', 'asc')->join('books', 'books.publisher_id', '=', 'publishers.id')->groupBy('name')->pluck('name');
        $labelBar = ['Transactions'];
        $dataBar = [];
        $dataDonut = Book::select(DB::raw("COUNT(catalog_id) as total"))->groupBy('catalog_id')->orderBy('catalog_id', 'asc')->pluck('total');
        $labelDonut = Catalog::orderBy('catalogs.id', 'asc')->join('books', 'books.catalog_id', '=', 'catalogs.id')->groupBy('name')->pluck('name');
        // $pieDatas = Book::select(DB::raw("COUNT(catalog_id) as total"))->groupBy('catalog_id')->orderBy('catalog_id', 'asc')->pluck('total');
        // $pieLabel = Catalog::orderBy('catalogs.id', 'asc')->join('books', 'books.catalog_id', '=', 'catalogs.id')->groupBy('name')->pluck('name');

        foreach ($labelBar as $key => $value) {
            $dataBar[$key]['label'] = $labelBar[$key];
            $dataBar[$key]['backgroundColor'] = 'rgba(60, 141, 188, 0.9)';
            $dataMonth = [];

            foreach (range(1, 12) as $month) {
                $dataMonth[] = Transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_start', $month)->first()->total;
            }

            return view('admin.dashboard', compact('memberTotal', 'bookTotal', 'transactionTotal', 'publisherTotal', 'dataDonut', 'labelDonut', 'dataBar', 'labelBar', 'dataBar', 'pieLabel', 'pieDatas'));
        }
    }

    public function index(){


        return view('home');
        
    }
}
