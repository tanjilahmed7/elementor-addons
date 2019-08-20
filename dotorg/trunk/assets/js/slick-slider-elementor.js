/*
==============================================
 Slick Slider Custom Elementor JS
==============================================
*/
jQuery( function( $ ) {
    var myPlayer;
    function slider(){
        if ( window.elementorFrontend ) {
                elementorFrontend.hooks.addAction( 'frontend/element_ready/hubtag-slick-slider.default', function( $scope, $ ) {

                    //Slick Slider Init
                    if($scope.find('.hubtag-slick-slider').length > 0){
                        var config          = $scope.find('.hubtag-slick-slider').data('config'), 
                            slickConfig     = {},  
                            slickTablatConfig  = {}, 
                            slickMobileConfig  = {};  

                            slickConfig.infinite        = config.infinite == 'yes' ? true : false;
                            slickConfig.autoplay        = config.autoplay == 'yes' ? true : false; 
                            slickConfig.autoplaySpeed   = config.autoplay_speed !== '' ? parseInt(config.autoplay_speed) : 5000;
                            slickConfig.pauseOnHover    = config.pause_on_hover == 'yes' ? true : false;
                            slickConfig.fade            = config.transition == 'fade' ? true : false;
                            slickConfig.centerMode      = config.centerMode == 'yes' ? true : false;

                            if (config.sliderType == 'multiple-item') {
                                slickConfig.slidesToShow    =  parseInt(config.slidesToShow);
                                slickConfig.slidesToScroll  = parseInt(config.slidesToScroll);
                            }else{
                                slickConfig.slidesToShow    = 1;
                                slickConfig.slidesToScroll  = 1;
                            }

                            if (config.navigation == "both") {
                                slickConfig.arrows  =  true; 
                                slickConfig.dots    =  true; 
                            }else if (config.navigation == 'arrows') {
                                slickConfig.arrows  =  true; 
                            }else if (config.navigation == 'dots') {
                                slickConfig.dots    =  true; 
                            }else if (config.navigation == 'none') {
                                slickConfig.arrows  =  false; 
                                slickConfig.dots    =  false; 
                            }else{
                                slickConfig.arrows  =  true; 
                                slickConfig.dots    =  true;
                            } 
                            
                            //config for responsive mobile
                            slickMobileConfig.breakpoint      = config.slides_breakpoint_mb !== '' ? config.slides_breakpoint_mb : 480; 
                            slickMobileConfig.infinite        = config.infinite_mb == 'yes' ? true : false; 
                            slickMobileConfig.autoplay        = config.autoplay_mb == 'yes' ? true : false; 
                            slickMobileConfig.autoplaySpeed   = config.autoplay_speed_mb !== '' ? parseInt(config.autoplay_speed_mb) : 5000;
                            slickMobileConfig.pauseOnHover    = config.pause_on_hover_mb == 'yes' ? true : false;
                            slickMobileConfig.centerMode      = config.center_mode_mb == 'yes' ? true : false;
                            slickMobileConfig.variableWidth   = true;
                            slickMobileConfig.slidesToShow    = 1;
                            slickMobileConfig.slidesToScroll  = 1;

                            if(config.sliderType == 'video'){

                            }

                            if (config.navigation_mb == "both") {
                                slickMobileConfig.arrows  =  true; 
                                slickMobileConfig.dots    =  true; 
                            }else if (config.navigation_mb == 'arrows') {
                                slickMobileConfig.arrows  =  true; 
                                slickMobileConfig.dots    =  false; 
                            }else if (config.navigation_mb == 'dots') {
                                slickConfig.dots            =  true; 
                                slickMobileConfig.arrows    =  false;
                            }else if (config.navigation_mb == 'none') {
                                slickMobileConfig.arrows  =  false; 
                                slickMobileConfig.dots    =  false; 
                            }else{
                                slickMobileConfig.arrows  =  true; 
                                slickMobileConfig.dots    =  true;
                            } 


                            //config for responsive tab
                            slickTablatConfig.breakpoint      = config.slides_breakpoint_tb !== '' ? config.slides_breakpoint_tb : 767; 
                            slickTablatConfig.infinite        = config.infinite_tb == 'yes' ? true : false; 
                            slickTablatConfig.autoplay        = config.autoplay_tb == 'yes' ? true : false; 
                            slickTablatConfig.autoplaySpeed   = config.autoplay_speed_tb !== '' ? parseInt(config.autoplay_speed_tb) : 5000;
                            slickTablatConfig.pauseOnHover    = config.pause_on_hover_tb == 'yes' ? true : false;
                            slickTablatConfig.centerMode      = config.center_mode_tb == 'yes' ? true : false;
                            
                            if (config.sliderType == 'multiple-item') {
                                slickTablatConfig.slidesToShow    =  parseInt(config.slides_to_show_tb);
                                slickTablatConfig.slidesToScroll  = parseInt(config.slides_to_scroll_tb);
                            } else if(config.sliderType == 'video'){

                            }

                            if (config.navigation_tb == "both") {
                                slickTablatConfig.arrows  =  true; 
                                slickTablatConfig.dots    =  true; 
                            }else if (config.navigation_tb == 'arrows') {
                                slickTablatConfig.arrows  =  true; 
                                slickTablatConfig.dots    =  false; 
                            }else if (config.navigation_tb == 'dots') {
                                slickTablatConfig.dots            =  true; 
                                slickTablatConfig.arrows    =  false;
                            }else if (config.navigation_tb == 'none') {
                                slickTablatConfig.arrows  =  false; 
                                slickTablatConfig.dots    =  false; 
                            }else{
                                slickTablatConfig.arrows  =  true; 
                                slickTablatConfig.dots    =  true;
                            }

                            slickConfig.responsive  = [{ 
                                    breakpoint: slickTablatConfig.breakpoint.size,
                                    settings: slickTablatConfig
                                },{ 
                                    breakpoint: slickMobileConfig.breakpoint.size,
                                    settings: slickMobileConfig
                                }
                            ];  
                            
                            if (slickConfig) {
                                var sliderObj = $scope.find('.hubtag-slick-slider').slick(slickConfig);
                                $scope.find('.hubtag-slick-slider').on('beforeChange', function(e, slick, currentSlide, nextSlide){
                                  //console.log('edge was hit')
                                    $(slick.$slides[nextSlide]).find('.slide-inner-content').addClass('animated');
                                    $(slick.$slides[nextSlide]).find('.slide-inner-content').addClass(config.content_animation);
                                    $(slick.$slides[currentSlide]).find('.slide-inner-content').removeClass(config.content_animation);

                                });
                                if(sliderObj){  
                                    if($scope.find(".hubtag-background-video-embed").length > 0){
                                        var videoType = $scope.find(".hubtag-background-video-embed").attr('data-videotype');
                                        if(videoType == 'vimeo'){
                                            myPlayer = $scope.find(".hubtag-background-video-embed").vimeo_player({onReady: function(player){}});   
                                        }else{
                                            $scope.find(".hubtag-background-video-embed").YTPlayer(); 
                                        }
                                    } 
                                }
                            } 
                    }
                } ); 
            }
    }
    
    // Add space for Elementor Menu Anchor link
    if (elementorFrontend.isEditMode()) {
        slider();
    }else {
        $(window).on('elementor/frontend/init', function () {
            slider();
        });
    }
} );