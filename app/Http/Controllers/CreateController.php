<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbomRequest;

class CreateController extends Controller
{
    public function index()
    {
        return view('create.index');
    }

    public function albom(AlbomRequest $request)
    {

    }

    public function create()
    {

    }
}
