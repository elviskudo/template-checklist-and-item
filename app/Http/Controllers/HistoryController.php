<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Helpers;

use App\History;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $options = [
            'url' => $request->url(),
            'pagination' => true,
            'limit' => (int) $request->limit,
            'page' => (int) $request->page,
        ];

        $model = History::all();

        return Helpers::myTransformer($model, $options);
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
        $this->validate($request, [
            'loggable_type' => 'required',
            'loggable_id' => 'required',
            'action' => 'required',
            'kwuid' => 'required',
            'value' => 'required',
        ]);

        $model = new History;
        $model->fill($request->all());
        $model->save();

        return response()->json($model);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $options = [
            'url' => $request->url()
        ];

        $model = History::find($id);

        return Helpers::singleTransformer($model->toArray(), $options);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
