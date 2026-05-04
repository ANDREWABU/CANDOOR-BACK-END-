@php

@endphp
<script >
    $(document).ready(function() {
        $(".headerWrap").addClass('about-header');
        $('.testimonial').click(function () {
            const  dataId = $(this).attr('data-id');
            $('.testimonial').removeClass('active');
            $(this).addClass('active');

            $('.testimonial-text').removeClass('active');
            $('#testimonial-text-'+dataId).addClass('active');
        })
    });


</script>
