<?php

use App\Book;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
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
            $book = new Book;
            $book->publisher_id = 0;
            $book->genre_id = 0;
            $book->title =   $book_data['title'];
            $book->authors = $book_data['author'];
            $book->image =   $book_data['image'];
            $book->save();
        }
        
    }
}
