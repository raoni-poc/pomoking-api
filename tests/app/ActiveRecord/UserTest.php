<?php

namespace Tests\App\ActiveRecord;

use App\ActiveRecord\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    public function testCreateAndDelete()
    {
        $email = 'user'.mt_rand(0,999999999).'@test.com';
        $user = new User();
        $user->name = 'User Test';
        $user->password = password_hash('Pass Test', PASSWORD_DEFAULT);
        $user->email = $email;


        $this->assertTrue($user->save());

        $id = $user->id;
        $userAssert = User::find($id);

        $this->assertTrue($userAssert instanceof User);
        $this->assertEquals($userAssert->name, 'User Test');
        $this->assertTrue(password_verify('Pass Test', $userAssert->password));
        $this->assertEquals($userAssert->email, $email);
        $this->assertTrue($user->delete());
        $this->assertNull(User::find($id));
    }
}
