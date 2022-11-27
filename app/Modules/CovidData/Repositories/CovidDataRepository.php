<?php


namespace App\Modules\CovidData\Repositories;


use App\Models\CovidData;
use App\Modules\CovidData\Contracts\CovidDataRepositoryInterface;
use App\Repositories\MainRepository;


class CovidDataRepository extends MainRepository implements CovidDataRepositoryInterface
{

    function model(){
        return 'App\Models\CovidData';
    }

    //create covid data record
    public function createCovidData($data){
        try{
            return $this->create($data);
        }catch (\Exception $exception){
            error_log($exception->getMessage());
            return null;
        }
    }

    // get latest covid data
    public function getLatestCovidData(){
        try {
            return CovidData::select(
                'update_date_time',
                'local_new_cases',
                'local_total_cases',
                'local_total_number_of_individuals_in_hospitals',
                'local_deaths',
                'local_new_deaths',
                'local_recovered',
                'local_active_cases',
                'global_new_cases',
                'global_total_cases',
                'global_deaths',
                'global_new_deaths',
                'global_recovered')->orderBy('id','desc')->first();
        }catch (\Exception $exception){
            error_log($exception->getMessage());
            return null;
        }

    }


}
