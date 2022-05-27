<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Catalog;
use App\Models\Member;
use App\Models\Publisher;
use App\Models\Transaction;
use Illuminate\Http\Request;
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
        // $member = Member::with('user')->get();
        // $book = Book::with('publisher')->get();
        // $publisher = Publisher::with('books')->get();
        // $author = Author::with('books')->get();
        // $catalog = Catalog::with('books')->get();

        //no1
        $data = Member::select('*')
                        ->join('users', 'users.member_id', '=', 'members.id')
                        ->get();

        //no2
        $data2 = Member::select('*')
                        ->leftJoin('users', 'users.member_id', '=', 'members.id')
                        ->where('users.id', NULL)
                        ->get();
        //no3
        $data3 = Transaction::select('members.id', 'members.name')
                        ->rightJoin('members', 'members.id', '=', 'transactions.member_id')
                        ->where('transactions.member_id', NULL)
                        ->get();
        //no4
        $data4 = Member::select('members.id', 'members.name', 'members.phone_number')
                        ->join('transactions', 'transactions.member_id', '=', 'members.id')
                        ->orderBy('members.id', 'asc')
                        ->get();
        //no5
        $data5 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'members.created_at', 'members.updated_at')
                        ->join('transactions', 'transactions.member_id', '=', 'member_id')
                        ->orderBy('members.created_at')
                        ->get();
        //no6
        $data6 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'members.created_at', 'members.updated_at')
                        ->join('transactions', 'transactions.member_id', '=', 'member_id')
                        ->where('members.created_at', 'between', '2022-05-18', 'and', '2022-05-20')
                        ->get();
        //no7
        $data7 =Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'members.created_at', 'members.updated_at')
                        ->join('transactions', 'transactions.member_id', '=', 'member_id')
                        ->where('members.updated_at', 'between', '2022-06-18', 'and', '2022-06-20')
                        ->get();
        //no8
        $data8 =Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'members.created_at', 'members.updated_at')
                        ->join('transactions', 'transactions.member_id', '=', 'member_id')
                        ->where('members.created_at', 'between', '2022-05-18', 'and', '2022-05-20')
                        ->where('members.updated_at', 'between', '2022-06-18', 'and', '2022-06-20')
                        ->get();
        //no9
        $data9 =Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'members.created_at', 'members.updated_at')
                        ->join('transactions', 'transactions.member_id', '=', 'member_id')
                        ->where('members.address', 'like', '%Bandung%', 'and', 'members.gender', '=', '1')
                        ->get();
        // return $data9;

        return view('home');
    }
}
