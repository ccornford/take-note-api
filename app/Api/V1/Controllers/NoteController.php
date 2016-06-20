<?php namespace App\Api\V1\Controllers;

use App\Api\V1\Repos\Note\EloquentNoteRepository as NoteRepository;
use App\Api\V1\Transformers\NoteTransformer;
use Dingo\Api\Exception as DingoException;
use Illuminate\Http\Request;
use Validator;

class NoteController extends ApiController {

    private $noteRepository;

    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    /**
     * @param $groupId
     * @return \Dingo\Api\Http\Response
     */
    public function index($groupId)
    {
        $notes = $this->noteRepository->belongsToGroup($groupId);

        if(count($notes) == 0)
        {
            return $this->response->errorNotFound();
        }

        return $this->response->collection($notes, new NoteTransformer);
    }

    /**
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            throw new DingoException\StoreResourceFailedException('Could not create note.', $validator->errors());
        }

        $this->noteRepository->create($request->all());

        return $this->response->created();
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $note = $this->noteRepository->findOrFail($id);

        return $this->response->item($note, new NoteTransformer);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Dingo\Api\Http\Response
     * @throws UpdateResourceFailedException
     */
    public function update(Request $request, $id)
    {
        $validator = Validate::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            throw new DingoException\UpdateResourceFailedException('Could not update note.', $validator->errors());
        }

        $note = $this->noteRepository->findAndUpdate($id, $request->all());

        return $this->response->item($note, new NoteTransformer);
    }

    /**
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function destroy($id)
    {
        $this->noteRepository->findAndDelete($id);

        return $this->response->noContent();
    }

}