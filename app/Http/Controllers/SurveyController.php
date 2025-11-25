<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use App\Models\SurveyAnswer;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function store(Request $request)
    {

        $user = auth()->user();

        $existingSurvey = Survey::where('user_id', $user->id)->first();

        if ($existingSurvey) {
            return redirect()->route('survey.error');
        }

        $request->validate([
            'answers' => 'required|array|size:10',
            'answers.*' => 'required|integer|min:1|max:5'
        ]);

        $survey = Survey::create([
            'user_id' => Auth::id(),
        ]);

        foreach ($request->answers as $questionNumber => $score) {
            SurveyAnswer::create([
                'survey_id' => $survey->id,
                'question_number' => $questionNumber,
                'score' => $score,
            ]);
        }

        return redirect()->route('survey.thankyou');
    }

    public function adminView()
    {
        $surveys = Survey::with(['user', 'answers'])->get();
        return view('survey.index', compact('surveys'));
    }

}
