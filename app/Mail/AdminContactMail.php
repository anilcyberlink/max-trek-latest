<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Settings\SettingModel;


class AdminContactMail extends Mailable
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
        // dd($request->all());
        $data = SettingModel::where('id',1)->first();
        $mail=$request->email;
        $country=$request->country;
        $name=$request->first_name;
        $contact=$request->number;
        $messages =$request->message;
        $email = $data->email_secondary;
        return $this->view('emails.admin-contactmail', ['country'=>$country,'mail' => $mail,'name'=>$name,'contact'=>$contact,'messages'=>$messages ])->subject('Contact Inquiry')
        ->to($email);
    }
}
