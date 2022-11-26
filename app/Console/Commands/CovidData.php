<?php

namespace App\Console\Commands;


use App\Modules\CovidData\Http\Controllers\CovidDataController;
use Illuminate\Console\Command;

class CovidData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:covid_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Covid 19 recodes';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private $covidDataController;
    public function __construct(CovidDataController $covidDataController)
    {
        parent::__construct();
        $this->covidDataController = $covidDataController;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->covidDataController->saveCovidData();
    }
}
