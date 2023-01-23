<?php
namespace Modules\UserManage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoleHasPermissions extends Model
{
    use HasFactory;

    protected $table = 'usr_role_has_permissions';
    public $timestamps = false;
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'roles_id','section_id','permissions_ids','permission_types_id'
     ];


     public function permission() {
        return $this->hasMany(UserPermission::class , 'permissions_id', 'permissions_ids');
    }
}
