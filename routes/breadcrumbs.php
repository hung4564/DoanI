<?php
// Home
Breadcrumbs::for('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('welcome'));
});

// Home > {Visual}
Breadcrumbs::for('visual', function ($breadcrumbs, $visual) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($visual->name, route('visual',['id'=>$visual->id,'path'=>$visual->path]));
});
// Home > Login
Breadcrumbs::for('login', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Login', route('login'));
});

// Home > Tranning
Breadcrumbs::for('tranning',function($breadcrumbs){
  $breadcrumbs->parent('home');
  $breadcrumbs->push('Tranning',route('tranning'));
});

// Home > Tranning > {Quiz}
Breadcrumbs::for('quiz',function($breadcrumbs,$id){
  $breadcrumbs->parent('tranning');
  $breadcrumbs->push('Quiz',route('quiz',$id));
});

if (config('adminlte.registration_open')) {
    // Home > Register
    Breadcrumbs::for('register', function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('Register', route('register'));
    });
}

// Home > Login > Forgot Password
Breadcrumbs::for('password-request', function ($breadcrumbs) {
    $breadcrumbs->parent('login');
    $breadcrumbs->push('Forgot Password', route('password.request'));
});

// Home > Login > Forgot Password > Reset Password
Breadcrumbs::for('password-reset', function ($breadcrumbs) {
    $breadcrumbs->parent('password-request');
    $breadcrumbs->push('Reset Password', route('password.reset'));
});

// Home > Dashboard
Breadcrumbs::for('dashboard', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Dashboard', route('dashboard::index'));
});

// Home > Dashboard > Profile
Breadcrumbs::for('profile', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Profile', route('profile'));
});

// Home > Admin
Breadcrumbs::for('admin', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Admin', route('admin::index'));
});

// Home > Admin > {Resource} > {List|Edit|Create}
$resources = [
    'users' => 'Users',
    'categories' => 'Categories',
    'visuals' => 'Visuals',
    'quizzes'=>'Quiz',
    'questions'=>'Question',
    'courses'=>'Course',
];
foreach ($resources as $resource => $data) {
    $parent = 'admin';
    $title = $data;
    if (is_array($data)) {
        $title = $data['title'];
        $parent = $data['parent'];
    }
    $resource = 'admin::' . $resource;

    // List
    Breadcrumbs::for($resource, function ($breadcrumbs) use ($resource, $title, $parent) {
        $breadcrumbs->parent($parent);
        $breadcrumbs->push($title, route($resource . '.index'));
    });
    // Create
    Breadcrumbs::for($resource . '.create', function ($breadcrumbs) use ($resource) {
        $breadcrumbs->parent($resource);
        $breadcrumbs->push('Create', route($resource . '.create'));
    });
    // Edit
    Breadcrumbs::for($resource . '.edit', function ($breadcrumbs, $id) use ($resource) {
        $breadcrumbs->parent($resource);
        $breadcrumbs->push('Edit', route($resource . '.edit', $id));
    });
}

// Home > Admin > Quiz > Question >
Breadcrumbs::for('admin::QuizQuestion', function ($breadcrumbs,$quizID) {
  $breadcrumbs->parent('admin::quizzes');
  $breadcrumbs->push('Question', route('admin::QuizQuestion.index',$quizID));
});

// Home > Admin > Quiz > Question > Create
Breadcrumbs::for('admin::QuizQuestion.create', function ($breadcrumbs,$quizID) {
  $breadcrumbs->parent('admin::QuizQuestion',$quizID);
  $breadcrumbs->push('Create', route('admin::QuizQuestion.create',$quizID));
});
// Home > Admin > Quiz > Question > Edit
Breadcrumbs::for('admin::QuizQuestion.edit', function ($breadcrumbs,$quizID,$questionID) {
  $breadcrumbs->parent('admin::QuizQuestion',$quizID);
  $breadcrumbs->push('Edit', route('admin::QuizQuestion.edit',[$quizID,$questionID]));
});

Breadcrumbs::for('admin::courses.detail', function ($breadcrumbs,$courseID) {
  $breadcrumbs->parent('admin::courses');
  $breadcrumbs->push('Detail', route('admin::courses.detail',[$courseID]));
});