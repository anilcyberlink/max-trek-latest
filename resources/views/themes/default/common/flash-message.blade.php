@if(Illuminate\Support\Facades\Session::has('message'))
    <div class="alert alert-block alert-success alert-dismissible" style="color:green">
        <p class="alert alert-success">{{ Session::get('message') }}</p>
    </div>
@endif
@if(Illuminate\Support\Facades\Session::has('error'))
    <div class="alert alert-block alert-danger alert-dismissible" style="color:red">
        <p class="alert alert-danger">{{ Session::get('error') }}</p>
    </div>
@endif

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>

@endif

@if ($errors->any())
    <div class="alert alert-danger" style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.alert').hide(8000);
        });
    </script>
@stop
