<?php

namespace App\Http\Controllers;

use App\Core\services\AlbomService;
use App\Http\Requests\AlbomCreateRequest;
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
        $alboms = $this->service->searchAlboms($request);
        return view('create.albom', compact('alboms'));
    }

    public function create(Request $request)
    {
        $albom = $this->service->getAlbomInfo($request);
        return view('create.new-albom', compact('albom'));
    }

    public function store(AlbomCreateRequest $request)
    {
        $this->service->create($request);
        return redirect()->home()->with('success', 'Альбом добавлен');
    }
}
