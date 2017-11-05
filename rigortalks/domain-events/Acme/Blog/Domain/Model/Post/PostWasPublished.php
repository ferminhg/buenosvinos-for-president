<?php

namespace Acme\Blog\Domain\Model\Post;

use Ddd\Domain\DomainEvent;


/**
 * Class PostWasPublished
 * @package Acme\Blog\Domain\Model\Post
 */
class PostWasPublished implements DomainEvent
{
    private $userId;
    private $postId;
    private $occurredOn;

    public function __construct($userId, $postId)
    {
        $this->userId = $userId;
        $this->postId = $postId;
        $this->occurredOn = (new \DateTimeImmutable())->getTimestamp();
    }

    public function occurredOn()
    {
        return $this->occurredOn;
    }

    public function userId()
    {
        return $this->userId;
    }

    public function postId()
    {
        return $this->postId;
    }

}
