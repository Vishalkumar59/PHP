<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;

    protected $table = 'crm_industry'; 

    protected $primaryKey = 'industry_id';

     protected $fillable = [
       'industry_id','industry_name','status'
    ];

    public function crmlead(){

        return $this->hasOne(CrmLead::class,'industry_id','industry_id');
    }
}
