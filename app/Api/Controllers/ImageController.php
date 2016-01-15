<?php

namespace App\Api\Controllers;

use App\Repositories\ImageRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use itbdw\QiniuStorage\QiniuStorage;

class ImageController extends Controller
{
    protected $imageRepo;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepo = $imageRepository;
    }

    // get all the personal images
    public function index()
    {

    }

    // upload personal image
    public function upload(){

    }

    // delete personal image
    public function delete(){

    }
}
