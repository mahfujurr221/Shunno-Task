<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Branch;
use App\Models\Banner;
use App\Models\Headline;
use App\Models\FoodCategory;
use App\Models\FoodItem;
use App\Models\FoodGallery;
use App\Models\Setting;

class CommonApiController extends Controller
{
    public function settings(){
        return response()->json(Setting::all());
    }

}
