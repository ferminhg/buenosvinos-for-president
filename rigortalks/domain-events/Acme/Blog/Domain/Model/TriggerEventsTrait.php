<?php

namespace Acme\Blog\Domain\Model;

trait TriggerEventsTrait
{
    private $events = [];

    protected function trigger($event)
    {
        $this->events[] = $event;
    }

    public function getEvents()
    {
        return $this->events;
    }

}