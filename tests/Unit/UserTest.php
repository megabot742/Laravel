<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_login_form()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
    public function test_user_duplication()
    {
        $user1 = User::make([
            'name' => 'loc',
            'email' => 'loc@gmail.com'
        ]);
        $user2 = User::make([
            'name' => 'toan',
            'email' => 'toan@gmail.com'
        ]);

        $this->assertTrue($user1->name != $user2->name);
    }
    //Test post HTTP
    public function test_user_login()
    {
        $response = $this->post('/login', [
            'email' => 'admin@gmail.com',
            'pass' => '123'
        ]);
        $response->assertRedirect('/adhome');
    }
    //Test database 
    public function test_database()
    {
        $this->assertDatabaseHas('users',[
            'name' => 'tuan'
        ]);
    }
    //Delete user
    public function test_delete_user()
    {
        $user = User::factory()->count(1)->make();

        $user = User::first();

        if($user) {
            $user->delete();
        }

        $this->assertTrue(true);
    }
}
