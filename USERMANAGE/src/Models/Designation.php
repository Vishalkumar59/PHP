<?php

namespace Modules\USERMANAGE\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $primaryKey = 'designation_id';

    protected $table = 'hrm_designation';

    protected $fillable = ['designation_id','designation_name','created_by','status'];
}
