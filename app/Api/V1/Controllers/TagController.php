<?php namespace App\Api\V1\Controllers;

use App\Api\V1\Repos\Tag\EloquentTagRepository as TagRepository;
use App\Api\V1\Transformers\TagTransformer;
use Illuminate\Http\Request;

class TagController extends ApiController {

    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param $groupId
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $tags = $this->tagRepository->all();

        return $this->response->collection($tags, new TagTransformer);
    }

    /**
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $this->tagRepository->create($request->all());

        return $this->response->created();
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $tag = $this->tagRepository->findOrFail($id);

        if( ! $tag )
        {
            return $this->response->errorNotFound();
        }

        return $this->response->item($tag, new TagTransformer);
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

        $tag = $this->tagRepository->findOrFail($id);
        $tag->update($request);

        return $this->response->item($tag, new TagTransformer);
    }

    /**
     * @param  int  $id
     */
    public function destroy($id)
    {
        if( ! $this->tagRepository->findAndDelete($id))
        {
            return $this->response->errorNotFound();
        }
    }

}