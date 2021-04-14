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
        $path = public_path('/product');
        $file->move($path, $new_name);
        return 'product/'.$new_name;
    }
}