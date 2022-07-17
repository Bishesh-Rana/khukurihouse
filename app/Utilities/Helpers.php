<?php

use Illuminate\Support\Facades\File;

function getFrontImage($image = null,$folder = null, $thumbnail = true)
{
if($folder){
    return asset('uploads/'.$folder.'/'.$image);
}
else{
    return asset('uploads/settings/'.config('settings.site_logo'));

}

    $prefix = $thumbnail ? 'thumbnail_' : null;
    return  File::exists(public_path() . sprintf('\uploads\%s\%s', $folder, $image)) ? asset(sprintf('uploads\%s\%s', $folder, $image)) : asset(sprintf('uploads/%s/%s', 'settings', config('settings.site_logo')));
}
