<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function showVisual($visualid, $visualpath)
    {
        $visual = \App\Visual::find($visualid);
        return view('visual', ['visual' => $visual]);
    }
    public function showTranning()
    {
        $quizzes = \App\Quiz::All()->where('status', '=', '1');
        return view('tranning', ['quizzes' => $quizzes]);
    }
    public function showQuiz($id)
    {
        $quiz = \App\Quiz::find($id);
        return view('quiz', ['quiz' => $quiz]);
    }
}
