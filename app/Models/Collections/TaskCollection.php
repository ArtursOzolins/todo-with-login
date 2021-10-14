<?php

namespace App\Models\Collections;


use App\Models\Assignment;

class TaskCollection
{
    private array $tasks;

    public function __construct(array $tasks = [])
    {
        $this->tasks = $tasks;
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }
}
