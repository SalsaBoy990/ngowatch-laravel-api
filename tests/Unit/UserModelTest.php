<?php

namespace Tests\Unit;

use App\Models\User;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class UserModelTest extends TestCase
{
    use DatabaseTransactions;
    // use DatabaseMigrations;

    /**
     * Admin user exists
     */
    public function test_superadmin_user_exists(): void
    {
        // create user
        $user = User::findOrFail(1);

        $hasUser = $user ? true : false;

        $this->assertTrue($hasUser);
        $this->assertEquals('gulandras90@gmail.com', $user->email);
    }

}
