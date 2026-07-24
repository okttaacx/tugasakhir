<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{

    protected $fillable = ['survey_id', 'question_number', 'score'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
