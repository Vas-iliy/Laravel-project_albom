<?php

namespace App\Http\Controllers;

use App\Core\services\AlbomService;
use App\Http\Requests\AlbomRequest;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    private $service;

    public function __construct(AlbomService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('create.index');
    }

    public function albom(AlbomRequest $request)
    {
        $alboms = $this->service->searchAlbom($request);
        return view('create.albom', compact('alboms'));
    }

    public function create(Request $request)
    {
        dd($request->all());
    }
}
