<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index', compact('users'));
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
        $users = new User;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = md5($request->password);
        $users->is_admin = $request->is_admin;
        $users->save();
        if ($users) {
            return redirect()->back()->with('User Created Successfully');
        }
        return redirect()->back()->with('User Failed To Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(User $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(User $transaction)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $users = User::find($id);
        if (!$users) {
            return back()->with('Error', 'User not Found');
        }
        $users->update($request->all());
        return back()->with('Success', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        if (!$users) {
            return back()->with('Error', 'User not Found');
        }
        $users->delete();
        return back()->with('Success', 'User Deleted Successfully');
    }
    public function test_spatie()
    {
        // $role = Role::create(['name' => 'cashier']);
        // $permission = Permission::create(['name' => 'cashier page']);
        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);
        // $user = auth()->user();
        // $user->assignRole('cashier');
        // return $user;
        $user = User::with('roles')->get();
        return $user;
        // $user = auth()->user();
        // $user->removeRole('admin');
    }
}
