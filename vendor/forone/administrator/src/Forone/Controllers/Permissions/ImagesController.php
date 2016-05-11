<?php
/**
 * User : YuGang Yang
 * Date : 6/10/15
 * Time : 18:49
 * Email: smartydroid@gmail.com
 */

namespace Forone\Admin\Controllers\Permissions;

use App\Image;
use Forone\Admin\Controllers\BaseController;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class ImagesController extends BaseController {

    function __construct()
    {
        parent::__construct('images', 'image');
    }

    public function index()
    {
        $results = [
            'columns' => [
                ['Id', 'id'],
                ['Create time', 'created_at'],
                ['Update time', 'updated_at'],
                ['Operation', 'buttons', function ($data) {
                    $buttons = [
                        ['Detail'],
                        ['Delete'],
                    ];
                    return $buttons;
                }]
            ]
        ];
        $paginate = Image::orderBy('id')->paginate();
        $results['items'] = $paginate;

        return $this->view('forone::' . $this->uri.'.index', compact('results'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Image::find($id);
        if ($data) {
            return view('forone::' . $this->uri."/edit", compact('data'));
        } else {
            return $this->redirectWithError('data not found.');
        }
    }

    public function destroyImage(Image $image){
        $image->delete();
        return $this->toIndex('Delete success!');
    }

    public function show(Image $image){
        return $this->view('forone::' . $this->uri . '.show');
    }

}