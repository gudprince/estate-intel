<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'name'=> 'book1',
                'isbn' => '324255225-6666',
                'authors' => ['James Paul','Anochie Joel' ],
                'number_of_pages' => 34,
                'publisher'=> 'Okoro Hero',
                'country' => 'Nigeria',
                'release_date'=> '1999-08-01'
            ],
            [
                'name'=> 'book2',
                'isbn' => '7255225-6666',
                'authors' => ['Paul King','Anochie Joel' ],
                'number_of_pages' => 347,
                'publisher'=> 'King Het',
                'country' => 'England',
                'release_date'=> '2000-08-01'
            ],
            [
                'name'=> 'book3',
                'isbn' => '5677-6666',
                'authors' => ['Joe Ebuka','Dan Sunday' ],
                'number_of_pages' => 347,
                'publisher'=> 'Sunday Test',
                'country' => 'Ghana',
                'release_date'=> '2001-08-01'
            ],
        ];

        foreach($data as $book){
            
            Book::create($book);
        } 
    }
}
