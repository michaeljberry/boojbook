<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $table = "books";
    protected $guarded = [];

    public function getPhotoDisplayAttribute()
    {
        return 'uploads/no-photo.png';
    }

    public function getDatePublishDisplayAttribute()
    {
        if($this->attributes['date_publish']!=''){
            return Carbon::parse($this->attributes['date_publish'])->format('d M Y');
        }
        return '';
    }
}
