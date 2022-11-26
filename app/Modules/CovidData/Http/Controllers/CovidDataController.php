<?php


namespace App\Modules\CovidData\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CovidData\Contracts\CovidDataRepositoryInterface;



class CovidDataController extends Controller
{
    private $covidStatRepository;

    public function __construct(CovidDataRepositoryInterface $covidStatRepository)
    {
        $this->covidStatRepository = $covidStatRepository;
    }

    public function getLatestCovidData(){
        try {
            $respData= $this->covidStatRepository->getLatestCovidData();
            return $this->apiResponse(true, $respData, API_RES_STATUS_SUCCESS, 'success');

        }catch (\Exception $exception){
            return $this->apiResponse(false, 'Internal server error', API_RES_STATUS_INTERNAL_SERVER_ERROR);
        }

    }


    public function saveCovidData(){
        try {
            $endPoint = 'https://hpb.health.gov.lk/api/get-current-statistical';
            $response = guzzleRequest($endPoint);
            if ($response['success']){
                $appData = $this->_setCovidData($response['data']['data']);
                $respData = $this->covidStatRepository->createCovidData($appData);
                return $this->apiResponse(true, $respData, API_RES_STATUS_SUCCESS, 'success');

            }else{
                return $this->apiResponse(false, 'Internal server error', API_RES_STATUS_INTERNAL_SERVER_ERROR);
            }
        }catch (\Exception $exception){
            return $this->apiResponse(false, 'Internal server error', API_RES_STATUS_INTERNAL_SERVER_ERROR);
        }

    }

    private function _setCovidData($request){
        return [
            "update_date_time" => $request['update_date_time'],
            "local_new_cases"=> $request['local_new_cases'],
            "local_total_cases"=> $request['local_total_cases'],
            "local_total_number_of_individuals_in_hospitals"=> $request['local_total_number_of_individuals_in_hospitals'],
            "local_new_deaths"=> $request['local_new_deaths'],
            "local_deaths"=> $request['local_deaths'],
            "local_recovered"=> $request['local_recovered'],
            'local_active_cases'=> $request['local_active_cases'],
            'global_new_cases'=> $request['global_new_cases'],
            "global_total_cases"=> $request['global_total_cases'],
            'global_deaths'=> $request['global_deaths'],
            "global_new_deaths"=> $request['global_new_deaths'],
            "global_recovered"=> $request['global_recovered']
        ];
    }


}
