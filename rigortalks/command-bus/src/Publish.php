<?php

namespace RigorTalks;

/**
 * Class Publish
 *
 * @package RigorTalks
 */
class Publish
{
    private $userRepository;
    private $postRepository;

    /**
     * Publish constructor.
     *
     * @param $userRepository
     * @param $postRepository
     */
    public function __construct($userRepository, $postRepository)
    {
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
    }


    public function execute(PublishCommand $command)
    {
        $user = $this->userRepository->ofIdOrFail($command->userId());
        $post = $this->postRepository->ofIdOrFail($command->postId());
    }

}

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
     * @return mixed
     */
    public function userId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function postId()
    {
        return $this->postId;
    }


}

$as = new Publish(ur, pr);
$as->execute(new PublishCommand(1, 1));

/** Executa comandos y mas cosas */
class LoggerDecorator
{
    public function __construct($commandHandler, $monolog)
    {
        $this->commmandHandler = $commandHandler;
        $this->monolog = $monolog;
    }

    public function execute($command)
    {
        $this->monolog->log(serialize($command));

        return $this->commmandHandler->execute($command);
    }
}

$as = new LoggerDecorator(new Publish(ur, pr), new Monolog());
$as->execute(new PublishCommand(1, 2));