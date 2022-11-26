<?php


namespace App\Modules\CovidData\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CovidData\Contracts\CovidDataRepositoryInterface;
use Illuminate\Http\Request;



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
                $appData = $this->_setAppData();
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
            "key" => $request->key,
            "value" => $request->value
        ];
    }


}
