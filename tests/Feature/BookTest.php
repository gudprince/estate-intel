<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
  
    protected function testcreate()
    {
        

        $response = $this->json('POST',url('api/v1/books'),[
            'name'  => 'first book',
            'isbn'  => 'testing1',
            'publisher'  => 'testing',
            'country'  => 'testing',
            'number_of_pages'  => 456,
            'release_date'  => 'testing',
            'authors'  => ['firs author', 'second author'],
        ]);
        $response->assertStatus(200);
        return $response['data']['id'];
       
       
    }

    public function testAll(){
      
        $response = $this->json('GET',url('api/v1/books'));
        $response->assertStatus(200);

    }

    public function testShow(){
      
        $id =  $this->testcreate();
        $response =  $this->json('GET',url('api/v1/books', ['id' => $id]));
        $response->assertStatus(200);

    }

    public function testUpdate(){

        $id =  $this->testcreate();
       
        // Call routing and assert response
        $response = $this->json('PUT',url('api/v1/books', ['id' => $id]),[
            'name'  => 'second book',
            'isbn'  => 'testing1',
            'publisher'  => 'testing',
            'country'  => 'testing',
            'number_of_pages'  => 7666,
            'release_date'  => 'testing',
            'authors'  => ['firs author', 'second author'],
        ]);
       
        $response->assertStatus(200);
        $this->assertArrayHasKey('data',$response);
    }

    public function testDelete(){
        $id =  $this->testcreate();
        $response =  $this->json('delete',url('api/v1/books', ['id' => $id]));
        $response->assertStatus(200);

    }
}
