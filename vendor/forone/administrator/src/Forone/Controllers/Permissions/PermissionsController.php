<?php
/**
 * User : YuGang Yang
 * Date : 6/10/15
 * Time : 18:49
 * Email: smartydroid@gmail.com
 */

namespace Forone\Admin\Controllers\Permissions;

use Forone\Admin\Controllers\BaseController;
use Forone\Admin\Permission;
use Forone\Admin\Requests\CreatePermissionRequest;
use Forone\Admin\Requests\UpdatePermissionRequest;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class PermissionsController extends BaseController {

    function __construct()
    {
        parent::__construct('permissions', 'permission');
    }

    public function index()
    {
        $results = [
            'columns' => [
                ['Id', 'id'],
                ['Name', 'name'],
                ['Nickname', 'display_name'],
                ['Create time', 'created_at'],
                ['Update time', 'updated_at'],
                ['Operation', 'buttons', function ($data) {
                    $buttons = [
                        ['Edit'],
                    ];
                    return $buttons;
                }]
            ]
        ];
        $paginate = Permission::orderBy('id','desc')->paginate();
        $results['items'] = $paginate;

        return $this->view('forone::' . $this->uri.'.index', compact('results'));
    }

    /**
     *
     * @return View
     */
    public function create()
    {
        return $this->view('forone::'.$this->uri.'.create');
    }

    /**
     *
     * @param CreateRoleRequest $request
     * @return View
     */
    public function store(CreatePermissionRequest $request)
    {
        Permission::create($request->except('id', '_token'));
        return $this->toIndex('save success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Permission::find($id);
        if ($data) {
            return view('forone::' . $this->uri."/edit", compact('data'));
        } else {
            return $this->redirectWithError('data not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {

        $data = $request->except('_token');
        Permission::findOrFail($id)->update($data);

        return $this->toIndex('编辑成功');
    }

}