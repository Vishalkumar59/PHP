<?php
namespace Modules\USERMANAGE\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;

    protected $table = 'usr_permissions';
    protected $primaryKey = 'permissions_id';
    
    protected $fillable = [
        'permissions_id','permissions_name','permissions_slug','sort_order','allow_permission'
     ];

        
}
