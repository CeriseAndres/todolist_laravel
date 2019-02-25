<?php

use Illuminate\Database\Seeder;
use App\Status;
use App\Todolist;
use App\Comment;
use App\User;
use App\Todoaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         Status::create(
//             [
//                 'label' => 'A faire',
//             ]
//             );
//         Status::create(
//             [
//                 'label' => 'En cours',
//             ]
//             );
//         Status::create(
//             [
//                 'label' => 'Achevé',
//             ]
//             );
//         Status::create(
//             [
//                 'label' => 'Archivé',
//             ]
//             );
        $this->call(UsersTableSeeder::class);
        $this->call(TodolistsTableSeeder::class);
        $this->call(TodoactionsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
    
}
