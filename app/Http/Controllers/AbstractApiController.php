<?php


namespace App\Http\Controllers;


use App\Traits\RestExceptionHandler;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use App\Http\Controllers\Controller;
use Validator;

abstract class AbstractApiController extends Controller
{
    use RestExceptionHandler;

    protected $resource;
    protected $model;

    public function __construct(Resource $resource, Model $model)
    {
        $this->resource = $resource;
        $this->model = $model;
    }

    public function index(Request $request)
    {
        if (
            !is_null($request->get('per_page')) &&
            $request->get('per_page') < 1000
        ) {
            $model = $this->model->paginate($request->get('per_page'));
        } else {
            $model = $this->model->paginate();
        }
        return $this->resource->collection($model);
    }

    public function show(int $id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            return $this->jsonResponse([], 200);
        }
        $this->resource->withoutWrapping();
        return $this->resource->make($model);
    }

    public function destroy(int $id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            return $this->jsonResponse([], 200);
        }
        try {
            $model->delete();
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => 'Could not destroy a model'], 500);
        }
        return $this->jsonResponse([], 204);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->storeRules());

        if ($validator->fails()) {
            $errors = $validator->messages()->messages();
            return $this->jsonResponse($errors, 400);
        }

        $newModel = $this->model->newInstance($request->all());
        if ($newModel->save()) {
            $this->resource->withoutWrapping();
            return $this->resource->make($newModel);
        }
        return $this->jsonResponse(['error' => 'Could not create a model'], 500);
    }

    public function update(Request $request)
    {
//        $validator = Validator::make($request->all(), $this->updateRules());

//        if ($validator->fails()) {
//            $errors = $validator->messages()->messages();
//            return $this->jsonResponse($errors, 400);
//        }

        $model = $this->model->find($request->get('id'));
        if (!$model) {
            return $this->modelNotFound();
        }
        $model->update($request->all());
    }

    abstract protected function updateRules(): array;

    abstract protected function storeRules(): array;
}