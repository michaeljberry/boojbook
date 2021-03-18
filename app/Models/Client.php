<?php

namespace App\Models;

use App\Models\ClientProgram;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    protected $table = "clients";
    protected $guarded = [];

    public function program()
    {
        return $this->belongsTo(ClientProgram::class, 'program_id');
    }
}
