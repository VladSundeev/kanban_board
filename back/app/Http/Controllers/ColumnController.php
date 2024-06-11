<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\Request;

class ColumnController extends Controller
{

    public function index()
    {
        return response()->json(Column::with('tasks')->get(), 200);
    }


    public function store(Request $request)
    {
        $column = Column::create($request->all());
        return response()->json($column, 201);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
