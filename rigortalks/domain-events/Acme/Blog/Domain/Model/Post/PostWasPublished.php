<?php

namespace Acme\Blog\Domain\Model\Post;


/**
 * Class PostWasPublished
 * @package Acme\Blog\Domain\Model\Post
 */
class PostWasPublished
{
    private $userId;
    private $postId;
    private $ocurredOn;

    public function __construct($userId, $postId)
    {
        $this->userId = $userId;
        $this->postId = $postId;
        $this->occcurredOn = (new \DateTimeImmutable())->getTimestamp();
    }

    public function ocurredOn()
    {
        return $this->ocurredOn;
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
