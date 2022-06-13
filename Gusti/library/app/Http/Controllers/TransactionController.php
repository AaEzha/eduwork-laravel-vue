<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;

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

        $transactions = Transaction::select('transactions.id', 'date_start', 'date_end', 'members.name', 
            DB::raw('DATEDIFF(date_end, date_start) as priode'),
            DB::raw('SUM(book_transaction.qty) as total_book'),
            DB::raw('SUM(book_transaction.qty * price) as total_price'), 'status')
            ->leftJoin('members', 'transactions.member_id', 'members.id')
            ->leftJoin('book_transaction', 'book_transaction.transaction_id', 'transactions.id')
            ->leftJoin('books', 'book_transaction.book_id', 'books.id')
            ->groupBy(['transactions.id','members.name', 'date_start']);

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
    public function store(Request $request)
    {
        $data = $request->all();
        $transaction = new Transaction;
        $transaction->member_id = $data['member'];
        $transaction->date_start = $data['date_start'];
        $transaction->date_end = $data['date_end'];
        $transaction->status = 0;
        $transaction->save();


        if (count($data['books']) > 0) {
            foreach ($data['books'] as $item => $value) {
                $data2 = array(
                    'transaction_id' => $transaction->id,
                    'book_id' => $data['books'][$item],
                    'qty' => '1'
                );
                $transaction->books()->attach($value);
                TransactionDetail::create($data2);
            }
        }
        $qty = $data['books'];
        // Jika hanya satu buku yang dipinjam
        if (COUNT(array($qty)) == 1) {
            DB::table('books')->where('id', $qty)->decrement('qty');
        }
        // Jika ada lebih dari satu buku yang dipinjam
        if (COUNT($qty) > 1) {
            foreach ($qty as $id) {
                DB::table('books')->where('id', $id)->decrement('qty');
            }
        }
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
        $transactions = Transaction::select('transactions.id', 'books.title', 'date_start', 'date_end', 'members.name', DB::raw('DATEDIFF(date_end, date_start) as priode'), 'book_transaction.qty as total_book', DB::raw('(book_transaction.qty * price) as total_price'), 'status')
            ->leftJoin('members', 'transactions.member_id', 'members.id')
            ->leftJoin('book_transaction', 'book_transaction.transaction_id', 'transactions.id')
            ->leftJoin('books', 'book_transaction.book_id', 'books.id')
            ->where('transactions.id', $transaction->id)
            ->groupBy(['transactions.id','members.name', 'date_start'])
            ->get();

        return view('admin.transaction.show', ['transactions' => $transactions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return view(
            'admin.transaction.edit',
            [
                'transaction' => $transaction,
                'members' => Member::get(),
                'books' => Book::select('books.id', 'title')
                    ->where('books.qty', '>=', '1')
                    ->get(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->validated();
        $data['member_id'] = $request->member;
        $data['date_start'] = $request->date_start;
        $data['date_end'] = $request->date_end;
        $data['book_id'] = $request->books;
        $data['status'] = $request->status;
        //$borrowed = $transaction->books()->pluck('book_id');

        // Perubahan jumlah buku yang dipinjam
        // $transaction->books()->sync($request->books);

        // Jika tidak ada perubahan "Status"
        if ($transaction->status == 1 && $data['status'] ==  1 || $transaction->status == 0 && $data['status'] ==  0) {

            $transaction->update($data);
            $transaction->books()->sync(request('books'));
        }
        // Jika "Status" diubah dari Not Returned ke Returned
        // maka tambahkan qty pada table books
        if ($transaction->status == 0 && $data['status'] ==  1) {
            $transaction->update($data);
            $transaction->books()->sync(request('books'));

            //jika buku yang dikembalikan hanya satu (1)
            if (COUNT($data['book_id']) == 1) {
                DB::table('books')->where('id', $data['book_id'])->increment('qty');
            }

            //jika buku yang dikembalikan lebih dari satu (> 1)
            if (COUNT($data['book_id']) > 1) {

                foreach ($data['book_id'] as $id) {

                    DB::table('books')->where('id', $id)->increment('qty');
                }
            }
        }
        // Jika buku diubah dari status Returned ke Not Returned
        if ($transaction->status == 1 && $data['status'] ==  0) {
            $transaction->update($data);
            $transaction->books()->sync(request('books'));

            // Jika data yang diubah hanya satu (1)
            if (COUNT($data['book_id']) == 1) {

                DB::table('books')->where('id', $data['book_id'])->decrement('qty');
            }

            // Jika data yang diubah lebih dari satu (>1)
            if (COUNT($data['book_id']) > 1) {

                foreach ($data['book_id'] as $id) {
                    DB::table('books')->where('id', $id)->decrement('qty');
                }
            }
        }
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
        //
    }
}
