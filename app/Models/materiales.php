<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materiales extends Model
{
    use HasFactory;
    protected $table = "materiales";

    public function student() {
        return $this->belongsTo(students::class);
    }
}
