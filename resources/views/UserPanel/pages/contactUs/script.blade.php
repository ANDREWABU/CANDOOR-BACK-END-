
<script >
    $(document).ready(function() {
        $("#contact-form").validate();
        $('#select-subject').select2(
            {
                minimumResultsForSearch: -1
            }
        );
        $("#select-subject").on('change', function(e) {
           $('#subject').val($(this).val());
            $('#subject').focus();
        });
    });
    //
    // $(".selectBox").on("click", function(e) {
    //     $(this).toggleClass("show");
    //     var dropdownItem = e.target;
    //     var container = $(this).find(".selectBox__value"); 
    //     container.text(dropdownItem.text);
    //     $(dropdownItem)
    //         .addClass("active")
    //         .siblings()
    //         .removeClass("active");
    // });
    $("#contact-form" ).submit(function( event ) {
        event.preventDefault();
        if ($("#contact-form").valid())
        {
            $.ajax({
                url: $("#contact-form").attr('action'),
                type : 'POST',
                data:      $( "#contact-form" ).serialize(),
                beforeSend:function(){
                    $('#contact-form-submit-btn').text('Processing...');
                    $('#contact-form-submit-btn').addClass('disabled');
               },
                success:function(response){

                    if (response.status==200){
                        $('#contact-form').trigger("reset");
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
                    $('#contact-form-submit-btn').text('submit');
                    $('#contact-form-submit-btn').removeClass('disabled');
                }

            });
        }

    });
</script>
