/**
 * Carousel - jQuery plugin for MetroUiCss framework
 */

(function($) {
    var pluginName = 'Carousel',
        initAllSelector = '[data-role=carousel], .carousel',
        paramKeys = ['Auto', 'Period', 'Duration', 'Effect', 'Direction', 'Markers', 'Arrows', 'Stop'];

    $[pluginName] = function(element, options) {
        if (!element) {
            return $()[pluginName]({initAll: true});
        }

        // default settings
        var defaults = {
            // auto slide change
            auto: false,
            // slide change period
            period: 6000,
            // animation duration
            duration: 1000,
            // animation effect (fade, slide, switch, slowdown)
            effect: 'fade',
            // animation direction (left, right) for some kinds of animation effect
            direction: 'right',
            // markers below the carousel
            markers: 'off',
            // prev and next arrows
            arrows: 'on',
            // stop sliding when cursor over the carousel
            stop: 'on'
        };
        // alert(defaults.effect);
        var plugin = this;
        // plugin settings
        plugin.settings = {};

        var $element = $(element); // reference to the jQuery version of DOM element

        var slides, // all slides DOM objects
            currentSlideIndex, // index of current slide
            slideInPosition, // slide start position before it's appear
            slideOutPosition, // slide position after it's disappear
            parentWidth,
            parentHeight,
            animationInProgress,
            autoSlideTimer,
            markers,
            stopAutoSlide = false;

        // initialization
        plugin.init = function () {
            //alert("plugin.init");
            plugin.settings = $.extend({}, defaults, options);
            // alert(plugin.settings.effect);

            slides = $element.find('.slides:first-child > .slide');
            // alert($element.find('.slides:first-child > .slide').length);
            // alert($element.find('.slides > .slide').length);
            // alert($element.find('.slides:first-child').length);
            // alert("sliedes="+$('.slides').length);
            // alert("sliede="+$('.slide').length);
            // alert("image="+$('.image').length);
            // if only one slide
            // if (slides.length <= 1) {
            //     // alert(slides.length);
            //     return;
            // }

            //alert($element.find('#rot').html());
            currentSlideIndex = 0;
            $element.find('#rot').on('click', function(){
                   rotCurrentImg();
                    // startAutoSlide();
                    //alert("点击rot");
                }) ;  

            // parent block dimensions
            parentWidth = $element.innerWidth();
            parentHeight = $element.innerHeight();
            // slides positions, used for some kinds of animation
            slideInPosition = getSlideInPosition();
            slideOutPosition = getSlideOutPosition();

            // prepare slide elements
            slides.each(function (index, slide) {
                $slide = $(slide);
                // each slide must have position:absolute
                // if not, set it
                if ($slide.css('position') !== 'absolute') {
                    $slide.css('position', 'absolute');
                }
                // disappear all slides, except first
                if (index !== 0) {
                    $slide.hide();
                }
            });

            // alert("plugin.init2222");
            if (plugin.settings.arrows === 'on') {
                // prev next buttons handlers
                $element.find('span.control.left').on('click', function(){
                    changeSlide('left');
                    // startAutoSlide();
                    // alert("点击左键2222");
                });
                $element.find('span.control.right').on('click', function(){
                    changeSlide('right');
                    // startAutoSlide();
                    // alert("点击右键2222");
                });
            } else {
                $element.find('span.control').hide();
            }

            // markers
            if (plugin.settings.markers === 'on') {
                insertMarkers();
            }

            // enable auto slide
            if (plugin.settings.auto === true) {
                startAutoSlide();

                // stop sliding when cursor over the carousel
                if (plugin.settings.stop === 'on') {
                    $element.on('mouseenter', function () {
                        stopAutoSlide = true;
                    });
                    $element.on('mouseleave', function () {
                        stopAutoSlide = false;
                        startAutoSlide();
                    });
                }
            }

            // u can use same code:
            // $('#carusel').trigger('changeSlide', [{direction: 'left', effect: 'fade', index: 1}])
            // any option not required
            $element.on('changeSlide', function(event, options){
                options = options || {};
                changeSlide(options.direction, options.effect, options.index);
            });
        };

        /**
         * returns start position for appearing slide {left: xxx}
         */
        var getSlideInPosition = function () {
            var pos;
            if (plugin.settings.direction === 'left') {
                pos = {
                    'left': parentWidth
                }
            } else if (plugin.settings.direction === 'right') {
                pos = {
                    'left': -parentWidth
                }
            }
            return pos;
        };

        /**
         * returns end position of disappearing slide {left: xxx}
         */
        var getSlideOutPosition = function () {
            var pos;
            if (plugin.settings.direction === 'left') {
                pos = {
                    'left': -parentWidth
                }
            } else if (plugin.settings.direction === 'right') {
                pos = {
                    'left': parentWidth
                }
            }
            return pos;
        };

        /**
         * start or restart auto change
         */
        var startAutoSlide = function () {
            clearInterval(autoSlideTimer);
            // start slide changer timer
            autoSlideTimer = setInterval(function () {
                if (stopAutoSlide) {
                    return;
                }
                changeSlide();
            }, plugin.settings.period);
        };

        /**
         * inserts markers below the carousel
         */
        var insertMarkers = function () {
            var div, ul, li, i;

            div = $('<div class="markers"></div>');
            ul = $('<ul></ul>').appendTo(div);

            for (i = 0; i < slides.length; i++) {
                li = $('<li><a href="javascript:void(0)" data-num="' + i + '"></a></li>');
                if (i === 0) {
                    li.addClass('active');
                }
                li.appendTo(ul);
            }

            markers = ul.find('li');

            ul.find('li a').on('click', function () {
                var $this = $(this),
                    index;

                // index of appearing slide
                index = $this.data('num');
                if (index === currentSlideIndex) {
                    return;
                }

                changeSlide(undefined, 'switch', index);
                // startAutoSlide();
            });

            div.appendTo($element);
        };

        /**
         * changes slide to next
         */
        var changeSlide = function(direction, effect, slideIndex) {

            var outSlide, // disappearin slide element
                inSlide, // appearing slide element
                nextSlideIndex,
                delta = 1,
                slideDirection = 1;

            effect = effect || plugin.settings.effect;
            // alert(plugin.settings.effect);
            // alert(effect);
            // correct slide direction, used for 'slide' and 'slowdown' effects
            if ((effect === 'slide' || effect === 'slowdown') && typeof direction !== 'undefined' && direction !== plugin.settings.direction) {
                slideDirection = -1;
            }
            if (direction === 'left') {
                delta = -1;
            }

            outSlide = $(slides[currentSlideIndex]);

            nextSlideIndex = (typeof slideIndex !== 'undefined' && slideIndex !== currentSlideIndex) ? slideIndex : currentSlideIndex + delta;
            if (nextSlideIndex >= slides.length) {
                nextSlideIndex = 0;
            }
            if (nextSlideIndex < 0) {
                nextSlideIndex = slides.length - 1;
            }

            inSlide = $(slides[nextSlideIndex]);

            if (animationInProgress === true) {
                return;
            }

            // switch effect is quickly, no need to wait
            if (effect !== 'switch') {
                // when animation in progress no other animation occur
                animationInProgress = true;
                setTimeout(function () {
                    animationInProgress = false;
                }, plugin.settings.duration)
            }

            // change slide with selected effect
            switch (effect) {
                case 'switch':
                    changeSlideSwitch(outSlide, inSlide);
                    break;
                case 'slide':
                    changeSlideSlide(outSlide, inSlide, slideDirection);
                    break;
                case 'fade':
                    changeSlideFade(outSlide, inSlide);
                    break;
                case 'slowdown':
                    changeSlideSlowdown(outSlide, inSlide, slideDirection);
                    break;
            }

            currentSlideIndex = nextSlideIndex;

            // switch marker
            if (plugin.settings.markers === 'on') {
                markers.removeClass('active');
                $(markers.get(currentSlideIndex)).addClass('active');
            }

        };
        /**
         * switch effect
         */
        var changeSlideSwitch = function (outSlide, inSlide) {
            inSlide.show().css({'left': 0});
            outSlide.hide();
        };
        /**
         * slide effect
         */
        var changeSlideSlide = function (outSlide, inSlide, slideDirection) {
            var unmovedPosition = {'left': 0},
                duration = plugin.settings.duration;

            if (slideDirection !== -1) {
                inSlide.css(slideInPosition);
                inSlide.show();
                outSlide.animate(slideOutPosition, duration);
                inSlide.animate(unmovedPosition, duration);
            } else {
                inSlide.css(slideOutPosition);
                inSlide.show();
                outSlide.animate(slideInPosition, duration);
                inSlide.animate(unmovedPosition, duration);
            }
        };
        /**
         * slowdown slide effect (custom easing 'doubleSqrt')
         */
        var changeSlideSlowdown = function (outSlide, inSlide, slideDirection) {
            var unmovedPosition = {'left': 0},
                options;

            options = {
                'duration': plugin.settings.duration,
                'easing': 'doubleSqrt'
            };

            if (slideDirection !== -1) {
                inSlide.css(slideInPosition);
                inSlide.show();
                outSlide.animate(slideOutPosition, options);
                inSlide.animate(unmovedPosition, options);
            } else {
                inSlide.css(slideOutPosition);
                inSlide.show();
                outSlide.animate(slideInPosition, options);
                inSlide.animate(unmovedPosition, options);
            }
        };
        /**
         * fade effect
         */
        var changeSlideFade = function (outSlide, inSlide) {
            inSlide.hide();
            inSlide.css({
                left: 0,
                top: 0
            });
            inSlide.fadeIn(plugin.settings.duration);
            outSlide.fadeOut(plugin.settings.duration);
        };
        var rotCurrentImg = function () {
            $currentImg=$('.slide img').eq(currentSlideIndex);
            // alert(currentSlideIndex);

            if($currentImg.hasClass('rot4'))
                {
                    $currentImg.removeClass('rot4').addClass('rot1');                
                    return;
                }
            if($currentImg.hasClass('rot1'))
                {
                    $currentImg.removeClass('rot1').addClass('rot2'); 
                    return;
                }
            if($currentImg.hasClass('rot2'))
                {
                    $currentImg.removeClass('rot2').addClass('rot3');  
                    return;
                }
            if($currentImg.hasClass('rot3'))
                {
                    $currentImg.removeClass('rot3').addClass('rot4'); 
                    return;
                }
            };
          

        plugin.init();

    };

    // easing effect for jquery animation
    $.easing.doubleSqrt = function(t, millisecondsSince, startValue, endValue, totalDuration) {
        var res = Math.sqrt(Math.sqrt(t));
        return res;
    };

    $.fn[pluginName] = function(options) {
        var elements = options && options.initAll ? $(initAllSelector) : this;
        //alert("initialization");
        return elements.each(function() {
            var that = $(this),
                params = {},
                plugin;
            if (undefined == that.data(pluginName)) {
                //alert("initialization in");
                $.each(paramKeys, function(index, key){
                    params[key[0].toLowerCase() + key.slice(1)] = that.data('param' + key);
                });
                plugin = new $[pluginName](this, params);
                that.data(pluginName, plugin);
            }
        });
    };
    // autoinit
    $(function(){     
        var url="fc.php"+document.location.search;        
        $("#fc").load(url,function(){
            var lx=$("input:hidden").eq(0).val();
            var id=$("input:hidden").eq(1).val();
            var printUrl="print"+lx+".php"+"?lx="+lx+"&id="+id;
            console.log(printUrl);
            $("#print-btn").attr("href",printUrl);
            var path=$("input:hidden:last").val();
            var url2="showjpeg.php"+"?tifpath="+path;
            $("#myjpg").load(url2,function(){
                $()[pluginName]({initAll: true});
                if ($('.slide').length==1) {$('span.control').remove()} ;           
                $('span.control').hide();
                $('#rot').hide();  
                $('#myjpg').hover(function(){
                        $('span.control').show(); 
                        $('#rot').show();       
                },
                function(){
                    $('span.control').hide(); 
                    $('#rot').hide();        
                });
                
            });
        });
        $(document).on('click','#jpg-btn',function(){
            $("#windowsbg").show();
            $("#myjpg").css("top","0");
        });
        $("#windowsbg").on("click",function(){
            $("#windowsbg").hide();
            $("#myjpg").css("top","-2000");
        })

    })
    

        
    

})(jQuery);