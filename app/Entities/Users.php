<?php

namespace Larahack\Entities;

use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\Mail\Mailer;
use Larahack\Entities\Users\User;
use Larahack\Entities\Users\UserRepository;
use Larahack\Mail\Users\VerifyEmail;
use Larahack\Validators\Users as Validators;

class Users
{
    /**
     * @var \Illuminate\Auth\SessionGuard
     */
    private $auth;

    /**
     * @var \Illuminate\Contracts\Hashing\Hasher
     */
    private $hasher;

    /**
     * @var \Illuminate\Contracts\Auth\PasswordBroker
     */
    private $broker;

    /**
     * @var \Illuminate\Contracts\Mail\Mailer
     */
    private $mailer;

    /**
     * @var null|\Larahack\Entities\Users\User
     */
    private $user;

    /**
     * @var \Larahack\Entities\Users\UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository, SessionGuard $auth, Hasher $hasher, PasswordBroker $broker, Mailer $mailer)
    {
        $this->userRepository = $userRepository;
        $this->auth           = $auth;
        $this->hasher         = $hasher;
        $this->broker         = $broker;
        $this->mailer         = $mailer;
    }

    public function user(): ?User
    {
        if (!$this->user) {
            $this->user = $this->auth->user();
        }

        return $this->user;
    }

    public function auth(array $credentials, bool $rememberMe): bool
    {
        Validators\LoginValidator::validate($credentials);

        $user = $this->userRepository->retrieveByCredentials($credentials);

        // Check that a user was found and that the passwords match
        if ($user && $this->hasher->check($credentials['password'], $user->getAuthPassword())) {
            if (!$user->active) {
                // If the user is inactive, no!
                return false;
            }
            // Login using the dirty auth functionality
            $this->auth->login($user, $rememberMe);
            // Return whether or not the user was successfully logged in
            return $this->auth->check();
        }

        return false;
    }

    public function register(array $data): bool
    {
        Validators\RegistrationValidator::validate($data);

        $data['active'] = true;
        $user           = (new User)->create($data);

        if ($this->userRepository->persist($user)) {
            $this->sendVerificationEmail($user);

            return true;
        }

        return false;
    }

    private function sendVerificationEmail(User $user): void
    {
        $this->mailer->send(new VerifyEmail($user));
    }
}