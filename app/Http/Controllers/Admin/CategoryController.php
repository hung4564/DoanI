<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Utils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Controllers\ResourceController;

class CategoryController extends Controller
{
  use ResourceController;

  /**
   * @var string
   */
  protected $resourceAlias = 'admin.categories';

  /**
   * @var string
   */
  protected $resourceRoutesAlias = 'admin::categories';

  /**
   * Fully qualified class name
   *
   * @var string
   */
  protected $resourceModel = Category::class;

  /**
   * @var string
   */
  protected $resourceTitle = 'Cateogries';

  /**
   * Used to validate store.
   *
   * @return array
   */
  private function resourceStoreValidationData()
  {
      return [
          'rules' => [
              'name' => 'required|min:3|max:255|unique:categories,name',
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
          'name' => 'required|min:3|max:255|unique:categories,name',
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
      $values['name'] = $request->input('name', '');
      $values['detail'] = $request->input('detail', '');
      return $values;
  }

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
      if (! empty($search)) {
          return $this->getResourceModel()::like('name', $search)->paginate($show);
      }

      return $this->getResourceModel()::paginate($show);
  }
}
