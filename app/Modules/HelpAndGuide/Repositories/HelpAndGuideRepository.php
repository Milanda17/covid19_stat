<?php


namespace App\Modules\HelpAndGuide\Repositories;


use App\Models\HelpAndGuide;
use App\Modules\HelpAndGuide\Contracts\HelpAndGuideRepositoryInterface;
use App\Repositories\MainRepository;



class HelpAndGuideRepository extends MainRepository implements HelpAndGuideRepositoryInterface
{

    function model()
    {
        return 'App\Models\HelpAndGuide';
    }

    //  create help & guide recode
    public function createHelpAndGuide($data)
    {
        try{
            return $this->create($data);
        }catch (\Exception $e){
            error_log($e->getMessage());
            return null;
        }
    }

    // get all help & guide records sort by created_at date
    public function getAllHelpAndGuide()
    {
        try{
            return HelpAndGuide::with('user')->select('user_id','link','description','created_at' )
                ->orderBy('created_at','desc')->get();
        }catch (\Exception $e){
            error_log($e->getMessage());
            return null;
        }
    }


}
