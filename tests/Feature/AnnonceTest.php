<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Annonce;
use App\Models\Categorie;
use Database\Factories\AnnonceFactroy;
use Database\Factories\CategorieFactroy;

class AnnonceTest extends TestCase
{    
   

   /* protected function setUp(): void
    {
        parent::setUp();

        $this->product = Product::create([
            'name' => 'Car',
            'price' => 100
        ]);
    }*/
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_annonce_belongs_to_categorie(){
        //arrange /set up
        $annonce=\App\Models\Annonce::factory()->create();
        $categorie=\App\Models\Categorie::factory()->create();

        
        //act
        $annonce->categorie()->associat($categorie)->save();

        //assert
        $this->assertDatabaseHas('annonces', [
                'id' => $annonce->id,
                'categorie_id'=> $categorie->id,
        ]);
    }

    /**@test */
    public function test_only_logged_in_uesers_can_access_mes_annonces(){
         
        $response = $this->get('/annonce/index')
                         ->assertRedirect('/auth/login');
     }   
}
