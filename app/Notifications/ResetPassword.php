<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordBase;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ResetPassword extends ResetPasswordBase
{
	public $token;

	public function __construct($token)
	{
	    $this->token = $token;
	}

	public function via($notifiable)
	{
	    return ['mail'];
	}

	public function toMail($notifiable)
	{
		// url('password/reset', $this->token)
		$url = url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()]));
	    return (new MailMessage)
            ->subject(Lang::getFromJson('Reset Password Notification'))
        	->greeting('Reset Password')
            ->line(Lang::getFromJson('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.'))
            ->line(Lang::getFromJson('Klik tautan berikut untuk mereset password Anda: '.$url));
	}
}