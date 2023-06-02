<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model {
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'total_mark', 'total_credit', 'status'
    ];

    public function questions() {
        return $this->hasMany(Question::class, 'subject_id', 'id');
    }
}
