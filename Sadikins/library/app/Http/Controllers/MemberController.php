<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class memberController extends Controller
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
        $members = Member::all();
        // return $catalogs;
        return view('admin.member', compact('members'));
    }

    public function api()
    {
        $members = Member::all();
        $datatables = datatables()->of($members)->addIndexColumn();
        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            ['name' => 'required|min:5|string'],
            ['gender' => 'required'],
            ['phone_number' => 'required'],
            ['address' => 'required|max:50'],
            ['email' => 'required|email'],
        );
        Member::create($request->all());
        return redirect('members');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(member $member)
    {
        return view('admin.member.edit', ['member' => $member]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, member $member)
    {
        $this->validate(
            $request,
            ['name' => 'required|min:5|string'],
            ['gender' => 'required'],
            ['phone_number' => 'required'],
            ['address' => 'required|max:50'],
            ['email' => 'required|email'],
        );
        $member->update($request->all());
        return redirect('members');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(member $member)
    {
        $member->delete();
        return redirect('members');
    }
}
