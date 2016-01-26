<?php

namespace App\Api\Controllers;

use App\Api\Transformers\ImageTransformer;
use App\Image;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class ImageController extends BaseController
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

    public function getPrivateImages(Request $request)
    {
        $check_result = $this->requestCheck($request, ['user_id' => 'required']);
        if (!$check_result['result']) {
            return $this->response->error($check_result['message'], 422);
        }

        $payload = $request->all();
        $images = Image::getPrivateImages($payload['user_id']);
        return $this->collection($images, new ImageTransformer);
    }

    // upload personal image
    public function upload()
    {

    }

    // delete personal image
    public function delete()
    {

    }
}
