<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Catalog;
use App\Models\Member;
use App\Models\Publisher;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Assign;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthorController extends Controller
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

        $dataDonat = Book::select(DB::raw('COUNT(publisher_id) as total'))->groupBy('publisher_id')->orderBy('publisher_id', 'asc')->pluck('total');
        $labelDonat = Publisher::orderBy('publishers.id', 'asc')->join('books', 'books.publisher_id', '=', 'publishers.id')->groupBy('name')->pluck('name');
        $labelBar = ['transaction'];
        $dataBar = [];

        foreach ($labelBar as $key => $value) {
            $dataBar[$key]['label'] = $labelBar[$key];
            $dataBar[$key]['backgroundColor'] = 'rgba(60, 141, 188, 0.9)';
            $dataMonth = [];

            foreach (range(1, 12) as $month) {
                $dataMonth[] = Transaction::select(DB::raw('COUNT(*) as total'))->whereMonth('date_start', $month)->first()->total;
            }

            return view('admin.dashboard', compact('memberTotal', 'bookTotal', 'transactionTotal', 'publisherTotal'));
        }
    }

    public function catalog(){
        $dataCatalog = Catalog::all();
        return view('admin.catalog', compact('dataCatalog'));
    }

    public function test_spatie(){
        if (auth()->user()->can('index transactions')) {
            $books = Book::all();
            $members = Member::all();
            return view('admin.transaction.index', compact('books', 'members'));
        } else {
            return abort('403');
            // }
            // $role = Role::create(['name' => 'officer']);
            // $permission = Permission::create(['name' => 'index transactions']);

            // $role->givePermissionTo($permission);
            // $permission->assignRole($role);

            // $user = auth()->user();
            // $user->assignRole('officer');

            // $user = User::with('roles')->get();

            // $user = User::where('id', 2)->first();
            // $user->removeRole('officer');
            //return $user;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }
    public function api()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        //
    }
}
