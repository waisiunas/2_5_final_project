<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.questions.index', ['questions' => Question::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.questions.create', [
            'subjects' => Subject::all(),
            'topics' => Topic::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'subject' => ['required'],
            'topic' => ['required'],
            'question' => ['required'],
            'choice_1' => ['required'],
            'choice_2' => ['required'],
            'choice_3' => ['required'],
            'choice_4' => ['required'],
            'correct_choice' => ['required', 'numeric', 'min:1', 'max:4'],
        ]);

        $data = [
            'topic_id' => $request->topic,
            'text' => $request->question,
            'explanation' => $request->explanation,
            'count' => 0,
        ];

        $added_question = Question::create($data);

        if ($added_question) {
            $question_id = $added_question->id;
            $is_correct = 0;
            for ($i = 1; $i < 5; $i++) {
                if ($i == $request->correct_choice) {
                    $is_correct = 1;
                }
                else {
                    $is_correct = 0;
                }

                $data = [
                    'question_id' => $question_id,
                    'text' => request('choice_' . $i),
                    'is_correct' => $is_correct,
                    'count' => 0
                ];
                Choice::create($data);
            }
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['error' => 'Magic has failed to spell!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
