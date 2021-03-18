<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProgram extends Model
{
    use HasFactory;
    protected $table = "client_programs";
    protected $guarded = [];
}
