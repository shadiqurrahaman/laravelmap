<?php
namespace App\Repository;
use App\Models\User;

class UserRepository extends Repository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}