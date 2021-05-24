<?php

namespace App\Traits;
use PhpParser\Builder\Trait_;


Trait General
{
    function saveImage($image, $path){
        $photo = $image -> move($path, $image-> hashName());
        return $photo;
    }


}
