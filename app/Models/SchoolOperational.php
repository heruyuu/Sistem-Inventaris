<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SchoolOperational extends Model
{
    use HasFactory;

    protected $table = 'school_operational';
    protected $fillable = [
        'name', 'description'
    ];
    protected $guarded = ['created_at','updated_at'];

    public function comodities()
    {
        return $this->hasMany('App\Models\Comodities', 'school_operational_id', 'id');
    }
    // public static function getAllSchool_operational()
    // {
    //     $result = DB::table('school_operational')->select('id','name','description')->get()->toArray();
    //     return $result;
    // }
}
