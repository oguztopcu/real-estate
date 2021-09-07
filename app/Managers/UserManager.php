<?php

namespace App\Managers;

use App\Repositories\Users\UserRepository;

class UserManager
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(array $request)
    {
        return $this->userRepository->create($request);
    }
}
