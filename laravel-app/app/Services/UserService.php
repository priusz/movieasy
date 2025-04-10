<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(object $request) : bool
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $success = $this->userRepository->create($data);

        return $success;
    }

    public function checkUserExists(string $email) : bool
    {
        $isExists = $this->userRepository->checkUserExists($email);

        return $isExists;
    }
}
