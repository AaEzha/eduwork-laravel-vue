<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section as SectionModel;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sections.index');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($section_id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sections)
    {
        // dd($request->all());
        $sections = SectionModel::find($sections);
        $sections->section_name = $request->section_name;
        $sections->status = $request->section_status;
        if (!$request->has('section_status')) {
            $sections->status = "0";
        } else {
            $sections->status = "1";
        }
        $sections->update();

        return redirect()->back()->with('Success', 'Section Updated Sucessfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SectionModel $section)
    {
        $section->delete();
        return redirect()->back()->with('Success', 'Section Deleted Sucessfully!');
    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        SectionModel::whereIn('id', $ids)->delete();
        return response()->json(['success' => "Section deleted successfully."]);
    }
}
