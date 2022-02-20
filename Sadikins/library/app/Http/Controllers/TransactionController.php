<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TransactionRequest;

class transactionController extends Controller
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

        $transactions = Transaction::select('transactions.id', 'date_start', 'date_end', 'members.name', DB::raw('DATEDIFF(date_end, date_start) as priode'), DB::raw('SUM(book_transaction.qty) as total_book'), DB::raw('SUM(book_transaction.qty * price) as total_price'), 'status')
            ->leftJoin('members', 'transactions.member_id', 'members.id')
            ->leftJoin('book_transaction', 'book_transaction.transaction_id', 'transactions.id')
            ->leftJoin('books', 'book_transaction.book_id', 'books.id')
            ->groupBy(['members.name', 'date_start']);

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
                return '<button class="btn btn-sm btn-inverse-danger py-1">Not Returned</button>';
            } elseif ($transaction->status == 1) {
                return '<button class="btn btn-sm btn-secondary py-1">Returned</button>';
            }
        })->addColumn('priode', function ($transaction) {
            return $transaction->priode . ' <small class="text-secondary">days</small>';
        })->addColumn('total_book', function ($transaction) {
            if ($transaction->total_book <= 1) {
                return $transaction->total_book . ' <small class="text-secondary">book</small>';
            } else {
                return $transaction->total_book . ' <small class="text-secondary">books</small>';
            }
        })
            ->rawColumns(['status', 'priode', 'total_book'])->addIndexColumn();
        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::get();
        $books = Book::select('id', 'title')->where('qty', '>=', '1')->get();
        $transaction = new Transaction();
        return view('admin.transaction.create', compact('transaction', 'books', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $data = $request->validated();
        $data['member_id'] = $request->member;
        $data['date_start'] = $request->date_start;
        $data['date_end'] = $request->date_end;
        $data['book_id'] = $request->books;


        $transaction = Transaction::create($data);
        $transaction->books()->attach($request->books);
        $qty = $data['book_id'];
        DB::table('books')->where('id', $qty)->decrement('qty');

        return redirect('transactions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $transactions = Transaction::select('transactions.id', 'books.title', 'date_start', 'date_end', 'members.name', DB::raw('DATEDIFF(date_end, date_start) as priode'), 'book_transaction.qty as total_book', DB::raw('(book_transaction.qty * price) as total_price'), 'status')
            ->leftJoin('members', 'transactions.member_id', 'members.id')
            ->leftJoin('book_transaction', 'book_transaction.transaction_id', 'transactions.id')
            ->leftJoin('books', 'book_transaction.book_id', 'books.id')
            ->where('transactions.id', $transaction->id)
            ->groupBy(['members.name', 'date_start'])
            ->get();



        return view('admin.transaction.show', ['transactions' => $transactions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(transaction $transaction)
    {

        return view('admin.transaction.edit', ['transaction' => $transaction, 'members' => Member::get(), 'books' => Book::select('id', 'title')->where('qty', '>=', '1')->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, transaction $transaction)
    {



        $data = $request->validated();


        // Jika status sudah Return dan tidak dilakukan perubahan maka update tanpa perhitungan pad books -> qty
        if ($transaction->status == 1 && $data['status'] ==  1) {
            $data['member_id'] = $request->member;
            $data['date_start'] = $request->date_start;
            $data['date_end'] = $request->date_end;
            $data['book_id'] = $request->books;

            $transaction->update($data);
            $transaction->books()->sync(request('books'));
            // Jika status  Not Return dan diubah ke Return maka tambah data (book-> qty + 1)
        } elseif ($transaction->status == 0 && $data['status'] == 1) {
            $data['member_id'] = $request->member;
            $data['date_start'] = $request->date_start;
            $data['date_end'] = $request->date_end;
            $data['status'] = $request->status;
            $data['book_id'] = $request->books;

            $transaction->update($data);
            $transaction->books()->sync(request('books'));
            foreach ($data['book_id'] as $id) {

                DB::table('books')->where('id', $id)->increment('qty');
            }

            // Jika status sudah Return diubah ke Not Return maka kurangai qty di table books (books -> qty - 1)
        } elseif ($transaction->status == 1 && $data['status'] ==  0) {
            $data['member_id'] = $request->member;
            $data['date_start'] = $request->date_start;
            $data['date_end'] = $request->date_end;
            $data['status'] = $request->status;
            $data['book_id'] = $request->books;
            $transaction->update($data);
            $transaction->books()->sync(request('books'));
            foreach ($data['book_id'] as $id) {
                DB::table('books')->where('id', $id)->decrement('qty');
            }


            // Jika status sudah Not Return dan tidak dilakukan perubahan maka update tanpa perhitungan pad books -> qty
        } elseif ($transaction->status == 0 && $data['status'] ==  0) {
            $data['member_id'] = $request->member;
            $data['date_start'] = $request->date_start;
            $data['date_end'] = $request->date_end;
            $data['book_id'] = $request->books;
            $transaction->update($data);
            $transaction->books()->sync(request('books'));
        } else {
            $data['member_id'] = $request->member;
            $data['date_start'] = $request->date_start;
            $data['date_end'] = $request->date_end;
            $data['status'] = $request->status;
            $data['book_id'] = $request->books;

            $transaction->update($data);
            $transaction->books()->sync(request('books'));
        }


        return redirect('transactions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaction $transaction)
    {
        $transaction->books()->detach();
        $transaction->delete();
        return redirect('transactions');
    }
}
