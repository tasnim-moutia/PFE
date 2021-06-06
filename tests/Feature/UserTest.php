<?php

namespace Tests\Feature;
use App\Models\User;
use Database\Factories\UserFactroy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
   /* public function test_it_allow_logged_in_user()
    {
       $user = factory(User::class)->create();
       $this->actingAs($user);
       $response = $this->get('/home')
       $response->assertStatus(302);

        $this->assertOK();
    }*/
   /* public function a_user_can_be_added_throught_the_form()
    {
        
        $this->withoutExceptionHandLing();
        
        testcase::factory()->count(50)->create();
        $this->actingAs(factory(User::class)->create());
        $response = $this->post('/auth/register',[
            'nom' => 'test',
            'email' => 'test@test.tn',
            'num' => 'test@test.tn',
            
        ]);

        $this->assertCount(1,Customer::all());
    }*/
}
