<?php

use App\Book;
use App\Publisher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('TRUNCATE TABLE books');
        DB::statement('TRUNCATE TABLE publishers');

        // take data from the JSON file
        $source_file = storage_path('books.json');
        
        $data = json_decode(
            file_get_contents($source_file), 
            true
        );

        $publishers_by_name = Publisher::pluck('id', 'title')->toArray();

        // put it into our database 
        foreach ($data as $book_data) {

            if (!isset($publishers_by_name[$book_data['publisher']])) {
                $publisher = new Publisher;
                $publisher->title = $book_data['publisher'];
                $publisher->save();

                $publishers_by_name[$book_data['publisher']] = $publisher->id;
            }

            $book = new Book;
            $book->publisher_id = $publishers_by_name[$book_data['publisher']];
            $book->fill([
                'title' => $book_data['title'],
                'authors' => $book_data['author'],
                'image' => $book_data['image'],
            ]);
            $book->save();
        }
    }
}