<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ComodityLocation extends Model
{
    use HasFactory;

    protected $table = 'comodity_locations';
    protected $fillable = [
        'name', 'description'
    ];
    protected $guarded = ['created_at','updated_at'];

    public function comodities()
    {
        return $this->hasMany('App\Models\Comodities', 'comodity_locations_id', 'id');
    }
    // public static function getAllComodity_locations()
    // {
    //     $result = DB::table('comodity_locations')->select('id','name','description')->get()->toArray();
    //     return $result;
    // }
}
