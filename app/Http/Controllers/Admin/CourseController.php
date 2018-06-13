<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\RandomStringGenerator;
use App\Traits\Controllers\ResourceController;
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
        $values['status_id'] = $request->input('status', 0);
        return $values;
    }
    private function alterValuesToSave(Request $request, $values)
    {
        if ((int) $values['status_id'] === 1) {
            $values['code_invite'] = "";
        } else {
            if ($values['code_invite'] == "") {
                while (Course::where('code_invite', $values['code_invite'])->count() > 0) {
                    $values['code_invite'] = RandomStringGenerator(5);
                }
            }

        }
        return $values;
    }
}
