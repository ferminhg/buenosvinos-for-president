<?php

namespace Acme\Blog\Application\Post;

use Acme\Blog\Domain\Model\Post\PostRepository;
use Acme\Blog\Domain\Model\User\UserRepository;

class Publish
{
    private $postRepository;
    private $userRepository;
    private $eventDispatcher;

    /**
     * Publish constructor.
     *
     * @param $userRepository
     * @param $postRepository
     */
    public function __construct(
        PostRepository $postRepository,
        UserRepository $userRepository,
        $eventDispacher)
    {
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
        $this->eventDispatcher = $eventDispacher;
    }


    public function handle(PublishCommand $command)
    {
        $user = $this->userRepository->ofIdOrFail($command->userId());
        $post = $this->postRepository->ofIdOrFail($command->postId());

        $post->publish($user);

        //Disparar el evento
        // $this->eventDispatcher->notify(new PostWasPublished($post->id(), $user->id()));
        //si notificamos aqui puede ser que alguien publique y no se notifique


        return $post;
    }
}

class PostWasPublished
{
    private $userId;
    private $postId;
    private $occurredOn;

    public function __construct($userId, $postId)
    {
        $this->userId = $userId;
        $this->postId = $postId;
        $this->occcurredOn = (new \DateTimeImmutable())->getTimestamp();
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
