<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use App\Models\Member;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.transaction.index');
    }
    public function api(Request $request)
    {
        //$transactions2 = Transaction::all();
        $transactions = Transaction::select(
            'transactions.id',
            'members.name',
            'date_start',
            'date_end',
            DB::raw('DATEDIFF(date_end, date_start) as duration'),
            DB::raw('SUM(book_transaction.qty) as total_book'),
            DB::raw('SUM(book_transaction.qty * books.price) as total_price'),
            'status'
        )
            ->leftJoin('members', 'transactions.member_id', 'members.id')
            ->leftJoin('book_transaction', 'book_transaction.transaction_id', 'transactions.id')
            ->leftJoin('books', 'book_transaction.book_id', 'books.id')
            ->groupBy(['transactions.id', 'members.name', 'date_start', 'date_end', 'status']);
        // Filter Status
        if ($request->status) {
            $datas = $transactions->where('status', $request->status)->get();
        } else {
            $datas = $transactions->get();
        }
        // Filter Date_start
        if ($request->date_start) {
            $datas = $transactions->where('date_start', $request->date_start)->get();
        } else {
            $datas = $transactions->get();
        }

        $datatables = datatables()->of($datas)->addColumn('rupiah', function ($transaction) {
            return rupiah($transaction->total_price);
        })->editColumn('status', function ($transaction) {
            if ($transaction->status == 0) {
                return '<p class="text-danger">Not Returned</p>';
            } elseif ($transaction->status == 1) {
                return '<p class="text-success">Returned</p>';
            }
        })->addColumn('duration', function ($transaction) {
            return $transaction->duration;
        })->addColumn('total_book', function ($transaction) {
            if ($transaction->total_book <= 1) {
                return $transaction->total_book;
            } else {
                return $transaction->total_book;
            }
        })
            ->rawColumns(['status', 'duration', 'total_book'])->addIndexColumn();
        return $datatables->make(true);
        // Notification::send($transactions2, new TransactionNotification($request->status));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::all();
        $books = Book::all();

        return view('admin.transaction.create', compact('members', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'member_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'selisih' => 'required',
        ]);

        Transaction::create($request->all());

        return redirect('transactions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transactions)
    {
        $this->validate($request, [
            'member_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'selisih' => 'required',

        ]);

        $transactions->update($request->all());

        return redirect('transactions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
    }
}
