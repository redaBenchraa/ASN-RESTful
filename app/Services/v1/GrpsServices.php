<?php
/**
 * Created by PhpStorm.
 * User: Rabab Chahboune
 * Date: 4/9/2017
 * Time: 9:58 PM
 */

namespace App\Services\v1;


class GrpsServices
{
    public function getGrps(){
        return Grp::all();
    }
}