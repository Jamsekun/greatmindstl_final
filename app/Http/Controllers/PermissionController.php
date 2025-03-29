<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    
    public function load(Request $request)
    {
        $model = \Permission::where(function ($query) use($request) {

        })
        ->select([
            'id',
            'name',
            'title',
            'description',
            'is_default'
        ])
        ->get();

        return $model;
    }

}
