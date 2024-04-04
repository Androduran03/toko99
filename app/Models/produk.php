<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function transaksi(){
        return $this->hasMany(transaksi::class);
    }
    public function datatraining(){
        return $this->hasMany(datatraining::class);
    }
}
