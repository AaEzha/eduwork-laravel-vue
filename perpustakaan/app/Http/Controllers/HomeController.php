<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Catalog;
use App\Models\Member;
use App\Models\Publisher;
use App\Models\Transaction;
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
