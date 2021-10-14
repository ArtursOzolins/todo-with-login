<?php

namespace App\Repositories;

use App\Models\Assignment;
use App\Models\Collections\TaskCollection;

interface TaskRepository
{
    public function readFromFile(): TaskCollection;
    public function addToFile(Assignment $task): void;
    public function delete(Assignment $task): void;
}
