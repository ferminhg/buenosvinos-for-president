<?php

namespace Acme\Blog\Domain\Model\User;

/**
 * Class User
 *
 * @package Acme\Blog\Domain\Model\User
 */
class User
{
    private $id;

    /**
     * @return integer
     */
    public function id()
    {
        return $this->id;
    }
}