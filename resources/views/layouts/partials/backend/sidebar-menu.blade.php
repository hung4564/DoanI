<!-- sidebar menu: : style can be found in sidebar.less -->
<?php
$route_name= Auth::user()->isAdmin() ? "admin::":"dashboard::";
?>
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="{{ \App\Utils::checkRoute(['dashboard::index', $route_name.'index']) ? 'active': '' }}">
        <a href="{{ route($route_name.'index') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    @if (Auth::user()->can('viewList', \App\User::class))
        <li class="{{ \App\Utils::checkRoute([$route_name.'users.index', $route_name.'users.create']) ? 'active': '' }}">
            <a href="{{ route($route_name.'users.index') }}">
                <i class="fa fa-user-secret"></i> <span>Users</span>
            </a>
        </li>
    @endif
    @if (Auth::user()->can('viewList', \App\Category::class))
        <li class="{{ \App\Utils::checkRoute([$route_name.'categories.index', $route_name.'categories.create']) ? 'active': '' }}">
            <a href="{{ route($route_name.'categories.index') }}">
                <i class="fa fa-ellipsis-h"></i> <span>Categories</span>
            </a>
        </li>
    @endif
    @if (Auth::user()->can('viewList', \App\Question::class))
        <li class="{{ \App\Utils::checkRoute([$route_name.'questions.index', $route_name.'questions.create']) ? 'active': '' }}">
            <a href="{{ route($route_name.'questions.index') }}">
                <i class="fa fa-question"></i> <span>Questions</span>
            </a>
        </li>
    @endif
    @if (Auth::user()->can('viewList', \App\Visual::class))
        <li class="{{ \App\Utils::checkRoute([$route_name.'visuals.index', $route_name.'visuals.create']) ? 'active': '' }}">
            <a href="{{ route($route_name.'visuals.index') }}">
                <i class="fa fa-user-secret"></i> <span>Visuals</span>
            </a>
        </li>
    @endif
    @if (Auth::user()->can('viewList', \App\Quiz::class))
        <li class="{{ \App\Utils::checkRoute([$route_name.'quizzes.index', $route_name.'quizzes.create']) ? 'active': '' }}">
            <a href="{{ route($route_name.'quizzes.index') }}">
                <i class="fa fa-cube"></i> <span>Quizzes</span>
            </a>
        </li>
    @endif
    @if (Auth::user()->can('viewList', \App\Course::class))
        <li class="{{ \App\Utils::checkRoute([$route_name.'courses.index', $route_name.'courses.create']) ? 'active': '' }}">
            <a href="{{ route($route_name.'courses.index') }}">
                <i class="fa  fa-cubes"></i> <span>Courses</span>
            </a>
        </li>
    @endif
    @if (Auth::user()->can('viewListInCoursse', \App\Course::class))
        <li class="{{ \App\Utils::checkRoute([$route_name.'courses.listCourses', $route_name.'courses.enrollment']) ? 'active': '' }}">
            <a href="{{ route($route_name.'courses.listCourses') }}">
                <i class="fa  fa-cubes"></i> <span>My Courses</span>
            </a>
        </li>
    @endif

    @if (Auth::user()->can('coursesEnrollemnt', \App\Course::class))
        <li class="{{ \App\Utils::checkRoute([$route_name.'courses.enrollment']) ? 'active': '' }}">
            <a href="{{ route($route_name.'courses.enrollment') }}">
                <i class="fa  fa-plus"></i> <span>My Courses</span>
            </a>
        </li>
    @endif
</ul>