<?php

namespace App\Http\Controllers;

use App\Core\repositories\AlbomRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    private $alboms;

    public function __construct(AlbomRepository $alboms)
    {
        $this->alboms = $alboms;
    }

    /*public function index(Request $request)
    {
        $response = Http::get('http://ws.audioscrobbler.com/2.0/?method=album.search&album=belive&api_key=57d242cef4c59ff3a3dddb723b00a950&format=json');
        $albom = $response['results']['albummatches']['album'];
        $albomInfo = Http::get("http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=57d242cef4c59ff3a3dddb723b00a950&artist={$albom[0]['artist']}&album={$albom[0]['name']}&format=json");

        dump($albomInfo['album']['name']);
        dump($albomInfo['album']['artist']);
        dump($albomInfo['album']['wiki']['content']);
        dump($albomInfo['album']['image'][count($albomInfo['album']['image'])-1]['#text']);
    }*/

    public function index()
    {
        $alboms = $this->alboms->getAll();
        return view('index', compact('alboms'));
    }
}
