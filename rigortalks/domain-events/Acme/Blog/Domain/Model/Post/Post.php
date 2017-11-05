<?php

namespace Acme\Blog\Domain\Model\Post;

use Acme\Blog\Domain\Model\TriggerEventsTrait;
use Acme\Blog\Domain\Model\User\User;
use Ddd\Domain\DomainEventPublisher;

/**
 * Class Post
 *
 * @package Acme\Blog\Domain\Model\Post
 */
class Post
{
    use TriggerEventsTrait;

    const POST_STATUS_PUBLISHED = 10;
    const POST_STATUS_DRAFT = 20;

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

        DomainEventPublisher::instance()->publish(
            new PostWasPublished($this->id(), $user->id())
        );

        //forma estatica con un trait acumular eventos de dominio en la propia entidad
        $this->trigger(
             new PostWasPublished($this->id(), $user->id())
        );

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

    public function status()
    {
        return $this->status;
    }

    private function id()
    {
        return $this->id;
    }
}