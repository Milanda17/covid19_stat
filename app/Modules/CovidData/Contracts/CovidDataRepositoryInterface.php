<?php


namespace App\Modules\CovidData\Contracts;


use App\Contracts\MainRepositoryInterface;

interface CovidDataRepositoryInterface extends MainRepositoryInterface
{
    public function createCovidData($data);
    public function getLatestCovidData();

}
