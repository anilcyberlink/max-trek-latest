<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsletterSignup extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
     public function build(Request $request)
    {
        $request->validate([
            'first_name'=> 'Required',
            'last_name'=>'Required',
            'email'=>'Required|email',
            'company'=>'Required'           
            ]);
        $emailfrom = env('MAIL_USERNAME');
        $subject = env('NEWSLETTER_SINGUP');
        return $this->from($emailfrom)
            ->view('themes.default.mail.newsletter-signup',['email'=>$request->email])
            ->subject($subject);
    }
}
