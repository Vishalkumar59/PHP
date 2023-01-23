<?php
namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'section';
    protected $primaryKey = 'section_id';
    protected $fillable = [
        'section_id','section_name','status'
     ];

}
