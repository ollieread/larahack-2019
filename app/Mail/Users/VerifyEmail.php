<?php

namespace Larahack\Mail\Users;

use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Routing\UrlGenerator;
use Larahack\Entities\Users\User;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \Larahack\Entities\Users\User
     */
    private $user;

    /**
     * Create a new message instance.
     *
     * @param \Larahack\Entities\Users\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->user->email, $this->user->name)
            ->subject(trans('users.mail.verify.subject'))
            ->markdown('mail.users.verify', [
                'user' => $this->user,
                'url'  => Container::getInstance()->make(UrlGenerator::class)->signedRoute('user:verify', $this->user->id),
            ]);
    }
}
