<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovidData extends Model
{
    use HasFactory;

    protected $table = 'covid_data';
    protected $primaryKey = 'id';

    protected $fillable = [
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
        'global_recovered'
    ];

}
