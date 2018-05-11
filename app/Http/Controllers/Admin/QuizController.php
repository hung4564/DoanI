<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Quiz;
use App\Traits\Controllers\ResourceController;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    use ResourceController;

    /**
     * @var string
     */
    protected $resourceAlias = 'admin.quizzes';

    /**
     * @var string
     */
    protected $resourceRoutesAlias = 'admin::quizzes';

    /**
     * Fully qualified class name
     *
     * @var string
     */
    protected $resourceModel = Quiz::class;

    /**
     * @var string
     */
    protected $resourceTitle = 'Quizzes';

    /**
     * Used to validate store.
     *
     * @return array
     */
    private function resourceStoreValidationData()
    {

        return [
            'rules' => [
                'name' => 'required|min:3|',
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
                'name' => 'required|min:3|',
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
        $values['visual_id'] = $request->input('visual', '1');
        $values['status'] = $request->input('status', '0');
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
        if (!empty($search)) {
            return $this->getResourceModel()::like('name', $search)->paginate($show);
        }

        return $this->getResourceModel()::paginate($show);
    }
}
