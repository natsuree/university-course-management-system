<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['student_id', 'name', 'email', 'course', 'year_level'];

    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }

    public function grades() {
        return $this->hasMany(Grade::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }
}