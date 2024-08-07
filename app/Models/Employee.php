<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Employee extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory;
    use Authenticatable;
    protected $table = 'Employees';
    protected $primaryKey = 'employee_id';

    public $timestamps = false;
    protected $fillable = ['password'];

    public function image()
    {
        return $this->hasOne(Image::class,'image_id','image_id');
    }

    // Employee ile Department arasında bir-to-one ilişkisi
    public function department()
    {
        return $this->hasOne(Department::class,'department_id','department_id');
    }

}
