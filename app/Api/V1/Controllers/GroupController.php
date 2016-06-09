<?php namespace App\Api\V1\Controllers;

use App\Api\V1\Repos\Group\EloquentGroupRepository as GroupRepository;
use App\Api\V1\Transformers\GroupTransformer;
use Illuminate\Http\Request;

class GroupController extends ApiController {

    private $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $groups = $this->groupRepository->all();

        return $this->response->collection($groups, new GroupTransformer);
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

        $this->groupRepository->create($request->all());

        return $this->response->created();
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $group = $this->groupRepository->findOrFail($id);

        if( ! $group )
        {
            return $this->response->errorNotFound();
        }

        return $this->response->item($group, new GroupTransformer);
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

        $group = $this->groupRepository->findOrFail($id);
        $group->update($request);

        return $this->response->item($group, new GroupTransformer);
    }

    /**
     * @param  int  $id
     */
    public function destroy($id)
    {
        if( ! $this->groupRepository->findAndDelete($id))
        {
            return $this->response->errorNotFound();
        }
    }

}