<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpAndGuide extends Model
{
    use HasFactory;

    protected $table = 'help_and_guide';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'link',
        'description',
        'created_by',
        'updated_by',
        'row_version',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id','name');
    }

}
