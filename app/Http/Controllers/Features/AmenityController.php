<?php

namespace App\Http\Controllers\Features;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    //
    public function getCat(){
        $amenityCategories = config('amenity.amenityCategories');
        // dd($amenityCategories);
        return $amenityCategories;
    }
    public function getAccess(){
        $amenityAccessibilities = config('amenity.amenityAccessibilities');
        return $amenityAccessibilities;
    }
}
