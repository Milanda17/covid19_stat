<?php


namespace App\Modules\CovidData\Repositories;


use App\Models\CovidData;
use App\Modules\CovidData\Contracts\CovidDataRepositoryInterface;
use App\Repositories\MainRepository;
use mysql_xdevapi\Exception;


class CovidDataRepository extends MainRepository implements CovidDataRepositoryInterface
{

    function model(){
        return 'App\Models\CovidData';
    }

    public function createCovidData($data){
        try{
            return $this->create($data);
        }catch (\Exception $exception){
            error_log($exception->getMessage());
            return null;
        }
    }

    public function getLatestCovidData(){
        try {
            return CovidData::select('*')->orderBy('id','desc')->first();
        }catch (\Exception $exception){
            error_log($exception->getMessage());
            return null;
        }

    }


}
