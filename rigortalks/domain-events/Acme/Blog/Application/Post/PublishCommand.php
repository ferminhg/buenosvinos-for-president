<?php

namespace Acme\Blog\Application\Post;

/** Clase DTO  */
class PublishCommand
{
    private $userId;
    private $postId;

    /**
     * PublishCommand constructor.
     *
     * @param $userId
     * @param $postId
     */
    public function __construct($userId, $postId)
    {
        $this->userId = $userId;
        $this->postId = $postId;
    }

    /**
     * @return integer
     */
    public function userId()
    {
        return $this->userId;
    }

    /**
     * @return integer
     */
    public function postId()
    {
        return $this->postId;
    }
}