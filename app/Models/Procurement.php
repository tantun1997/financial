<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    use HasFactory;
    
 protected $fillable = [
    'procurementType',
    'priorityNo',
    'description',
    'price',
    'package',
    'quant',
    'objectTypeId',
    'reason',
    'deptId',
    'budget',
    'remark',
    'userId',
    'levelNo',
    'enable'
  ];

    public $timestamps = true;
    
  public function orders()
  {
    return $this->hasMany(Procurements_detail::class);
  }
    
}
