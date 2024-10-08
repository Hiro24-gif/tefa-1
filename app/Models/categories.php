<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    // Tentukan relasi dengan model Product
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ["name"];
    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
