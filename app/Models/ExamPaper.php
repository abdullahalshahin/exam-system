<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamPaper extends Model {
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    function subject() {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    function assigned_question() {
        return $this->hasMany(ExamPaperAssignedQuestion::class, 'exam_paper_id', 'id');
    }

    function exam_paper_assigned_questions() {
        return $this->hasManyThrough(Question::class, ExamPaperAssignedQuestion::class, 'exam_paper_id', 'id', 'id', 'question_id');
    }
}
