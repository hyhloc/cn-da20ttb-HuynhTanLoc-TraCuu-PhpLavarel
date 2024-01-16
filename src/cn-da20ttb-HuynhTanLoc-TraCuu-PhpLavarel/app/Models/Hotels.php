<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    use HasFactory;
    public function getUrl() {
        return route('searchluutru',$this->slug);
    }

    public function getThumnail() {
        return $this->thumnail??'';
    }
}
