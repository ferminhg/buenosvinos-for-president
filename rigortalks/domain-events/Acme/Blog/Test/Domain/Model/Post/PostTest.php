<?php

use Acme\Blog\Domain\Model\Post\Post;
use Acme\Blog\Domain\Model\TriggerEventsTrait;
use Acme\Blog\Domain\Model\User\User;
use Ddd\Domain\DomainEventPublisher;
use Ddd\Domain\DomainEventSubscriber;
use PHPUnit\Framework\TestCase;

//Listener que escucha todo
class DomainEventAllListener implements DomainEventSubscriber
{
    use TriggerEventsTrait;

    /**
     * @param \Ddd\Domain\DomainEvent $aDomainEvent
     */
    public function handle($aDomainEvent)
    {
        $this->trigger($aDomainEvent);
    }


    public function isSubscribedTo($aDomainEvent)
    {
        return true;
    }
}

/**
 * Class PostTest
 */
class PostTest extends TestCase
{
    private $listenerId;
    protected function setup()
    {
        $this->listenerId = DomainEventPublisher::instance()->subscribe(
            new DomainEventAllListener()
        );
    }

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


        $this->assertCount(
            1,
            DomainEventPublisher::instance()->ofId($this->listenerId)->getEvents()
        );

    }
}