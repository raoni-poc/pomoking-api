<?php

namespace App\Http\Controllers;

use App\ActiveRecord\Category;
use App\Traits\RestExceptionHandler;
use Illuminate\Http\Request;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends AbstractApiController
{

    public function __construct(CategoryResource $resource, Category $category)
    {
        parent::__construct($resource, $category);
    }

//    public function index(Request $request)
//    {
//        //ex.: pag 1 - http://localhost:8000/api/v1/categories
//        //     pag 2 - http://localhost:8000/api/v1/categories?page=2
//        if (
//            !is_null($request->get('per_page')) &&
//            $request->get('per_page')<1000
//        ) {
//            $category = $this->category->paginate($request->get('per_page'));
//        } else {
//            $category = $this->category->paginate();
//        }
//        return $this->resource->collection($category);
//    }
//
//    public function show(int $id)
//    {
//        $category = $this->category->find($id);
//        if (!$category) {
//            return $this->modelNotFound('category not found');
//        }
//        return $this->resource->make($category);
//    }
//
//    public function destroy(int $id)
//    {
//        $category = $this->category->find($id);
//        if (!$category) {
//            return $this->modelNotFound('category not found');
//        }
//        try{
//            $category->delete();
//        } catch (\Exception $e){
//            return $this->jsonResponse(['error' => 'Could not destroy a category'], 500);
//        }
//        return $this->resource->make($category);
//    }
//
//    public function store(Request $request)
//    {
//        $category = $this->category->newInstance();
//        if(isset($request->category) && !empty($request->category)){
//            $category->category = $request->get('category');
//        }
//        $category->created_at = date('Y-m-d h:i:s');
//        $category->updated_at = date('Y-m-d h:i:s');
//        if ($category->save()) {
//            return $this->resource->make($category);
//        }
//        return $this->jsonResponse(['error' => 'Could not create a category'], 500);
//    }
//
//    public function update(Request $request)
//    {
//        $category = $this->category->find($request->get('category_id'));
//        if (!$category) {
//            return $this->modelNotFound('category not found');
//        }
//        if (isset($request->category) || !empty($request->category)) {
//            $category->start = $request->get('category');
//        }
//        $category->updated_at = date('Y-m-d h:i:s');
//        if ($category->save()) {
//            return $this->resource->make($category);
//        }
//        return $this->jsonResponse(['error' => 'Could not updated a period'], 500);
//    }

    protected function updateRules(): array
    {
        return [];
    }

    protected function storeRules(): array
    {
        return ['category' => 'required|max:225',];
    }
}
