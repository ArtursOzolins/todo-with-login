<?php


namespace App\Repositories;

use App\Models\Collections\UsersCollection;
use App\Models\User;

interface UserRepository
{
    public function readFromFile(): UsersCollection;
    public function registrate(User $user): void;
    public function delete(User $user): void;
}