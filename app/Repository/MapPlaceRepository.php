<?php
namespace App\Repository;
use App\Models\Place;

class MapPlaceRepository extends Repository
{   

    public function __construct(Place $place)
    {
        parent::__construct($place);
    }

    public function getAllPlaceByUserID($id,$paginate_param)
    {
        return $this->model::where('user_id',$id)->paginate($paginate_param);
    }

    public function getPlaceByName($place_name)
    {
        $place =  $this->model::where('place_name',$place_name)->first();
        $place->fresh();
        return $place;
    }

}