<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
class GoogleMapService
{   

    //todo
    //move this to .env config
    
    private $api_key = '';
    private $api_url_for_address = 'https://maps.googleapis.com/maps/api/geocode/json?address=';
    private $api_url_for_geocode = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=';

    public function getGeoCodeByPlaceName($address)
    {   
        
        $data = ['place_name'=>$address,'lat'=>$this->random_func(),'lan'=>$this->random_func()];

        return $data;

        try{
            $response = Http::get($this->api_url_for_address.$address.'$key='.$this->api_key);
            if($response){

                return $response->body();
            }
        }catch(\Exception $e){
            return false;
        }
        return false;

    }
    
    public function getAddressByGeoCode($geocode)
    {
        try{
            $response = Http::get($this->api_url_for_geocode.$geocode.'$key='.$this->api_key);
            if($response){

                return $response->body();
            }
        }catch(\Exception $e){
            return false;
        }
        return false;

    }

    private function random_func()
    {
        $min = 0;
        $max = 20;
        $decimals = 9;
        $divisor = pow(10, $decimals);
        $randomFloat = mt_rand($min, $max * $divisor) / $divisor;
        return  $randomFloat;
    }





}