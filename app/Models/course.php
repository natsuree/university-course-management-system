<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['course_code', 'course_name', 'units'];

    public function schedules() {
        return $this->hasMany(Schedule::class);
    }
}