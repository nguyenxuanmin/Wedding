$(document).ready(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    window.onscroll = function () {
        if (window.pageYOffset > 130) {
            $('#scrollToTop').fadeIn();
        } else {
            $('#scrollToTop').fadeOut();
        }
    };

    $('#scrollToTop').click(function() {
        $('html, body').animate({ scrollTop: 0 }, 'smooth');
        return false;
    });

    $('.item-show-search').click(function() {
        $("#header").addClass("show-search");
    });
    $('.btn-close-search').click(function() {
        $("#header").removeClass("show-search");
    });

    $('.item-show-menu').click(function() {
        $("#header").addClass("show-menu");
    });
    $('.item-hide-menu').click(function() {
        $("#header").removeClass("show-menu");
    });
    $('.menu-mobile ul li a').click(function() {
        $("#header").removeClass("show-menu");
    });

    if ($('#uniteGallery').length) {
        $("#uniteGallery").unitegallery({
            tiles_max_columns: 5,
            tiles_col_width: 300,
        });
    }

    flatpickr("#event_date", {
        altInput: true,
        altFormat: "d/m/Y",
        dateFormat: "Y-m-d",
        minDate: "today"
    });

    $('#event_cost_display').on('input', function () {
        let value = $(this).val().replace(/[^0-9]/g, '');

        if (value !== '') {
            $(this).val(Number(value).toLocaleString('en-US'));
            $('#event_cost').val(value);
        } else {
            $(this).val('');
            $('#event_cost').val('');
        }
    });

    if ($('#imageFeedbacks').length) {
        $('#imageFeedbacks').on('change', function (event) {
            const preview = $('#previewImageFeedbacks');
            preview.empty();
            const files = event.target.files;
            const maxSize = 2 * 1024 * 1024 * 1024;
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            let hasError = false;
            let errorMessage = '';

            if(files.length > 3){
                errorMessage = window.lang.alert_image_feedback;
                hasError = true;
            } else {
                $.each(files, function (i, file) {
                    if (file.size > maxSize) {
                        errorMessage = window.lang.max_size;
                        hasError = true;
                        return false; // break loop
                    }
                    if (!allowedTypes.includes(file.type)) {
                        errorMessage = window.lang.allowed_type;
                        hasError = true;
                        return false; // break loop
                    }
                });
            }

            if (hasError) {
                alert(errorMessage);
                $('#imageFeedbacks').val('');
                preview.empty();
            } else {
                $.each(files, function (i, file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = $('<img>')
                        .attr('src', e.target.result)
                        .css({
                            width: '100px',
                            height: 'auto',
                            margin: '3px',
                            border: '1px solid #ccc',
                            'object-fit': 'cover',
                            'border-radius': '5px'
                        });
                        preview.append(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    }

    if ($('.rating').length) {
        const stars = $('.rating label');
        const inputs = $('.rating input');
        let selectedIndex = inputs.index(inputs.filter(':checked'));

        function render(index) {
            stars.each(function (i) {
                const icon = $(this).find('i');
                if (i <= index) {
                    icon.removeClass('fa-regular').addClass('fa-solid').css('color', '#f5b301');
                } else {
                    icon.removeClass('fa-solid').addClass('fa-regular').css('color', '#ccc');
                }
            });
        }

        stars.on('mouseenter', function () {
            const index = stars.index(this);
            render(index);
        });

        stars.on('mouseleave', function () {
            render(selectedIndex);
        });

        stars.on('click', function () {
            const index = stars.index(this);
            selectedIndex = index;
            inputs.eq(index).prop('checked', true);
        });

        render(selectedIndex);
    }

    if ($('.my-slider').length) {
        $('.my-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            nextArrow:
                '<div class="slick-arrow slick-next"><i class="fa-solid fa-right-long"></i></div>',
            prevArrow:
                '<div class="slick-arrow slick-prev"><i class="fa-solid fa-left-long"></i></div>',
            autoplay: true,
            arrows: true,
            fade: true,
            autoplaySpeed: 5000
        });
    }

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

    if ($('#submitFormFeedback').length) {
        let urlSubmit = $('#submitFormFeedback').data('url-submit');
        let urlComplete = $('#submitFormFeedback').data('url-complete');
        $('#submitFormFeedback').on('submit', function(e){
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