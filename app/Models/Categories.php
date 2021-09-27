<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    
    protected $table = 'categories';

    protected $fillable = [
        'image',
        'email_id', 
        'name',
    ];

    protected $dates = ['deleted_at'];

    public function sub_categories(){
        return $this->hasMany(SubCategories::class, 'categories_id','id');
    }
}
