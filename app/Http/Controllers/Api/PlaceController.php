<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GoogleMapService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Repository\MapPlaceRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;


class PlaceController extends Controller
{   
    private $googleMapService;
    private $mapRepository;

    public function __construct(GoogleMapService $googleMapService,MapPlaceRepository $mapPlaceRepository)
    {
        $this->googleMapService = $googleMapService;
        $this->mapRepository = $mapPlaceRepository;
        $this->middleware('auth:api');
    }


    public function savePlace(AddressRequest $request)
    {
        $address = $request->address;

        if (Cache::has($address)) {
                     
            return $this->mapRepository->getPlaceByName($address);
        }
        
        $placedata = $this->googleMapService->getGeoCodeByPlaceName($address);
        $placedata['user_id'] = Auth::user()->id;

        $place = $this->mapRepository->create($placedata);
        
        if($place){
            Cache::add($address,$address,10*60*24);
            return response()->json(['data'=>$placedata],200);
        }

        return response()->json(['message'=>'Something went wrong'],401);
      
    }


    public function getAllPlace($paginate)
    {   
        if(is_int($paginate)){

        $user_id = Auth::user()->id;
        return $this->mapRepository->getAllPlaceByUserID($user_id,$paginate);
        }
        return response()->json(['message'=>"parameter must be an integer value"],401);

    }
}
 