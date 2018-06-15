<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Quiz;
use App\User;
use App\Traits\Controllers\ResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    use ResourceController;

    /**
     * @var string
     */
    protected $resourceAlias = 'dashboard.quizzes';

    /**
     * @var string
     */
    protected $resourceRoutesAlias = 'dashboard::quizzes';

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
            return $this->getResourceModel()::where('name', 'like', '%' . $search . '%')->paginate($show);
        }

        return User::find(Auth::user()->id)->Quizzes()->paginate($show);
    }

    private function detroyRelations($id)
    {
        $record = $this->getResourceModel()::findOrFail($id);
        $record->Questions()->detach();
        $record->Visual()->detach();
    }
    public function showDetail($id)
    {
        $record = Quiz::findOrFail($id);
        $questions = $record->Questions;
        return view('dashboard.quizzes.detail', ['record' => $record, 'records' => $questions]);
    }
    public function removeQuestion($idQuiz, $idQuenstion)
    {
        $record = $this->getResourceModel()::findOrFail($idQuiz);
        $record->Questions()->detach($idQuenstion);
        return redirect()->back();
    }
    public function disableQuiz($id)
    {
        Quiz::whereId($id)->update(['status' => 0]);
        return redirect()->back();
    }
    public function enableQuiz($id)
    {
        Quiz::whereId($id)->update(['status' => 2]);
        return redirect()->back();}
    public function publicQuiz($id)
    {
        Quiz::whereId($id)->update(['status' => 1]);
        return redirect()->back();
    }
}
