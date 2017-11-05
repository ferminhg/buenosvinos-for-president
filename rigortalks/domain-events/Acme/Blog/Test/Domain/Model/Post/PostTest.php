<?php

use Acme\Blog\Domain\Model\Post\Post;
use Acme\Blog\Domain\Model\User\User;
use PHPUnit\Framework\TestCase;

/**
 * Class PostTest
 */
class PostTest extends TestCase
{
    /**
     * @test
     */
    public function givenOneDraftPostWhenPublishedThenStatusIsPublished()
    {
        $post = new Post(1, 'Rigor Talk', 'My Content', 1);
        $this->assertSame(Post::POST_STATUS_DRAFT, $post->status());

        $author = new User(1);
        $post->publish($author);

        $this->assertSame(Post::POST_STATUS_PUBLISHED, $post->status());
        //Test que los eventos funcionan
        $this->assertCount(1, $post->getEvents());
    }
}