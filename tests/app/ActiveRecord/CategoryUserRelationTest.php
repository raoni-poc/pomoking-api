<?php

namespace Tests\App\ActiveRecord;

use App\ActiveRecord\Category;
use App\ActiveRecord\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryUserRelationTest extends TestCase
{
    public function testRelation()
    {
        $category = new Category();
        $category->category = 'category test';
        $category->save();

        $email = 'user'.mt_rand(0,999999999).'@test.com';
        $user = new User();
        $user->name = 'User Test';
        $user->password = password_hash('Pass Test', PASSWORD_DEFAULT);
        $user->email = $email;
        $user->save();

        $category->users()->attach($user);

        $categoryAssert = Category::find($category->id);
        $userAssert = User::find($user->id);

        $this->assertEquals($categoryAssert->users->first()->id, $user->id);
        $this->assertEquals($userAssert->categories->first()->id, $category->id);

        $user->delete();
        $category->delete();
    }
}