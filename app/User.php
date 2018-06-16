<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'logo_number',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * @return boolean
     */
    public function isAdmin()
    {
        return (int) $this->is_admin === 1;
    }
    public function Teacher()
    {
        return $this->hasOne('App\Teacher');
    }
    /**
     * @return boolean
     */
    public function isTeacher()
    {
        return $this->Teacher()->exists();
    }
    public function Courses()
    {
        if ($this->isTeacher()) {
            return $this->hasMany('App\Course', 'teacher_id');
        }
    }
    public function inCourse()
    {
        return $this->belongsToMany('App\Course');
    }
    public function Questions()
    {
        return $this->hasMany('App\Question');
    }
    public function Quizzes()
    {
        return $this->belongsToMany('App\Quiz');
    }
    public function getLogoPath()
    {
        return Utils::logoPath($this->logo_number);
    }
    public function getRecordTitle()
    {
        return $this->name;
    }
    public function haveCourse($idCourse)
    {
        if ($this->inCourse()->exists()) {
            return $this->inCourse->contains($idCourse);
        }
        return false;
    }
}
