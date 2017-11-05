<?php

namespace Acme\Blog\Domain\Model\Post;

use Acme\Blog\Application\Post\PostWasPublished;
use Acme\Blog\Domain\Model\User\User;

/**
 * Class Post
 *
 * @package Acme\Blog\Domain\Model\Post
 */
class Post
{
    const POST_STATUS_PUBLISHED = 1;
    const POST_STATUS_DRAFT = 0;
    private $id;
    private $title;
    private $content;
    private $authorId;
    private $status;

    /**
     * Post constructor.
     *
     * @param $id
     * @param $title
     * @param $content
     * @param $authorId
     */
    public function __construct($id, $title, $content, $authorId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->authorId = $authorId;
        $this->status = self::POST_STATUS_DRAFT;
    }

    public function publish(User $user)
    {
        $this->assertUserIsAuthorOfThisPost($user);
        $this->status = self::POST_STATUS_PUBLISHED;

        //new PostWasPublished($this->id(), $user->id())

        return $this;
    }

    /**
     * @param User $user
     * @throws UserIsNotPostAuthorException
     */
    protected function assertUserIsAuthorOfThisPost(User $user)
    {
        if ($user->id() !== $this->authorId()) {
            throw new UserIsNotPostAuthorException();
        }
    }

    private function authorId()
    {
        return $this->authorId;
    }


}