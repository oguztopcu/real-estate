<?php

namespace App\Repositories\Users;

use App\Models\User;

class UserRepository
{
    /**
     * @var User $model
     */
    private $model;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param array $request
     * @return mixed
     */
    public function create(array $request): User
    {
        return $this->model->query()->create([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);
    }
}
