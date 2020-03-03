<?php

use App\Book;
use App\Publisher;
use Illuminate\Support\Arr;
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
        // take data from json file
        DB::statement('TRUNCATE TABLE books');
        DB::statement('TRUNCATE TABLE publishers');
        $source_file = storage_path('books.json');
        $data = json_decode(file_get_contents($source_file), true);
        
        $data = Arr::sort($data, function($a) {
            return $a['publisher'];
        });
        var_dump($data);
        // Sorting the data by publisher so it works perfectly with the pluck method below. https://stillat.com/blog/2018/04/11/laravel-5-sorting-arrays-with-sort
        
        $publishers_by_name = Publisher::pluck('id', 'title')->toArray();
        // $publishers_by_name = $publishers_by_name->sortBy('title');

        
                
        // put it into a database

        foreach ($data as $book_data){            
            
            if (!isset($publishers_by_name[$book_data['publisher']])) {
                $publisher = new Publisher;
                $publisher->title = $book_data['publisher'];
                $publisher->save();
                $publishers_by_name = Publisher::pluck('id', 'title');
            } 


            $book = new Book;
            $book->publisher_id = $publisher->id;
            $book->genre_id = 0;
            $book->title =   $book_data['title'];
            $book->authors = $book_data['author'];
            $book->image =   $book_data['image'];
            $book->save();
            var_dump($book->publisher_id);

        }

    }
}
