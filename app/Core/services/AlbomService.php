<?php

namespace App\Core\services;


use App\Core\repositories\AlbomRepository;
use App\Http\Requests\AlbomCreateRequest;
use App\Http\Requests\AlbomRequest;
use App\Models\Albom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AlbomService
{
    private $alboms;

    public function __construct(AlbomRepository $alboms)
    {
        $this->alboms = $alboms;
    }

    public function searchAlboms(AlbomRequest $request)
    {
        return Http::get("http://ws.audioscrobbler.com/2.0/?method=album.search&album={$request->title}&api_key=57d242cef4c59ff3a3dddb723b00a950&format=json")['results']['albummatches']['album'];
    }

    public function getAlbomInfo(Request $request)
    {
        $albom = explode('___', $request->albom);
        $albomInfo = Http::get("http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=57d242cef4c59ff3a3dddb723b00a950&artist={$albom[1]}&album={$albom[0]}&format=json");
        return [
            'name' => $albomInfo['album']['name'],
            'artist' => $albomInfo['album']['artist'],
            'content' => $albomInfo['album']['wiki']['content'],
            'image' => $albomInfo['album']['image'][count($albomInfo['album']['image'])-1]['#text']
        ];
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
