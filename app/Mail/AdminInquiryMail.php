<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Settings\SettingModel;

class AdminInquiryMail extends Mailable
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
        $logo = $data->logo;
        $site_name = $data->site_name;
        $mail=$request->email;
        $name=$request->name;
        $guest=$request->guest;
        $contact=$request->number;
        $message=$request->review;
        $trip_id=$request->trip_id;
        $num_ppl=$request->group_size;
        $email = $data->email_secondary;
        return $this->view('emails.admin-inquiry', ['mail' => $mail,'name'=>$name,'guest'=>$guest,'contact'=>$contact,'messages'=>$message,'trip_id'=>$trip_id,'num_ppl'=>$num_ppl,'logo'=>$logo, 'site_name' => $site_name])->subject('Trip Inquiry')->to($email);
    }
}
