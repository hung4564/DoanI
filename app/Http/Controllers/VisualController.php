<?php

namespace App\Http\Controllers;

class VisualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showVisual($visualid, $visualpath)
    {
        $visual = \App\Visual::find($visualid);
        return view('Visual', ['visual' => $visual]);
    }
}
