<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // auth()->user();
        $menuList = [
            [
                'uri' => '/users',
                'icon' => 'fa-user',
                'label' => 'Users',
            ],
            [
                'uri' => '/images',
                'icon' => 'fa-image',
                'label' => 'Images',
            ],
            [
                'uri' => '/posts',
                'icon' => 'fa-newspaper',
                'label' => 'Posts',
            ],
        ];
        return view('admin.index', ['menuList' => $menuList]);
    }
}
