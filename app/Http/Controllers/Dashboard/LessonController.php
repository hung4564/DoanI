<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Lesson;
use App\Traits\Controllers\ResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
class LessonController extends Controller
{
    use ResourceController;

    /**
     * @var string
     */
    protected $resourceAlias = 'dashboard.lessons';

    /**
     * @var string
     */
    protected $resourceRoutesAlias = 'dashboard::lessons';

    /**
     * Fully qualified class name
     *
     * @var string
     */
    protected $resourceModel = Lesson::class;

    /**
     * @var string
     */
    protected $resourceTitle = 'Lessons';
    private function getSearchRecords(Request $request, $show = 15, $search = null)
    {
        if (!empty($search)) {
            return Auth::user()->Lessons()::where('name', 'like', '%' . $search . '%')->paginate($show);
        }
        return Auth::user()->Lessons()->paginate($show);
    }
    private function resourceStoreValidationData()
    {
        return [
            'rules' => [
                'title' => 'required|min:3|max:255',
                'detail' => 'required',
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
                'title' => 'required|min:3|max:255',
                'detail' => 'required',
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
        $values['user_id'] = Auth::id();
        $values['title'] = $request->input('title', '');
        $values['detail'] = $request->input('detail', '');
        $values['type'] = $request->input('type', '0');
        $values['link'] = "";
        $values['course_id'] = $request->input('course_id', '0');
        $values['level'] = $request->input('level', '0');
        return $values;
    }
    private function alterValuesToSave(Request $request, $values)
    {
        $file='demo.txt';
        $contents=$values['detail'];
        Storage::put($file, $contents);
        $values['link'] = $file;
        return $values;
    }
    private function filterEditViewData($record, $data = [])
    {
      $link=$record['link'];
      $data['record']['detail']=Storage::get($link);
      return $data;
    }
}
