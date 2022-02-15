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

class AdminController extends Controller
{

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
        $data_line = Book::select(DB::raw("COUNT(author_id) as total"))->groupBy('author_id')->orderBy('author_id', 'ASC')->pluck('total');
        $label_line = Author::orderBy('authors.id', 'ASC')->join('books', 'books.author_id', 'authors.id')->groupBy('authors.name')->pluck('authors.name');

        // Line
        $label_bar = ['Borrowing', 'Returning'];
        $data_bar = [];

        foreach ($label_bar as $key => $value) {
            $data_bar[$key]['label'] = $label_bar[$key];
            $data_bar[$key]['backgroundColor'] = $key == 0 ? '#B983FF' : "#99FEFF";
            $data_month = [];

            foreach (range(1, 12) as $month) {
                if ($key == 0) {
                    $data_month[] = transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_start', $month)->first()->total;
                } else {
                    $data_month[] = transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_end', $month)->first()->total;
                }
            }
            $data_bar[$key]['data'] = $data_month;

            // return $data_bar;
        }
        return view('admin.dashboard', compact('total_books', 'total_members', 'total_transactions', 'total_publishers', 'data_donut', 'label_donut', 'data_bar', 'label_line', 'data_line'));
    }
    public function query()
    {
        // $members = Member::with('user')->get();
        // $books = Book::with('publisher', 'author', 'catalog')->get();
        // $publisher = Publisher::with('books')->get();
        // $catalog = Catalog::with('books')->get();
        $author = Author::with('books')->get();

        $data = Member::select('*')
            ->join('users', 'users.member_id', 'members.id')
            ->get();

        $data2 = Member::select('*')
            ->leftJoin('users', 'users.member_id', 'members.id')
            ->where('users.id', NULL)
            ->get();

        $data3 = Transaction::select('members.id', 'members.name')
            ->rightJoin('members', 'members.id', 'transactions.member_id')
            ->where('transactions.member_id', NULL)
            ->get();

        $data4 = Member::select('members.id', 'members.name', 'members.phone_number')
            ->join('transactions', 'transactions.member_id', 'members.id')
            ->orderBy('members.id', 'asc')
            ->get();

        $data5 = Transaction::select(DB::raw("COUNT(transactions.member_id) total, members.id, members.name, members.phone_number"))
            ->join('members', 'transactions.member_id', 'members.id')
            ->groupBy('transactions.member_id')
            ->havingRaw('COUNT(transactions.member_id) > 1')
            ->get();

        $data6 = Transaction::select('members.name', 'members.phone_number', 'members.address', 'date_start', 'date_end')
            ->leftJoin('members', 'transactions.member_id', 'members.id')
            ->orderBy('transactions.member_id', 'ASC')
            ->get();
        $data7 = Transaction::select('members.name', 'members.address', 'date_start', 'date_end')
            ->leftJoin('members', 'transactions.member_id', 'members.id')
            ->where(DB::raw('MONTH(transactions.date_start)'), '=', '02')
            ->orderBy('transactions.id', 'ASC')
            ->get();
        $data8 = Transaction::select('members.name', 'members.phone_number', 'transactions.date_start', 'transactions.date_end')
            ->leftJoin('members', 'transactions.member_id', 'members.id')
            ->where(DB::raw('MONTH(transactions.date_start)'), '=', '05')
            ->orderBy('transactions.member_id', 'ASC')
            ->get();

        $data9 = Transaction::select('name', 'phone_number', 'date_start', 'date_end')
            ->leftJoin('members', 'transactions.member_id', 'members.id')
            ->where(DB::raw('MONTH(transactions.date_end)'), '02')
            ->orderBy('transactions.member_id', 'ASC')
            ->get();
        $data10 = Transaction::select('name', 'phone_number', 'date_start', 'date_end')
            ->join('members', 'transactions.member_id', 'members.id')
            ->where('address', 'like', '%Rahsaan%')
            ->orderBy('transactions.member_id', 'ASC')
            ->get();
        $data11 = Transaction::select('name', 'phone_number', 'date_start', 'date_end')
            ->join('members', 'transactions.member_id', 'members.id')
            ->where('address', 'like', '%Rahsaan%')
            ->where('gender', 'F')
            ->orderBy('transactions.member_id', 'ASC')
            ->get();

        $data12 = Transaction::select('name', 'phone_number', 'address', 'date_start', 'date_end', 'books.isbn', 'transaction_details.qty')
            ->join('members', 'transactions.member_id', 'members.id')
            ->join('transaction_details', 'transactions.id', 'transaction_details.transaction_id')
            ->join('books', 'transaction_details.book_id', 'books.id')
            ->havingRaw('transaction_details.qty > 1')
            ->orderBy('transaction_details.qty', 'DESC')
            ->get();
        $data13 = Transaction::select('name', 'phone_number', 'address', 'date_start', 'date_end', 'books.isbn', 'transaction_details.qty', 'title', 'price', DB::raw('(transaction_details.qty * price) as total_price'))
            ->join('members', 'transactions.member_id', 'members.id')
            ->join('transaction_details', 'transactions.id', 'transaction_details.transaction_id')
            ->join('books', 'transaction_details.book_id', 'books.id')
            ->orderBy('transaction_details.qty', 'DESC')
            ->get();

        $data14 = Transaction::select('members.name', 'members.phone_number', 'members.address', 'date_start', 'date_end', 'books.isbn', 'transaction_details.qty', 'title', 'publishers.name', 'authors.name', 'catalogs.name')
            ->join('members', 'members.id', 'transactions.member_id')
            ->join('transaction_details', 'transaction_details.transaction_id', 'transactions.id')
            ->join('books', 'transaction_details.book_id', 'books.id')
            ->join('publishers', 'books.publisher_id', 'publishers.id')
            ->join('authors', 'books.author_id', 'authors.id')
            ->join('catalogs', 'books.catalog_id', 'catalogs.id')
            ->orderBy('transaction_details.qty', 'DESC')
            ->get();
        $data15 = Catalog::select('catalogs.id', 'name', 'title')
            ->rightJoin('books', 'books.catalog_id', 'catalogs.id')
            ->orderBy('catalogs.id')
            ->get();

        $data16 = Book::select('isbn', 'title', 'year', 'books.publisher_id', 'author_id', 'catalog_id', 'books.qty', 'price', 'publishers.name')
            ->leftJoin('publishers', 'publishers.id', 'books.publisher_id')
            ->orderBy('books.publisher_id')
            ->get();

        $data17 = Book::select(DB::raw('COUNT(books.author_id) as total'), 'books.author_id')
            ->join('authors', 'authors.id', 'books.author_id')
            ->where('books.author_id', '2')
            ->orderBy('books.author_id')
            ->get();
        $data18 = Book::select('*')
            ->havingRaw('price > 10000')
            ->orderBy('price', 'DESC')
            ->get();
        $data19 = Book::select('isbn', 'title', 'books.publisher_id', 'author_id', 'catalog_id', 'books.qty', 'price', 'publishers.name')
            ->join('publishers', 'books.publisher_id', 'publishers.id')
            ->where('publishers.name', 'Modesto Abshire')
            ->havingRaw('books.qty > 10')
            ->get();
        $data20 = Member::select('*')
            ->whereMonth('created_at', '02')
            ->get();



        return $data20;
        return view('admin/dashboard');
    }
}
