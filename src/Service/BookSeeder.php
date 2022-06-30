<?php
namespace App\Service;

use Pimcore\Model\DataObject;
use App\Service\SlugGenerator;

class BookSeeder implements SeederInterface
{
    public function __construct(private SlugGenerator $slugGenerator)
    {}
    public function seed(array $books)
    {
        $this->deleteAllBooks();
        foreach($books as $book)
        {
            $bookDirId = 5317; // ID for the books directory in data object
            //$book = Book::create($book);
            $obj = new DataObject\Book();
            $obj->setKey(\Pimcore\Model\Element\Service::getValidKey($this->slugGenerator->generate($book['title']), 'object'))
                 ->setParentId($bookDirId)
                 ->setIsbn($book['isbn'])
                 ->setTitle($book['title'])
                 ->setAuthor($book['author'])
                 ->setPages($book['pages'])
                 ->setPublished(true)
                 ->save();
        }
    }
    //This function is for debugging purpose only.
    private function deleteAllBooks()
    {
       $books = new DataObject\Book\Listing();
       $books->setUnpublished(true);
       foreach($books as $book){
        var_dump($book->getIsbn());
        $book->delete();
       }
    }
}