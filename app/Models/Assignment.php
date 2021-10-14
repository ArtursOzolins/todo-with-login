<?php

namespace App\Models;


class Assignment
{
    private string $user;
    private string $task;

    public function __construct(string $user, string $task)
    {
        $this->user = $user;
        $this->task = $task;
    }

    public function getTask(): string
    {
        return $this->task;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function setTask(string $task): void
    {
        $this->task = $task;
    }
}