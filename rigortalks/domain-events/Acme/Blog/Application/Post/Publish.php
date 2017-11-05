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

        //notificar eventos
        $events = $post->getEvents();
        $this->eventDispatcher->notify($events);

        return $post;
    }
}
