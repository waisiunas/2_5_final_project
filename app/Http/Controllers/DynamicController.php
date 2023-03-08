<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Topic;
use Illuminate\Http\Request;

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
        $is_correct = Choice::where([
            ['id', $data['choice_id']],
            ['is_correct', 1],
        ])->first();

        if ($is_correct) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }



    }
}
