<?php


namespace App\Modules\HelpAndGuide\Contracts;


use App\Contracts\MainRepositoryInterface;

interface HelpAndGuideRepositoryInterface extends MainRepositoryInterface
{
    public function createHelpAndGuide($data);
    public function getAllHelpAndGuide();

}
