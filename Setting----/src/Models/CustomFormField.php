<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomFormField extends Model
{
    use HasFactory;
    protected $primaryKey = 'fields_id';

    protected $table = 'crm_form_fields';
    protected $fillable = [
        'field_label', 'field_name','field_type','field_values', 'fiels_class', 'sort_order', 'required','status','form_id'
     ];
      
}
