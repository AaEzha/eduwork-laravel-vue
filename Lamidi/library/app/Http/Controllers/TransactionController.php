<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TransactionRequest;
use App\Models\TransactionDetail;
use Illuminate\Notifications\Notification;
use App\Notifications\TransactionNotification;

use function GuzzleHttp\Promise\all;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Get everything we need in order to load Grocery CRUD
     *
     * @return GroceryCrud
     * @throws \GroceryCrud\Core\Exceptions\Exception
     */

    /**
     * Grocery CRUD Output
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    /**
     * Get database credentials as a Zend Db Adapter configuration
     * @return array[]
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        return view('admin.transaction.index');
    }
    public function api(Request $request)
    {
        $transactions2 = Transaction::all();
        $transactions = Transaction::select(
            'transactions.id',
            'members.name',
            'date_start',
            'date_end',
            DB::raw('DATEDIFF(date_end, date_start) as duration'),
            DB::raw('SUM(transaction_details.qty) as total_book'),
            DB::raw('SUM(transaction_details.qty * books.price) as total_price'),
            'status'
        )
            ->leftJoin('members', 'transactions.member_id', 'members.id')
            ->leftJoin('transaction_details', 'transaction_details.transaction_id', 'transactions.id')
            ->leftJoin('books', 'transaction_details.book_id', 'books.id')
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
        //dd($data);
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
        $transactions = Transaction::select(
            'transactions.id',
            'members.name',
            'books.title',
            'date_start',
            'date_end',
            DB::raw('DATEDIFF(date_end, date_start) as duration', 'transaction_details.qty as total_book'),
            DB::raw('SUM(transaction_details.qty * books.price) as total_price'),
            'status'
        )
            ->leftJoin('members', 'transactions.member_id', 'members.id')
            ->leftJoin('transaction_details', 'transaction_details.transaction_id', 'transactions.id')
            ->leftJoin('books', 'transaction_details.book_id', 'books.id')
            ->where('transactions.id', $transaction->id)
            ->groupBy(['transactions.id', 'members.name', 'books.title', 'date_start', 'date_end', 'status'])
            ->get();
        return view('admin.transaction.show', compact('transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {

        // $members = Member::get();
        // $books = TransactionDetail::select('books.id', 'books.title')
        //     ->leftjoin('books', 'transaction_details.book_id', 'books.id')
        //     ->where('books.qty', '>=', '1')
        //     ->get();
        return view(
            'admin.transaction.edit',
            // compact('transaction', 'members', 'books'));
            [
                'transaction' => $transaction,
                // 'transaction_detail' => TransactionDetail::get(),
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
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $data = $request->validated();

        $data['member_id'] = $request->member;
        $data['date_start'] = $request->date_start;
        $data['date_end'] = $request->date_end;
        $data['book_id'] = $request->books;
        $data['status'] = $request->status;
        $borrowed = $transaction->books()->pluck('book_id');

        // Perubahan jumlah buku yang dipinjam 
        if ($borrowed > $request->books) {
            return  $request->books;
        }

        // Jika tidak ada perubahan "Status"
        if ($transaction->status == 1 && $data['status'] ==  1 || $transaction->status == 0 && $data['status'] ==  0) {
            $transaction->update($data);
            $transaction->bookss()->sync(request('books'));
        }

        // Jika "Status" diubah dari Not Returned ke Returned 
        // maka tambahkan qty pada table transaction_details
        if ($transaction->status == 0 && $data['status'] ==  1) {
            $transaction->update($data);
            $transaction->transaction_details()->sync(request('transaction_details'));

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
                    DB::table('book')->where('id', $id)->decrement('qty');
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
    public function destroy(TransactionRequest $request, Transaction $transaction)
    {
        $data = $request->validated();
        $data['book_id'] = $request->books;
        $transaction->books()->detach();
        $transaction->delete();

        //jika Transaksi yang dihapus hanya satu (1)
        if (COUNT($data['book_id']) == 1) {
            DB::table('books')->where('id', $data['book_id'])->increment('qty');
        }

        //jika Transaksi yang dihapus lebih dari satu (> 1)
        if (COUNT($data['book_id']) > 1) {

            foreach ($data['book_id'] as $id) {

                DB::table('books')->where('id', $id)->increment('qty');
            }
        }
        return redirect('transactions');
    }
}
