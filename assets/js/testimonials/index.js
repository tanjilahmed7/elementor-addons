var testimonials = function($scope, $) {
    var layout = $('.ht-testimonials').data('style');
    console.log(layout);
    if (layout == 'style-1'){
        $('.tm-layout-style-1').not('.slick-initialized').slick({
            arrows : true,
            autoplay: true,
            nextArrow : '<button type="button" class="testimonials slick-next"><i class="fa fa-angle-right"></i></button>',
            prevArrow : '<button type="button" class="testimonials slick-prev"><i class="fa fa-angle-left"></i></button>',
        });
    } 

    else if (layout == 'style-3'){
        $('.tm-layout-style-3').not('.slick-initialized').slick({
            arrows : false,
            infinite: true,
            slidesToShow: 2,
            dots: true,


        });
    } 
    else if (layout == 'style-4'){
        $('.tm-layout-style-4').not('.slick-initialized').slick({
            arrows : true,
            autoplay: true,
            nextArrow : '<button type="button" class="testimonials slick-next"><i class="fa fa-angle-right"></i></button>',
            prevArrow : '<button type="button" class="testimonials slick-prev"><i class="fa fa-angle-left"></i></button>',
            slidesToShow: 2,

        });
    } 
    else if (layout == 'style-5'){
        $('.pp-quote').click(function(){
            $('.pp-quote').removeClass("active");
            $(this).addClass("active");
        });
        $('.pp-quote').click(function(e){ 
            var id = $(this).attr('data-id'); // Get data id
            e.stopPropagation();
            $(".look").addClass('hide-dp-top');
            $(".hide-dp-top").removeClass('look');
            $('.dp-name-'+id).addClass('look');
            $('.dp-name-1'+id).removeClass('hide-dp-bottom');             
        });
          
    } 
    else if (layout == 'style-6'){
        $('.tm-layout-style-6').not('.slick-initialized').slick({
            arrows : false,
            autoplay: true,
            nextArrow : '<button type="button" class="testimonials slick-next"><i class="fa fa-angle-right"></i></button>',
            prevArrow : '<button type="button" class="testimonials slick-prev"><i class="fa fa-angle-left"></i></button>',
            dots: true,
            infinite: true,

        });
    }     

};
jQuery(window).on("elementor/frontend/init", function() {
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/ht-testimonials.default",
        testimonials
    );
});
