<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;
use App\Quiz;
use App\Traits\Controllers\ResourceController;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    use ResourceController;
    protected $quizID = null;
    /**
     * @var string
     */
    protected $resourceAlias = 'admin.questions';

    /**
     * @var string
     */
    protected $resourceRoutesAlias = 'admin::questions';

    /**
     * Fully qualified class name
     *
     * @var string
     */
    protected $resourceModel = Question::class;

    /**
     * @var string
     */
    protected $resourceTitle = 'Questions';

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
        $values['choices'] = $request->input('choices', '');
        $values['answer'] = $request->input('answer', '');
        $values['points'] = $request->input('points', '');
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
        if ($this->quizID != null) {
            return Quiz::findOrFail($this->quizID)->Questions()->paginate($show);
        }
        return $this->getResourceModel()::paginate($show);
    }
    public function getListbyQuiz(Request $request, $quizID)
    {
        $this->quizID = $quizID;
        return $this->index($request);
    }
    public function editByQuiz(Request $request, $quizID, $questionID)
    {
        $this->quizID = $quizID;
        return $this->edit($questionID);
    }
    public function createByQuiz(){
      
    }
    public function destroyByQuiz(){

    }
    public function storeByQuiz(){

    }
    public function updateByQuiz(){

    }
    private function filterSearchViewData(Request $request, $data = [])
    {
        if ($this->quizID != null) {
            $data['resourceTitle'] = Quiz::findOrFail($this->quizID)->name;
            $data['quizID'] = $this->quizID;
            $data['resourceRoutesAlias']="admin::QuizQuestion";
        }
        return $data;
    }
    private function filterEditViewData($record, $data = [])
    {
        if ($this->quizID != null) {
            $data['quizID'] = $this->quizID;
            $data['resourceRoutesAlias']="admin::QuizQuestion";
        }
        return $data;
    }
}
