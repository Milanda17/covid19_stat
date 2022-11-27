<?php


namespace App\Modules\HelpAndGuide\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\HelpAndGuide\Contracts\HelpAndGuideRepositoryInterface;
use App\Modules\HelpAndGuide\Http\Requests\HelpAndGuideRequest;


class HelpAndGuideController extends Controller
{
    private $helpAndGuideRepository;

    public function __construct(HelpAndGuideRepositoryInterface $helpAndGuideRepository)
    {
        $this->helpAndGuideRepository = $helpAndGuideRepository;
    }

    //get all help and guide records
    public function getAllHelpAndGuide(){
        try {
            $respData= $this->helpAndGuideRepository->getAllHelpAndGuide();
            return $this->apiResponse(true, $respData, API_RES_STATUS_SUCCESS, 'success');

        }catch (\Exception $exception){
            return $this->apiResponse(false, 'Internal server error', API_RES_STATUS_INTERNAL_SERVER_ERROR);
        }

    }

    // create help and guide recode
    public function createHelpAndGuide(HelpAndGuideRequest $request){
        try {
            $requestParam = $request->all();
            $appData = $this->_setHelpAndGuideData($requestParam); // set help and guide data
            $respData = $this->helpAndGuideRepository->createHelpAndGuide($appData);
            return $this->apiResponse(true, $respData, API_RES_STATUS_SUCCESS, 'success');

        }catch (\Exception $exception){
            return $this->apiResponse(false, 'Internal server error', API_RES_STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    private function _setHelpAndGuideData($request){
        return [
            "user_id" => auth()->user()->id, //get login user id
            "link" => $request['link'],
            "description" => $request['description'],
        ];
    }


}
