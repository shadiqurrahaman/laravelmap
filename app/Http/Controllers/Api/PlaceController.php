<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;

class PlaceController extends Controller
{
    public function getAllPlace()
    {   
        return Place::paginate(3);
    }
}
