<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

use App\Item;
use App\Transformers\ItemTransformer;

class ItemController extends Controller
{
    private $fractal;
    private $itemTransformer;
    private $item;
    protected $limit;
    protected $page;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Manager $fractal, Item $item, ItemTransformer $itemTransformer)
    {
        $this->fractal = $fractal;
        $this->itemTransformer = $itemTransformer;
        $this->item = $item;
        $this->limit = 10;
        $this->page = 0;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = $this
            ->item
            ->take($this->limit)
            ->skip($this->page)
            ->get();

        $item = new Collection($model, $this->itemTransformer);
        $item = $this->fractal->createData($item);

        return $item->toArray();
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
            'description' => 'required'
        ]);

        $model = new Item;
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
    public function show($id)
    {
        $options = [
            'url' => $request->url()
        ];

        $model = Item::find($id);

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
