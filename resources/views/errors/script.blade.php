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

</script>
