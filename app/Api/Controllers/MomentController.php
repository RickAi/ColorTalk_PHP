<?php

namespace App\Api\Controllers;

use App\Api\Transformers\MomentTransformer;
use App\Moment;
use App\Repositories\MomentRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class MomentController extends BaseController
{
    protected $momentRepo;

    public function __construct(MomentRepository $momentRepository)
    {
        $this->momentRepo = $momentRepository;
    }

    // get all the moments
    public function getMoments(Request $request)
    {
        $check_result = $this->requestCheck($request,
            ['user_id' => 'required']);
        if (!$check_result['result']) {
            return $this->response->error($check_result['message'], 422);
        }

        $payload = $request->all();

        $moments = Moment::orderBy('created_at', 'desc')->paginate(10);
        return $this->paginator($moments, new MomentTransformer($payload['user_id']));
    }

    // create a new moment
    public function create(Request $request)
    {
        $check_result = $this->requestCheck($request,
            ['user_id' => 'required', 'image_name' => 'required']);
        if (!$check_result['result']) {
            return $this->response->error($check_result['message'], 422);
        }

        $payload = $request->all();
        $result_array = $this->momentRepo->createNewMoment($payload);
        if ($result_array['result']) {
            $moment = $result_array['content'];
            return response()->json($moment);
        } else {
            return $this->response->error($result_array['message'], 422);
        }
    }

    // delete a moment
    public function delete()
    {

    }

    public function likeMoment(Request $request, Moment $moment){
        $check_result = $this->requestCheck($request,
            ['user_id' => 'required']);
        if (!$check_result['result']) {
            return $this->response->error($check_result['message'], 422);
        }

        $payload = $request->all();
        $result_array = $this->momentRepo->likeMoment($payload, $moment);
        if ($result_array['result']) {
            $moment = $result_array['content'];
            return response()->json($moment);
        } else {
            return $this->response->error($result_array['message'], 422);
        }
    }

}
