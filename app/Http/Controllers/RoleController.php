<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    
    public function load(Request $request)
    {
        $model = \Role::where(function ($query) use($request) {

        })
        ->select([
            'id',
            'name',
            'title'
        ])
        ->get();

        return $model;
    }

}
