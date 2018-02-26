<?php

namespace Tests\App\ActiveRecord;

use App\ActiveRecord\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    public function testCreateAndDelete()
    {
        $category = new Category();
        $category->category = 'category test';
        $category->save();

        $id = $category->id;

        $categoryAssert = Category::find($id);

        $this->assertEquals($category->category, $categoryAssert->category);

        $category->delete();

        $this->assertNull(Category::find($id));
    }
}
