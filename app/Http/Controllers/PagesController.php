<?php

namespace App\Http\Controllers;

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
}
