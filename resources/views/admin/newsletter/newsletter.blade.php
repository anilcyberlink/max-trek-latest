@extends('admin.master')
@section('title','Add Newsletter')
@section('breadcrumb')
<a href="{{ route('newsletter.index') }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')

<div class="container">
    <h1>Add Newsletter </h1>

 <form action="{{ route('newsletter.submit') }}" method="POST">
     @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Content</label>
    <!--<textarea  class="form-control" name="content" id="exampleInputPassword1" placeholder="Your Content here"></textarea>-->
    <textarea class="form-control my-editor" id="editor2" name="content" rows="50"> <p>&nbsp;</p>
<p>&nbsp;</p>
<table class="wrapper" style="padding: 0px; width: 100%;" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#414042">
<tbody>
<tr>
<td align="center" valign="top">
<table class="wrapper" style="width: 600px;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 10px 0px; color: #ffffff; line-height: 18px; font-family: Tahoma, Helvetica, sans-serif; font-size: 11px; text-decoration: none;" align="center" valign="top">
<p>Indulge in more.&nbsp;<span class="gold" style="color: #b3a258; text-decoration: none;"><a style="color: #b3a258; text-decoration: none;" href="https://www.annapurnaview.com/" target="_blank" rel="noopener">View online</a>.</span></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding-top: 0px;" align="center" valign="top">
<table class="wrapper" style="width: 600px;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td valign="top">
<table class="wrapper" style="width: 600px;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td align="center" valign="top"><a style="text-decoration: none;" href="https://www.annapurnaview.com/" target="_blank" rel="noopener"><img style="display: block;" src="https://cyberlinknepal.com/design/hav-christmas-offer/images/logo.png" alt="" border="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td align="center" valign="top">&nbsp;</td>
</tr>
<tr>
<td align="center"><!-- Monthly offer Begin--> &nbsp;
<table class="wrapper" style="width: 860px; height: 1051px;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="width: 856px;" align="center" valign="top">
<table class="wrapper" style="width: 814.5px; height: 833px;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 141px;">
<td style="width: 810.5px; height: 141px;" align="center" valign="top">&nbsp;</td>
</tr>
<tr style="height: 333px;">
<td style="width: 810.5px; height: 333px;" align="center" valign="top"><a href="https://www.annapurnaview.com/" target="_blank" rel="noopener"><img class="headerimg" src="https://www.annapurnaview.com/assets/site/model.png" width="250" height="250" /></a>&nbsp; &nbsp;<a href="https://www.annapurnaview.com/" target="_blank" rel="noopener"><img class="headerimg" src="https://www.annapurnaview.com/assets/site/Book-direct.png" width="250" height="250" /></a>&nbsp;&nbsp;&nbsp;<a href="https://www.annapurnaview.com/" target="_blank" rel="noopener"><img class="headerimg" src="https://www.annapurnaview.com/assets/site/Hotel.png" width="250" height="250" /></a></td>
</tr>
<tr style="height: 88px;">
<td style="width: 810.5px; height: 88px;" align="center" valign="top">&nbsp;</td>
</tr>
<tr style="height: 320.75px;">
<td class="" style="width: 810.5px; height: 320.75px;" align="center" valign="top">
<table class="wrapper" style="width: 570px;" border="0" width="570" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="color: #ffffff; font-size: 25px; line-height: 23px; padding-top: 10px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; text-transform: uppercase;" align="center">
<p style="padding: 0; margin: 15px 0;">Best Possible Rates Guaranteed</p>
</td>
</tr>
<tr>
<td class="pad20" style="line-height: 22px; padding-top: 20px; padding-bottom: 10px; font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #ffffff;" align="center">
<div id="pastingspan1">
<div class="kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q">
<div dir="auto">
<div dir="auto">Book your stay at our hotel directly in order to get huge discounts on food and beverages, room rates and many more. Use direct booking to your advantage.</div>
<br /><br /></div>
</div>
<div class="cxmmr5t8 oygrvhab hcukyx3x c1et5uql o9v6fnle ii04i59q">
<div dir="auto">For details please feel free to click on the&nbsp;link:</div>
<div dir="auto"><a class="oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl gpro0wi8 py34i1dx" tabindex="0" role="link" href="https://www.annapurnaview.com" target="_blank" rel="nofollow noopener">www.annapurnaview.com</a><br /><br /></div>
</div>
<div class="cxmmr5t8 oygrvhab hcukyx3x c1et5uql o9v6fnle ii04i59q">
<div dir="auto">For reservations and inquiries <br />Call us at Tel +977-061-506000 , Mobile 9860506786, 9856088851 <br />&nbsp;Email: info@annapurnaview.com, sales@annapurnaview.com</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 36px;">
<td style="padding-top: 10px; padding-bottom: 10px; width: 810.5px; height: 36px;" align="center">
<table style="height: 53px;" border="0" width="157" cellspacing="0" cellpadding="0" align="center" bgcolor="#b3a258">
<tbody>
<tr>
<td style="height: 40px; color: #ffffff; text-transform: uppercase; font-family: Arial, Helvetica, sans-serif; font-size: 14px; padding: 0px 30px; width: 99px;" align="center" valign="middle" height="26"><a style="color: #ffffff; text-decoration: none;" href="https://www.annapurnaview.com/contact-details" target="_blank" rel="noopener"><span class="white">VISIT US</span></a></td>
</tr>
</tbody>
</table>
&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding-top: 20px; width: 856px;" align="center"><!-- Monthly offer Begin-->
<table class="wrapper" style="width: 600px;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td align="center" valign="top"><hr style="width: 400px; max-width: 40%; color: #ffffff;" size="1" /></td>
</tr>
</tbody>
</table>
<!-- Monthly offer End--> <!-- Footer Begin -->
<table class="wrapper" style="width: 600px;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding-top: 20px; padding-bottom: 20px;">
<table class="wrapper" style="width: 600px;" border="0" width="600" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="center" valign="top">
<table style="width: 150px;" border="0" width="150" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td align="center" valign="top"><a href="https://www.facebook.com/HAVSarangkot" target="_blank" rel="noopener"><img style="display: block;" src="https://www.annapurnaview.com/assets/site/logo_f.png" alt="Facebook" width="16" border="0" /></a></td>
<td align="center" valign="top"><a href="https://www.instagram.com/annapurnaview/" target="_blank" rel="noopener"><img style="display: block;" src="https://www.annapurnaview.com/assets/site/logo_inst.png" alt="Instagram" width="16" border="0" /></a></td>
<td align="center" valign="top"><a href="https://www.tiktok.com/@havsarangkot" target="_blank" rel="noopener"><img style="display: block;" src="https://www.annapurnaview.com/assets/site/icon_tiktok.png" alt="Tiktok" width="16" border="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="height: 20px;" height="20">&nbsp;</td>
</tr>
<tr>
<td style="color: #ffffff; line-height: 40px; font-family: Arial, sans-serif; font-size: 15px; font-weight: 500;" align="center" valign="top">&copy; 2022 Hotel Annapurna View</td>
</tr>
<tr>
<td style="color: #b3a258; line-height: 18px; font-family: Arial, sans-serif; font-size: 12px;" align="center" valign="top">&nbsp;<a style="color: #b3a258; text-decoration: none;" href="https://www.annapurnaview.com/terms-and-condition" target="_blank" rel="noopener"><span class="gold" style="color: #b3a258 !important; text-decoration: none;"><strong>Terms &amp; Conditions</strong></span></a>&nbsp;</td>
</tr>
<tr>
<td style="height: 10px;" height="10">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!-- Footer End --></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
 </textarea>
  </div>
  <div class="form-group">
      <label  for="exampleCheck1">Publish Date</label>
    <input type="date" name="publish_date" class="form-control" id="exampleCheck1">
  </div>
  <hr/>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@stop
