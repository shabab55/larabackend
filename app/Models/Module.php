<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory, SoftDeletes;

    //protected $fillable=['name','slug'];
    protected $guarded = ['id'];

    //relationship with permissions
    public function permissions(){
        return $this->hasMany(Permission::class);
    }
}
