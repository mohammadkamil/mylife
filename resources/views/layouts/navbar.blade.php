<nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar gradient">
    <div class="container"><a class="navbar-brand logo" href="#">myLife</a><button data-bs-toggle="collapse"
            class="navbar-toggler" data-bs-target="#navbarNav"><span class="visually-hidden">Toggle
                navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                {{-- {{ $value =$_COOKIE['jwt']}} --}}
                {{-- {{  $value."ssd"; }} --}}
                @if (!isset($_COOKIE['jwt']))
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('login') }}">Login</a></li>
                @else
                    <li class="nav-item"><a class="nav-link active" href="{{ route('index') }}">Home</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Profile</a></li> --}}
                    {{-- <li class="nav-item"><a class="nav-link" href="hire-me.html">Logout</a></li> --}}
                    <li class="nav-item "><a class="nav-link " href="" onclick="logout()
                                  "><i
                                class="fas fa-sign-out-alt"></i><span>{{ __('Logout') }}</span></a>
                        <form id="logout-form"
                            style="display: none;">
                            @csrf
                        </form>
                    </li>
                    <script>
                        function logout(){

                            event.preventDefault();

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            var formData = {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                token:'{{ $_COOKIE['jwt'] }}'


                            };
                            $.ajax({

                                type: "post",
                                url: "http://127.0.0.1:8000/api/auth/logout",
                                data: formData,
                                dataType: "json",
                                encode: true,
                            }).done(function(data) {
                                alert(data['message']);
                                location.href = '{{ route('login') }}';
                                // console.log(data);
                            }).fail(function(jqXHR, textStatus, errorThrown) {
                                prompt(1,JSON.stringify(jqXHR));
                                // if (jqXHR['statusText'] == "Unauthorized") {
                                //     alert(jqXHR['statusText']);

                                // }

                                //handle error here
                            });

                        // });
                        }

                    </script>

                @endif

            </ul>
        </div>
    </div>
</nav>
