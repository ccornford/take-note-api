<?php namespace App\Api\V1\Controllers;

use App\Api\V1\Repos\Group\GroupRepositoryInterface as GroupRepository;
use App\Api\V1\Transformers\SearchTransformer;
use Dingo\Api\Exception as DingoException;
use Validator;
use Illuminate\Http\Request;

class SearchController extends ApiController {

    protected $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'q' => 'required'
        ]);

        if ($validator->fails()) {
            throw new DingoException\ResourceException('Could not search.', $validator->errors());
        }
        $results = $this->groupRepository->search($request->get('q'));

        return $this->response->collection($results, new SearchTransformer);
    }

}