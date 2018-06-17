<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Course;

class CourseController extends Controller
{
    public function Enrollment($idCourse){
      if(!Auth::check()){
        return redirect(route('login'));
      }
      else {
        $course = Course::find($idCourse);
        if(Auth::id()==$course->Teacher->id){
          return redirect(route('dashboard::courses.detail',$idCourse));
        }
        else{
          if($course->status_id==1){
            $course->Students()->sync([Auth::id() => ['status_id' => 1]]);
            return redirect()->back();
          }
          else{
            $course->Students()->sync([Auth::id() => ['status_id' => 0]]);
            return redirect()->back();
          }
        }
      }
    }
}
