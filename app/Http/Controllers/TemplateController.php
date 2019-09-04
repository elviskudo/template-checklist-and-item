<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Helpers;

use App\Template;
use DB;

use App\Item;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = [
            'url' => $request->url(),
            'pagination' => true,
            'limit' => (int) $request->limit,
            'page' => (int) $request->page,
        ];

        $model = Template::all();

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
            'name' => 'required',
            'checklist_id' => 'required',
            'item_id' => 'required'
        ]);

        $items = implode(',', $request->input('item_id'));

        $model = new Template;
        $model->name = $request->input('name');
        $model->checklist_id = $request->input('checklist_id');
        $model->item_id = $items;
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

        $model = DB::table('templates')
            ->leftJoin('checklists', 'checklists.id', 'templates.checklist_id')
            ->where('templates.id', $id)
            ->first();

        $ids = explode(',', $model->item_id);
        $items = Item::whereIn('id', $ids);

        $response = [
            'id' => $id,
            'name' => $model->name,
            'items' => $items,
            'checklists' => [
                'due_unit' => $model->due_unit,
                'due_interval' => $model->due_interval,
                'description' => $model->description,
            ]
        ];

        return Helpers::singleTransformer($response, $options);
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
