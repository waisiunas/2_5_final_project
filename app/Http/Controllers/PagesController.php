<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function subjects() {
        return view('web-pages.subjects', ['subjects' => Subject::all()]);
    }

    public function topics(Subject $subject) {
        return view('web-pages.topics', [
            'topics' => Topic::where('subject_id', $subject->id)->get()
        ]);
    }

    public function prepare(Subject $subject, Topic $topic) {
        return view('web-pages.prepare', [
            'questions' => Question::where('topic_id', $topic->id)->get(),
            'subject' => $subject,
        ]);
    }
}
