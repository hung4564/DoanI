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

// Home > Admin / {Resource} / {List|Edit|Create}
$resources = [
    'users' => 'Users',
    'categories' => 'Categories',
    'visuals' => 'Visuals',
    'quizzes'=>'Quiz',
    'questions'=>'Question'
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
