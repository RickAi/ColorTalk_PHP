<?php

namespace App\Api\Controllers;

use App\Repositories\MomentRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MomentController extends Controller
{
    protected $momentRepo;

    public function __construct(MomentRepository $momentRepository)
    {
        $this->momentRepo;
    }

    // get all the moments
    public function index()
    {

    }

    // create a new moment
    public function create(){

    }

    // delete a moment
    public function delete(){

    }

}
