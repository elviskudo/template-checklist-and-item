<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

use App\Libraries\Helpers;

use App\Checklist;
use App\Transformers\ChecklistTransformer;

class ChecklistController extends Controller
{
    private $fractal;
    private $checklistTransformer;
    private $checklist;
    protected $limit;
    protected $page;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Manager $fractal, Checklist $checklist, ChecklistTransformer $checklistTransformer)
    {
        $this->fractal = $fractal;
        $this->checklistTransformer = $checklistTransformer;
        $this->checklist = $checklist;
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
            ->checklist
            ->take($this->limit)
            ->skip($this->page)
            ->get();

        $checklist = new Collection($model, $this->checklistTransformer);
        $checklist = $this->fractal->createData($checklist);

        return $checklist->toArray();
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
            'object_domain' => 'required',
            'object_id' => 'required',
            'description' => 'required'
        ]);

        $model = new Checklist;
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

        $model = Checklist::find($id);

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
