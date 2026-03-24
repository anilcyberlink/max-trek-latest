<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Settings\SettingModel;

class AdminBookingMail extends Mailable
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
        $data = SettingModel::where('id',1)->first();
        $logo = $data->logo;
        $site_name = $data->site_name;
        $num_ppl = $request->num_people;
        $start_date = $request->departure_date;
        $mail = $request->email;
        $name = $request->first_name.' '.$request->last_name;
        $country = $request->country;
        $contact = $request->phone;
        $message = $request->comments;
        $email = $data->email_secondary;
        return $this->view('emails.admin-bookingmail', ['start_date' => $start_date,'num_ppl'=> $num_ppl,'email' => $mail,'name'=>$name,'country'=>$country,'contact'=>$contact,'messages'=>$message,'logo'=>$logo, 'site_name' => $site_name])->to($email);
    }
}
