<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Settings\SettingModel;

class UserBookingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $setting = SettingModel::find(1);

        return $this->view('emails.user-bookingmail')
            ->with([
                'name'         => $this->data['full_name'],
                'email'        => $this->data['email'],
                'contact'      => $this->data['phone'],
                'country'      => $this->data['country'],
                'start_date'   => $this->data['start_date'],
                'end_date'     => $this->data['end_date'],
                'num_ppl'      => $this->data['num_people'],
                'message_text' => $this->data['comments'],
                'trip_title'   => $this->data['title'],
                'logo'         => $setting->logo ?? null,
                'site_name'    => $setting->site_name ?? 'Your Company',
            ])
            ->subject('Your Booking is Confirmed');
    }
}
