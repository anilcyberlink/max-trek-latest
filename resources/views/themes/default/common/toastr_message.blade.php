<script>
  $(document).ready(function() {
    toastr.options = {
				'closeButton': true,
				'debug': false,
				'newestOnTop': false,
				'progressBar': false,
				'positionClass': 'toast-top-right',
				'preventDuplicates': false,
				'showDuration': '1000',
				'hideDuration': '1000',
				'timeOut': '5000',
				'extendedTimeOut': '1000',
				'showEasing': 'swing',
				'hideEasing': 'linear',
				'showMethod': 'fadeIn',
				'hideMethod': 'fadeOut',
			}
  });
</script>
<script>
  function ajax_response(response){
    if(response.success == true){
      toastr.success(response.message);
    }
    if(response.error == true){
      toastr.error(response.message);
    }
    if(response.warning == true){
      toastr.warning(response.message);
    }
    if(response.info == true){
      toastr.info(response.message);
    }
  }
</script>
@if (Session::has('response'))
    @php
        $response = Session::get('response');
    @endphp
    <script>
        // console.log(response)
        ajax_response(@json($response));
    </script>
@endif