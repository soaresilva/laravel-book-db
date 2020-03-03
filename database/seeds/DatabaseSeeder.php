<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // we can call all the other seeders here
        $this->call(BooksSeeder::class);
        // $this->call(PublisherSeeder::class);

    }
}
