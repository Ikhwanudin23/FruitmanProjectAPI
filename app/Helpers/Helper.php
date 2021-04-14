<?php

namespace App\Helpers;

class Helper
{
    public static function uploadFile($file)
    {
        $file_name = $file->getClientOriginalName();
        $only_name = explode('.', $file_name);
        $extension = $file->getClientOriginalExtension();
        $new_name = $only_name[0] . '-' . \Carbon\Carbon::now()->format('ymdHis') . '.' . $extension;
        $destination = 'product';
        $path = $file->storeAs($destination, $new_name);
        return $path;
    }
}