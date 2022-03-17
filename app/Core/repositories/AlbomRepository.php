<?php

namespace App\Core\repositories;

use App\Models\Albom;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AlbomRepository
{
    public function getId($id)
    {
        if (!$albom = Albom::query()->where('id', $id)->first()) {
            throw new NotFoundHttpException('Category is not found');
        }
        return $albom;
    }

    public function getAll()
    {
        return Albom::query()->orderBy('created_at', 'desc')->paginate(env('PAGINATE'));
    }

    public function remove($albom)
    {
        $albom->delete();
    }

    public function save($albom)
    {
        if (!$return = $albom->save()) throw new \RuntimeException('Saving albom error.');
        return $return;
    }
}
