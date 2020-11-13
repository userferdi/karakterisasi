<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class VerifyEmail extends VerifyEmailBase
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);
        if (static::$toMailCallback){
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }
        return (new MailMessage)
        	->greeting('E-mail Verification')
            ->subject(Lang::getFromJson('Verify Email Address'))
            ->line(Lang::getFromJson('Berikut link untuk verifikasi e-mail yang terdaftar pada Website FiNder (Functional Nano Powder) Universitas Padjadjaran'))
            ->line(Lang::getFromJson('Klik tautan berikut untuk memverifikasi email Anda: '))
            ->action(Lang::getFromJson($verificationUrl), $verificationUrl);
    }
}