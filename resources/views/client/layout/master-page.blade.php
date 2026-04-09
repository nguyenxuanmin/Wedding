<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @if (!empty($company->favicon))
            <link rel="icon" href="{{asset('storage/company/favicon/'.$company->favicon)}}" type="favicon">
        @endif
        <title>@yield('title')</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="{{asset('css/index.css')}}"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script type='text/javascript' src='{{asset('unitegallery/js/unitegallery.min.js')}}'></script>	
        <link rel='stylesheet' href='{{asset('unitegallery/css/unite-gallery.css')}}' type='text/css' />
        <script type='text/javascript' src='{{asset('unitegallery/themes/tiles/ug-theme-tiles.js')}}'></script>
    </head>
    <body>
        <div class="wrapper">
            @include('client.layout.header')
            <main>
                @yield('content')
            </main>
            @include('client.layout.footer')
        </div>
        <div id="scrollToTop"><i class="fa-solid fa-arrow-up"></i></div>
        <div id="fb-root"></div>
        <div id="fb-customer-chat" class="fb-customerchat"></div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('js/index.js')}}"></script>
        
        <script>
            window.fbAsyncInit = function () {
                FB.init({
                    xfbml: true,
                    version: 'v18.0'
                });

                var chatbox = document.getElementById('fb-customer-chat');
                if (chatbox) {
                    chatbox.setAttribute("page_id", "{{ $company->fanpage_id }}");
                    chatbox.setAttribute("attribution", "biz_inbox");
                }
            };

            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $(document).ready(function() {
                if ($('#submitFormContact').length) {
                    let urlSubmit = $('#submitFormContact').data('url-submit');
                    let urlComplete = $('#submitFormContact').data('url-complete');
                    $('#submitFormContact').on('submit', function(e){
                        e.preventDefault();
                        var formData = new FormData(this);
                        $.ajax({
                            url: urlSubmit,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false, 
                            success: function(response) {
                                if (response.success == true) {
                                    Swal.fire({
                                        text: response.message,
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        if(urlComplete != ""){
                                            location.href = urlComplete;
                                        }else{
                                            location.reload();
                                        }
                                    });
                                }else{
                                    Swal.fire({
                                        text: response.message,
                                        icon: "error",
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr);
                            }
                        });
                    });
                }
            });
        </script>
    </body>
</html>