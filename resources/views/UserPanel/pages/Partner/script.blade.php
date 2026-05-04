<script >
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:25,
        center:true,
        items:2,
        autoplay:true,
        nav:true,
        navText: ["<div class='left--'></div>", "<div class='right--'></div>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:2
            }
        }
    })

    $("#partner-with-us-form" ).submit(function( event ) {
        event.preventDefault();
        if ($("#partner-with-us-form").valid()) {
            $.ajax({
                url: $("#partner-with-us-form").attr('action'),
                type : 'POST',
                data:      $( "#partner-with-us-form" ).serialize(),
                beforeSend:function(){
                    $('#partner-with-us-form-submit-btn').text('Processing...');
                    $('#partner-with-us-form-submit-btn').addClass('disabled');
               },
                success:function(response){

                    if (response.status==200){
                        $('#partner-with-us-form').trigger("reset");
                        Swal.fire(
                            'Thanks!',
                            'Thanks for contacting us! A member of the candoor team will be in touch.',
                            'success'
                        );
                    }else {
                        Swal.fire(
                            'Failed!',
                            response.message,
                            'error'
                        );
                    }

                },
                error: function(data) {
                    Swal.fire(
                        'Failed!',
                        data.responseJSON.message,
                        'error'
                    );
                },
                complete:function (){
                    $('#partner-with-us-form-submit-btn').text('submit');
                    $('#partner-with-us-form-submit-btn').removeClass('disabled');
                }

            });
        }

    });

</script>
