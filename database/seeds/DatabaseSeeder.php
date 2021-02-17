<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    private $books = [
        [
            'title' => 'Los Pilares de la Tierra',
            'author' => 'Ken Follet',
            'editorial' => 'Espasa'
        ],
        [
            'title' => 'La Sombra del Viento',
            'author' => 'Carlos Ruiz Zafón',
            'editorial' => 'Planeta'
        ],
        [
            'title' => 'La reina del Sur',
            'author' => 'Arturo Pérez Reverte',
            'editorial' => 'Planeta'
        ],
        [
            'title' => 'Don Quijote de la Mancha',
            'author' => 'Miguel de Cervantes',
            'editorial' => 'Francisco de Robles'
        ],
        [
            'title' => 'La Regenta',
            'author' => 'Leopoldo Alas, Clarín',
            'editorial' => 'Alianza Editorial'
        ],
        [
            'title' => 'La Celestina',
            'author' => 'Fernando de Rojas',
            'editorial' => 'Burgos'
        ],
        [
            'title' => 'La ciudad y los perros',
            'author' => 'Mario Vargas Llosa',
            'editorial' => 'Seix Barral'
        ],
        [
            'title' => 'La colmena',
            'author' => 'Camilo José Cela',
            'editorial' => 'Emecé Editores'
        ],
        [
            'title' => 'Cien años de soledad',
            'author' => 'Gabriel García Márquez',
            'editorial' => 'Sudamericana'
        ],
    ];

    private function seedBooks(){
        DB::table('books')->delete();
        foreach($this->books as $book){
            $newBook = new \App\Book();
            $newBook->title = $book['title'];
            $newBook->author = $book['author'];
            $newBook->editorial = $book['editorial'];
            $newBook->save();
        }
    }

    public function run()
    {
        self::seedBooks();
        $this->command->info('Tabla Books inicializada con datos');
        // $this->call(UsersTableSeeder::class);
    }
}
