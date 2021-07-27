@extends('layouts.app')
@section('content')
<section class="register-photo" style="background-color: transparent;">

    <div class="form-container" style="margin-top: 40px;">
        <div class="image-holder"
            style="background: url(&quot;assets/img/IINET-DOSAGE-1.jpg&quot;) left / cover no-repeat;"></div>
        <form id="form">
            <h2 class="text-center"><strong>Login</strong></h2>
            <div class="form-group mb-3"><input class="form-control" type="email" name="email" placeholder="Email" id="email"></div>
            <div class="form-group mb-3"><input class="form-control" type="password" name="password" placeholder="Password" id="password">
            </div>
            <div class="form-group mb-3"><button class="btn btn-primary d-block w-100" type="submit"
                    style="color: rgb(255,255,255);background-color: #00b5a8;">Login</button></div><a class="already"
                href="{{ route('register') }}">Do not have account, Click here!</a>
        </form>
        <script>
            $("form").submit(function(event) {
                event.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    email: $("#email").val(),
                    password: $("#password").val(),

                };
                $.ajax({

                    type: "POST",
                    url: "http://127.0.0.1:8000/api/auth/login",
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function(data) {
                    alert("Successfully login");
                    location.href='{{ route('index') }}';
                    // console.log(data);
                }) .fail(function(jqXHR, textStatus, errorThrown) {
                    // prompt(1,JSON.stringify(jqXHR));
                    if(jqXHR['statusText']=="Unauthorized"){
                        alert(jqXHR['statusText']);

                    }

//handle error here
});

            });
        </script>
    </div>
</section>
@endsection
