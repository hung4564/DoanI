<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Controllers\ResourceController;
use App\Lesson;

class LessonController extends Controller
{
  use ResourceController;

  /**
   * @var string
   */
  protected $resourceAlias = 'admin.lessons';

  /**
   * @var string
   */
  protected $resourceRoutesAlias = 'admin::lessons';

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
      if (! empty($search)) {
          return $this->getResourceModel()::where('title', 'like' ,'%'.$search.'%')->paginate($show);
      }

      return $this->getResourceModel()::paginate($show);
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
      $values['title'] = $request->input('title', '');
      $values['link'] = $request->input('detail', '');
      $values['type'] = $request->input('type', '0');
      $values['course_id'] = $request->input('course_id', '0');
      $values['level'] = $request->input('level', '0');
      return $values;
  }

}
