<?php

namespace App\Http\Controllers;

use App\Core\repositories\AlbomRepository;
use App\Core\services\AlbomService;
use App\Http\Requests\AlbomCreateRequest;
use App\Http\Requests\AlbomRequest;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    private $service;
    private $alboms;

    public function __construct(AlbomService $service, AlbomRepository $alboms)
    {
        $this->service = $service;
        $this->alboms = $alboms;
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

    public function edit($id)
    {
        try {
            $albom = $this->alboms->getId($id);
            return view('create.edit', compact('albom'));
        } catch (\DomainException $e) {
            return redirect()->home()->with('error', $e->getMessage());
        }
    }

    public function update(AlbomCreateRequest $request, $id)
    {
        $this->service->edit($id, $request);
        return redirect()->home()->with('success', 'Изменения сохранены');
    }

    public function destroy($id)
    {
        try {
            $this->service->remove($id);
            return redirect()->home()->with('success', 'Альбом удален');
        } catch (\DomainException $e) {
            return redirect()->home()->with('error', $e->getMessage());
        }
    }
}
