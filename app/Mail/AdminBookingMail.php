<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Settings\SettingModel;

class AdminBookingMail extends Mailable
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

        return $this->view('emails.admin-bookingmail')
            ->with([
                'start_date' => $this->data['departure_date'],
                'num_ppl'    => $this->data['num_people'],
                'email'      => $this->data['email'],
                'name'       => $this->data['full_name'],
                'trip'       => $this->data['title'],
                'country'    => $this->data['country'],
                'contact'    => $this->data['phone'],
                'message_text' => $this->data['comments'], // renamed
                'logo'       => $setting->logo,
                'site_name'  => $setting->site_name,
            ])
            ->subject('New Booking Inquiry');
    }
}
