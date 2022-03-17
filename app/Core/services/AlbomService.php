<?php

namespace App\Core\services;


use App\Core\repositories\AlbomRepository;
use App\Http\Requests\AlbomRequest;
use App\Models\Albom;
use Illuminate\Support\Facades\Http;

class AlbomService
{
    private $alboms;

    public function __construct(AlbomRepository $alboms)
    {
        $this->alboms = $alboms;
    }

    public function searchAlbom(AlbomRequest $request)
    {
        return Http::get("http://ws.audioscrobbler.com/2.0/?method=album.search&album={$request->title}&api_key=57d242cef4c59ff3a3dddb723b00a950&format=json")['results']['albummatches']['album'];
    }


    public function create(AlbomCreateRequest $request)
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
