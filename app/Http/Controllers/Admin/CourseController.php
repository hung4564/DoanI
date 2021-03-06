<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Traits\Controllers\ResourceController;
use App\User;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    use ResourceController;

    /**
     * @var string
     */
    protected $resourceAlias = 'admin.courses';

    /**
     * @var string
     */
    protected $resourceRoutesAlias = 'admin::courses';

    /**
     * Fully qualified class name
     *
     * @var string
     */
    protected $resourceModel = Course::class;

    /**
     * @var string
     */
    protected $resourceTitle = 'courses';
    /**
     * Retrieve the list of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $show
     * @param string|null $search
     * @return \Illuminate\Support\Collection
     */
    private function getSearchRecords(Request $request, $show = 15, $search = null)
    {
        if (!empty($search)) {
            return $this->getResourceModel()::where('name', 'like', '%' . $search . '%')->paginate($show);
        }
        return $this->getResourceModel()::paginate($show);
    }
    /**
     * Used to validate store.
     *
     * @return array
     */
    private function resourceStoreValidationData()
    {
        return [
            'rules' => [
                'name' => 'required|min:3|max:255',
                'detail' => 'required|max:255',
            ],
            'messages' => [],
            'attributes' => [],
        ];
    }

    /**
     * Used to validate update.
     *
     * @param $record
     * @return array
     */
    private function resourceUpdateValidationData($record)
    {
        return [
            'rules' => [
                'name' => 'required|min:3|max:255',
                'detail' => 'required|max:255',
            ],
            'messages' => [],
            'attributes' => [],
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param null $record
     * @return array
     */
    private function getValuesToSave(Request $request, $record = null)
    {
        $creating = is_null($record);
        $values = [];
        $values['teacher_id'] = Auth::user()->id;
        $values['code_invite'] = $request->input('code_invite', '');
        $values['name'] = $request->input('name', '');
        $values['detail'] = $request->input('detail', '');
        $values['status_id'] = (int) $request->input('status', 0);
        if ((int) $values['status_id'] == 1) {
            $values['code_invite'] = "";
        } else {
            if ($values['code_invite'] == "") {
                do {
                    $values['code_invite'] = RandomStringGenerator(5);
                } while (Course::where('code_invite', $values['code_invite'])->count() > 0);
            }

        }
        return $values;
    }
    private function alterValuesToSave(Request $request, $values)
    {
        return $values;
    }
    private function updateRelations(Request $request, $id)
    {
        // $categorys sẽ lưu dữ liệu của các thẻ mới
        $record = $this->getResourceModel()::findOrFail($id);
        $categorys = $request->input('categorys', '');
        $record->Categories()->sync($categorys);
    }
    private function detroyRelations($id)
    {
        $record = $this->getResourceModel()::findOrFail($id);
        $record->Categories()->detach();
    }
    public function showDetail($id, $show = 15)
    {
        $record = Course::findOrFail($id);
        return view('admin.courses.detail', ['record' => $record]);
    }
    public function addQuiz($course_id, $quiz_id)
    {
        $record = $this->getResourceModel()::findOrFail($course_id);
        $record->Quizzes()->attach($quiz_id);
        return redirect()->back();
    }
    public function removeQuiz($course_id, $quiz_id)
    {
        $record = $this->getResourceModel()::findOrFail($course_id);
        $record->Quizzes()->detach($quiz_id);
        return redirect()->back();
    }
    public function addStudent($course_id, $user_id)
    {
        $record = $this->getResourceModel()::findOrFail($course_id);
        if ($record->Students_wait->contains('id', $user_id)) {
            $record->Students_wait()->attach([$user_id => ['status_id' => 1]]);
        }
        if (!$record->Students->contains('id', $user_id)) {
            $record->Students()->attach([$user_id => ['status_id' => 1]]);
        }

        return redirect()->back();
    }
    public function removeStudent($course_id, $user_id)
    {
        $record = $this->getResourceModel()::findOrFail($course_id);
        $record->Students()->detach($user_id);
        return redirect()->back();
    }
    public function addLesson($course_id, $lesson_id)
    {
      Lesson::whereId($lesson_id)->update(['course_id' => $course_id]);
      return redirect()->back();
    }
    public function removeLesson($course_id, $lesson_id)
    {
        Lesson::whereId($lesson_id)->update(['course_id' => 0]);
        return redirect()->back();
    }
    public function disableCourse($id)
    {
        Course::whereId($id)->update(['status_id' => 0]);
        return redirect()->back();
    }
    public function enableCourse($id)
    {
        Course::whereId($id)->update(['status_id' => 2]);
        return redirect()->back();}
    public function publicCourse($id)
    {
        Course::whereId($id)->update(['status_id' => 1]);
        return redirect()->back();
    }
    public function listCourse(Request $request)
    {
        $paginatorData = [];
        $show = (int) $request->input('show', '');
        $show = (is_numeric($show) && $show > 0 && $show <= 100) ? $show : 15;
        if ($show != 15) {
            $paginatorData['show'] = $show;
        }
        $search = trim($request->input('search', ''));
        if (!empty($search)) {
            $paginatorData['search'] = $search;
        }
        if (!empty($search)) {
            $records = Auth::user()->inCourse()->where('name', 'like', '%' . $search . '%')->paginate($show);
        } else {
            $records = Auth::user()->inCourse()->paginate($show);
        }

        $records->appends($paginatorData);
        return view('admin.courses.list', $this->filterSearchViewData($request, [
            'records' => $records,
            'search' => $search,
            'resourceAlias' => $this->getResourceAlias(),
            'resourceRoutesAlias' => $this->getResourceRoutesAlias(),
            'resourceTitle' => $this->getResourceTitle(),
        ]));
    }
    public function coursesEnrollemnt(Request $request)
    {
        return view('admin.courses.enrollemnt', $this->filterSearchViewData($request, [
            'resourceAlias' => $this->getResourceAlias(),
            'resourceRoutesAlias' => $this->getResourceRoutesAlias(),
            'resourceTitle' => $this->getResourceTitle(),
        ]));
    }
    public function postEnrollemnt(Request $request)
    {
        $code_invite = $request->input('code_invite', '');
        if ($code_invite != "") {
            $course = Course::where('code_invite', "=", $code_invite)->first();
            if ($course != null) {
                if ($course->status_id == 1) {
                    $course->Students()->sync([Auth::id() => ['status_id' => 1]]);
                    return redirect()->back();
                } else {
                    $course->Students()->sync([Auth::id() => ['status_id' => 0]]);
                    return redirect()->back();
                }
            }
        }
        return redirect()->back();
    }
}
