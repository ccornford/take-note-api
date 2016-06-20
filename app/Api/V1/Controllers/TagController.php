<?php namespace App\Api\V1\Controllers;

use App\Api\V1\Repos\Tag\EloquentTagRepository as TagRepository;
use App\Api\V1\Transformers\TagTransformer;
use Dingo\Api\Exception as DingoException;
use Illuminate\Http\Request;
use Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            throw new DingoException\StoreResourceFailedException('Could not create tag.', $validator->errors());
        }

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

        return $this->response->item($tag, new TagTransformer);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validate::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            throw new DingoException\UpdateResourceFailedException('Could not update tag.', $validator->errors());
        }

        $tag = $this->tagRepository->findAndUpdate($id);

        return $this->response->item($tag, new TagTransformer);
    }

    /**
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function destroy($id)
    {
        $this->tagRepository->findAndDelete($id);

        return $this->response->noContent();
    }

}