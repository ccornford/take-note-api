<?php namespace App\Api\V1\Controllers;

use App\Api\V1\Repos\Note\EloquentNoteRepository as NoteRepository;
use App\Api\V1\Transformers\NoteTransformer;
use Illuminate\Http\Request;

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
        $this->validate($request, [
            'group_id' => 'required',
            'name' => 'required'
        ]);

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

        if( ! $note )
        {
            return $this->response->errorNotFound();
        }

        return $this->response->item($note, new NoteTransformer);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $note = $this->noteRepository->findOrFail($id);
        $note->update($request);

        return $this->response->item($note, new NoteTransformer);
    }

    /**
     * @param  int  $id
     */
    public function destroy($id)
    {
        if( ! $this->noteRepository->findAndDelete($id) )
        {
            return $this->response->errorNotFound();
        }
    }

}