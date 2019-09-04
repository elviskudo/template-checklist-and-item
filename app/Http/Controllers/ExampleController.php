<?php

namespace App\Http\Controllers;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

use App\User;
use App\Transformers\UsersTransformer;

class ExampleController extends Controller
{
    private $fractal;
    private $usersTransformer;
    private $users;
    protected $limit;
    protected $page;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Manager $fractal, User $users, UsersTransformer $usersTransformer)
    {
        $this->fractal = $fractal;
        $this->usersTransformer = $usersTransformer;
        $this->users = $users;
        $this->limit = 10;
        $this->page = 0;
    }

    public function index()
    {
        $model = $this
            ->users
            ->take($this->limit)
            ->skip($this->page)
            ->get();

        $users = new Collection($model, $this->usersTransformer);
        $users = $this->fractal->createData($users);

        return $users->toArray();
    }

    //
}
