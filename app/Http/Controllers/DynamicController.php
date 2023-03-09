<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DynamicController extends Controller
{
    public function fetch_topics() {
        $data = json_decode(file_get_contents('php://input'), true);
        $topics = Topic::where('subject_id', $data['subjectId'])->get();
        if(count($topics) > 0) {
            $output = '<option value="" selected hidden disabled>Select the topic</option>';
            foreach ($topics as $topic) {
                $output .= '<option value="' . $topic->id . '">' . $topic->name . '</option>';
            }
        } else {
            $output = '<option value="">No Topic Found!</option>';
        }
        echo json_encode($output);
    }

    public function check_question() {
        $data = json_decode(file_get_contents('php://input'), true);
        $choice = Choice::with('question')->where([
            ['id', $data['choice_id']]
        ])->first();

        if ($choice->is_correct == 1) {
            $status = 'Correct';
        } else {
            $status = 'Incorrect';
        }

        // $questions = Question::where('topic_id', $choice->question->topic_id)->get();
        $questions = $choice->question->topic->questions;
        $next_question = $questions->get($data['currentQuestion']);

        Session::put('_token', sha1(microtime()));
        $new_token = session()->get('_token');
        echo json_encode([
            'new_token' => $new_token,
            'status' => $status,
            'next_question' => $next_question,
            'choices' => $next_question->choices
        ]);
        // if ($choice) {
        //     echo json_encode(true);
        // } else {
        //     echo json_encode(false);
        // }



    }
}
