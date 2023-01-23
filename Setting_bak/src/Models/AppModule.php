<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppModule extends Model
{
    use HasFactory;
    protected $table = 'app_module'; 

    protected $primaryKey = 'module_id';

     protected $fillable = [
       'module_id','module_name','module_icon','module_slug', 'access_priviledge','completion_status','quick_access','sort_order','status'
    ];

    public function app_module_section()
    {
        return $this->hasOne(AppModuleSection::class, 'module_id', 'module_id');
    }
}
