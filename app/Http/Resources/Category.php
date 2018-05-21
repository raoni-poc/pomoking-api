<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\ActiveRecord\Category as CategoryModel;

class Category extends Resource
{
    public function __construct(CategoryModel $category)
    {
        parent::__construct($category);
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
