<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        $books = [
            ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald'],
            ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee'],
            ['title' => '1984', 'author' => 'George Orwell'],
            ['title' => 'Moby Dick', 'author' => 'Herman Melville'],
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen'],
            ['title' => 'War and Peace', 'author' => 'Leo Tolstoy'],
            ['title' => 'The Catcher in the Rye', 'author' => 'J.D. Salinger'],
            ['title' => 'The Hobbit', 'author' => 'J.R.R. Tolkien'],
            ['title' => 'Anna Karenina', 'author' => 'Leo Tolstoy'],
            ['title' => 'The Adventures of Huckleberry Finn', 'author' => 'Mark Twain'],
            ['title' => 'Crime and Punishment', 'author' => 'Fyodor Dostoevsky'],
            ['title' => 'The Odyssey', 'author' => 'Homer'],
            ['title' => 'The Iliad', 'author' => 'Homer'],
            ['title' => 'Brave New World', 'author' => 'Aldous Huxley'],
            ['title' => 'Wuthering Heights', 'author' => 'Emily Bronte'],
            ['title' => 'Les Misérables', 'author' => 'Victor Hugo'],
            ['title' => 'The Grapes of Wrath', 'author' => 'John Steinbeck'],
            ['title' => 'Jane Eyre', 'author' => 'Charlotte Bronte'],
            ['title' => 'The Count of Monte Cristo', 'author' => 'Alexandre Dumas'],
            ['title' => 'The Brothers Karamazov', 'author' => 'Fyodor Dostoevsky'],
            ['title' => 'A Tale of Two Cities', 'author' => 'Charles Dickens'],
            ['title' => 'The Scarlet Letter', 'author' => 'Nathaniel Hawthorne'],
            ['title' => 'The Old Man and the Sea', 'author' => 'Ernest Hemingway'],
            ['title' => 'Fahrenheit 451', 'author' => 'Ray Bradbury'],
            ['title' => 'Great Expectations', 'author' => 'Charles Dickens']
        ];
        

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}

