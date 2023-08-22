<?php

namespace Database\Seeders\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 *
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $superAdmin = Role::where('slug', 'super-administrator')->firstOrFail();
        $admin = Role::where('slug', 'administrator')->firstOrFail();
        $customer = Role::where('slug', 'customer')->firstOrFail();

        $user1 = new User();
        $user1->name = 'Gulácsi András';
        $user1->handle = 'guland.life';
        $user1->email = 'gulandras90@gmail.com';
        $user1->password = bcrypt('D3#^b&&q94k02z');
        $user1->enable_2fa = 1;
        $user1->handle = Str::slug($user1->name).'-'.$this->generateRandomString();
        $user1->role()->associate($superAdmin);
        $user1->save();
        $user1->refresh();

        $this->createUserDetail($user1);


        $user2 = new User();
        $user2->name = 'Trap Pista';
        $user2->email = 'trap@pista.com';
        $user2->password = bcrypt('password');
        $user2->handle = Str::slug($user2->name).'-'.$this->generateRandomString();
        $user2->save();
        $user2->role()->associate($admin);

        $user3 = new User();
        $user3->name = 'Winch Eszter';
        $user3->email = 'winch@eszter.hu';
        $user3->password = bcrypt('password');
        $user3->handle = Str::slug($user3->name).'-'.$this->generateRandomString();
        $user3->save();
        $user3->role()->associate($customer);
        $user3->refresh();

        $this->createUserDetail($user3);


    }


    /**
     * @param  int  $length
     * @return string
     * @throws Exception
     */
    private function generateRandomString(int $length = 5): string
    {
        return bin2hex(random_bytes($length));
    }


    /**
     * @param  User  $user1
     * @return void
     */
    private function createUserDetail(User $user1): void
    {
        UserDetail::factory()->create([
            'user_id' => $user1->id
        ]);
    }

}
