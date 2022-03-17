<?php


namespace App\Core\Logs;


use Illuminate\Support\Facades\Log;

class UpdateLog
{
    public static function updateLog($data)
    {
        Log::channel('update')->info("Update: $data->name. \n
        New Name: $data->name. \nNew Artist: $data->artist. \n New Content: $data->content");
    }
}
