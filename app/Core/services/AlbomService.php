<?php

namespace App\Core\services;


use App\Core\repositories\AlbomRepository;
use App\Http\Requests\AlbomRequest;
use App\Models\Albom;

class AlbomService
{
    private $alboms;

    public function __construct(AlbomRepository $alboms)
    {
        $this->alboms = $alboms;
    }

    public function create(AlbomRequest $request)
    {
        $albom = Albom::query()->create($request->all());
        $this->alboms->save($albom);
        return $albom;
    }

    public function edit($id, AlbomRequest $request)
    {
        $albom = Albom::query()->find($id)->update($request->all());
        return $albom;
    }

    public function remove($id)
    {
        $albom = $this->alboms->getId($id);
        $this->alboms->remove($albom);
    }
}
