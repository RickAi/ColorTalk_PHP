<?php
/**
 * User : YuGang Yang
 * Date : 7/27/15
 * Time : 15:26
 * Email: smartydroid@gmail.com
 */

return [
    'disable_routes' => false,
    'auth' => [
        'administrator_table' => 'users',
        'administrator_auth_controller' => 'Forone\Admin\Controllers\Auth\AuthController'
    ],
    'site_config' => [
        'site_name' => '',
        'title' => 'ColorTalk Console',
        'description' => 'Color Talk information management system',
        'logo' => 'vendor/forone/images/logo.png'
    ],
    'RedirectAfterLoginPath' => 'admin/roles', // 登录后跳转页面
    'RedirectIfAuthenticatedPath' => 'admin/roles', // 如果授权后直接跳转到指定页面

    'menus' => [
        'System config' => [
            'icon' => 'mdi-toggle-radio-button-on',
            'permission' => 'admin',
            'children' => [
                'Roles' => [
                    'uri' => 'roles',
                ],
                'Permissions' => [
                    'uri' => 'permissions',
                ],
                'Managers' => [
                    'uri' => 'admins',
                ]
            ],
        ],
    ],

    'qiniu' => [

        'host' => env('QINIU_HOST', 'http://7xlntj.com2.z0.glb.qiniucdn.com/'), //your qiniu host url
        'access_key' => env('QINIU_AK', '7uuXy55ekyLfIw9gwI2Jr4Oin_9qHIQQfXi4ijL1'), //for test
        'secret_key' => env('QINIU_SK', 'FX8P2NE_iE2TR0pwMkK1f3ZErGqGlsmjffCOIZUq'), //for test
        'bucket' => env('QINIU_BT', 'poly')
    ]
];