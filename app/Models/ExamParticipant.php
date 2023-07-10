<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamParticipant extends Model {
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function exam_paper() {
        return $this->belongsTo(ExamPaper::class, 'exam_paper_id', 'id');
    }

    public function student() {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    function answer_papers() {
        return $this->hasMany(AnswerPaper::class, 'exam_participant_id', 'id');
    }

    function questions() {
        return $this->hasManyThrough(Question::class, AnswerPaper::class, 'exam_participant_id', 'id', 'id', 'question_id');
    }
}
