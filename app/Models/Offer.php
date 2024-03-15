<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Offer extends Model
{

    protected $table = 'offers';
    protected $fillable = [
        'title',
        'description',
        'localization',
        'starting_date',
        'ending_date',
        'places',
        'salary',
        'applies_count',
        'type',
        'created_at',
        'updated_at',
        'company_id',
    ];

    protected $primaryKey = 'id';

    public $timestamps = false;
    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
