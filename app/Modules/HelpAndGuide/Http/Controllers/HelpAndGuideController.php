<?php


namespace App\Modules\HelpAndGuide\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CovidData\Contracts\CovidDataRepositoryInterface;
use App\Modules\HelpAndGuide\Contracts\HelpAndGuideRepositoryInterface;
use Illuminate\Http\Request;



class HelpAndGuideController extends Controller
{
    private $helpAndGuideRepository;

    public function __construct(HelpAndGuideRepositoryInterface $helpAndGuideRepository)
    {
        $this->helpAndGuideRepository = $helpAndGuideRepository;
    }

    public function getAllHelpAndGuide(){
        try {
            $respData= $this->helpAndGuideRepository->getAllCovidData();
            return $this->apiResponse(true, $respData, API_RES_STATUS_SUCCESS, 'success');

        }catch (\Exception $exception){
            return $this->apiResponse(false, 'Internal server error', API_RES_STATUS_INTERNAL_SERVER_ERROR);
        }

    }

    public function createHelpAndGuide(){
        try {
            $appData = $this->_setHelpAndGuideData();
            $respData = $this->helpAndGuideRepository->create($appData);
            return $this->apiResponse(true, $respData, API_RES_STATUS_SUCCESS, 'success');

        }catch (\Exception $exception){
            return $this->apiResponse(false, 'Internal server error', API_RES_STATUS_INTERNAL_SERVER_ERROR);
        }

    }

    private function _setHelpAndGuideData($request){
        return [
            "user_id" => $request->user_id, // get logged user id
            "link" => $request->link,
            "description" => $request->description,
        ];
    }


}
