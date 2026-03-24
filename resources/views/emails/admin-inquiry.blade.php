<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Gurkha Encounters</title>
    <style>
        table {
            border-collapse: collapse;
            width:100%;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding:8px;
        }
    </style>
</head>
<body style="font-family: sans-serif">
<div style="margin:0 auto; max-width:700px; width:100%;">
    <blockquote>
        <div style="background:#FFF; padding:8px 0px; margin-bottom:5px;">
            <!-- <img src="{{ asset('themes-assets/images/logo-gurkha.png') }}" style="width: 25%"/> -->
            @if($logo)
                <img src="{{ asset('uploads/medium/'.$logo) }}" style="width: 30%"/>
            @else
                <h1>{{$site_name}}</h1>
            @endif
        </div>
    </blockquote>
    <h3>Inquiry Details:</h3>
    <table>

        <tr>
            <td bgcolor="#ddd"  ><strong>Full Name</strong></td>
            <td bgcolor="#ddd" >{{ $name }}</td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td>{{ $mail }}</td>
        </tr>
        <tr>
            <td><strong>Phone </strong></td>
            <td>{{ $contact }}</td>
        </tr>
             {{-- <tr>
            <td><strong>Hotel</strong></td>
            <td>{{ post_parent_byId($hotel)->post_title }}</td>
        </tr> --}}
        <tr> 
            <td><strong>Number of People</strong></td>
            <td>{{ $num_ppl }}</td>
        </tr>
             <tr>
            <td><strong>Trip Name</strong></td>
            <td>{{tripdetail($trip_id)->trip_title}}</td>
        </tr>
        
        <tr>
            <td><strong>Message</strong></td>
            <td>{!! $messages  !!}</td>
        </tr>
    </table>


</div>
</body>
</html>
