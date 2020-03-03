<?php

use App\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // take data from json file
        $source_file = storage_path('books.json');
        $data = json_decode(file_get_contents($source_file), true);
        
        // put it into our database

        foreach ($data as $book_data){
            $publisher = new Publisher;
            $publisher->title = $book_data['publisher'];
            $publisher->title = $book_data['publishers'];
            $publisher->save();
        }    
    }
}
