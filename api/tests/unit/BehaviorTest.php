<?php
namespace api\tests\unit;
use api\models\Book;

class BehaviorTest extends \yii\codeception\TestCase
{
    public $appConfig = '@tests/unit/_config.php';

    public function testSaveManyToMany()
    {
        //load
        $book = Book::findOne(5);

        //simulate form input
        $post = [
            'Book' => [
                'author_list' => [7, 9, 8]
            ]
        ];

        $this->assertTrue($book->load($post), 'Load POST data');
        $this->assertTrue($book->save(), 'Save model');

        //reload
        $book = Book::findOne(5);

        //must have three authors
        $this->assertEquals(3, count($book->authors), 'Author count after save');

        //must have authors 7, 8, and 9
        $author_keys = array_keys($book->getAuthors()->indexBy('id')->all());
        $this->assertContains(7, $author_keys, 'Saved author exists');
        $this->assertContains(8, $author_keys, 'Saved author exists');
        $this->assertContains(9, $author_keys, 'Saved author exists');
    }

    public function testResetOneToMany()
    {
        //load
        $book = Book::findOne(3);

        //simulate form input
        $post = [
            'Book' => [
                'review_list' => []
            ]
        ];

        $this->assertTrue($book->load($post), 'Load POST data');
        $this->assertTrue($book->save(), 'Save model');

        //reload
        $book = Book::findOne(3);

        //must have zero reviews
        $this->assertEquals(0, count($book->reviews), 'Review count after save');
    }

}