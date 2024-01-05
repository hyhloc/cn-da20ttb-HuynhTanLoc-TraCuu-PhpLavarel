<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    use HasFactory;
   
    public function getUrl() {
        return route('searchamthuc',$this->slug);
    }

    public function getThumnail() {
        return $this->thumnail??'';
    }
   
}
