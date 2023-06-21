<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = 'info';
    protected $primaryKey ='id';

    public function car(){
        return $this->belongsTo(Car::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
}
