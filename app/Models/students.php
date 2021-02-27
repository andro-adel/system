<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    use HasFactory;
    protected $table = "students";

    public function materiales()
    {
        return $this->hasMany(materiales::class, 'student_id');
    }

    public function image()
    {
        return $this->morphOne(images::class, 'imageable');
    }
}
