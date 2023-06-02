<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subject_id', 'type', 'title', 'option_a', 'option_b', 'option_c', 'option_d', 'option_e',
        'correct_answer', 'description', 'reference', 'status'
    ];

    public function subject() {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
