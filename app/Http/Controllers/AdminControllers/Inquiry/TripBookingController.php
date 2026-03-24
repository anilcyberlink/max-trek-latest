<?php

namespace App\Http\Controllers\AdminControllers\Inquiry;

use App\Model\Contact;
use App\Model\VerifyContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inquiry\BookingModel;

class TripBookingController extends Controller
{

    public function index()
    {
        $data = Contact::orderBy('id','desc')->get();
        return view('admin.contact.index',compact('data'));    
    }

   
    public function destroy($id)
    {
        $del = Contact::findorfail($id);
       
           $del->delete();
             return redirect()->back()->with('success','Contact deleted  successfully');     
        
    }

    public function trip_booking(Request $request)
     {
     if ($request->isMethod('get'))
     {
         $book=BookingModel::orderby('id','desc')->get();
         return view('admin.trip-booking.index',compact('book'));

     }
     }
    public function trip_booking_delete(Request $request)
    {
        $del = BookingModel::findorfail($request->id);
        if($del->delete())
        {
            return redirect()->back()->with('success','Booking deleted  successfully');
        }
    }

    
}
