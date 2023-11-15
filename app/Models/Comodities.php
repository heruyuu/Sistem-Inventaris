<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Comodities extends Model
{
    use HasFactory;

    protected $table = 'comodities';
    protected $fillable = [
        'school_operational_id','comodity_locations_id','item_code','name','brand','material','date_of_purchase','condition','quantity','price','price_per_item','note'
    ];
    protected $guarded = ['created_at', 'updated_at'];

    public function comodity_locations()
    {
        return $this->belongsTo(ComodityLocation::class, 'comodity_locations_id', 'id');
    }

    public function school_operational()
    {
        return $this->belongsTo(SchoolOperational::class, 'school_operational_id', 'id');
    }

    public function indonesian_format_date($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function indonesian_currency($value)
    {
        return number_format($value, 2, ', ', '.');
    }
}
