/* Menu Accesss */
(function($) { //create closure so we can safely use $ as alias for jQuery
    $(document).ready(function() {
        // initialise plugin
        var example = $('#navaccess, #access').superfish({
            //add options here if required
        });
        // buttons to demonstrate Superfish's public methods
        $('.destroy').on('click', function() {
            example.superfish('destroy');
        });
        $('.init').on('click', function() {
            example.superfish();
        });
        $('.open').on('click', function() {
            example.children('li:first').superfish('show');
        });
        $('.close').on('click', function() {
            example.children('li:first').superfish('hide');
        });
    });
})(jQuery);




/*  myCarousel Banner

========================================================*/

$(function() {
    $('#myCarousel').carousel({
        interval: 3500,
        pause: "false"
    });
    $('#playButton').click(function() {
        $('#myCarousel').carousel('cycle');
    });

    $('#pauseButton').click(function() {
        $('#myCarousel').carousel('pause');
    });
});


/* Latest Updates */
$(document).ready(function() {
    $("#myUl").endlessRiver();

});

var multilines = $('#multilines1 .newsticker1').newsTicker({
    row_height: 70,
    speed: 1000,
    prevButton: $('#multilines1 .prev-button1'),
    nextButton: $('#multilines1 .next-button1'),
    stopButton: $('#multilines1 .stop-button'),
    startButton: $('#multilines1 .start-button'),

});
var multilines = $('#multilines2 .newsticker2').newsTicker({
    row_height: 82,
    speed: 1000,
    prevButton: $('#multilines2 .prev-button1'),
    nextButton: $('#multilines2 .next-button1'),
    stopButton: $('#multilines2 .stop-button'),
    startButton: $('#multilines2 .start-button'),

});

$('.orderticker .orderticker-list').newsTicker({
    speed: 1000,
    row_height: 30,
    interval: 3000,
    move: null,
    prevButton: $('.orderticker .prev-button1'),
    nextButton: $('.orderticker .next-button1'),
    stopButton: $('.orderticker .stop-button'),
    startButton: $('.orderticker .start-button'),

});

$('.newsTicker .newsTicker-list').newsTicker({
    speed: 1000,
    row_height: 30,
    interval: 3000,
    move: null,
    prevButton: $('.newsTicker .prev-button1'),
    nextButton: $('.newsTicker .next-button1'),
    stopButton: $('.newsTicker .stop-button'),
    startButton: $('.newsTicker .start-button'),

});

$('.noticeTicker .noticeTicker-list').newsTicker({
    speed: 1000,
    row_height: 20,
    interval: 3000,
    move: null,
    prevButton: $('.noticeTicker .prev-button1'),
    nextButton: $('.noticeTicker .next-button1'),
    stopButton: $('.noticeTicker .stop-button'),
    startButton: $('.noticeTicker .start-button'),

});


var multilines = $('#multilines1 .newsticker2').newsTicker({
    row_height: 82,
    speed: 1000,
    prevButton: $('#multilines1 .prev-button1'),
    nextButton: $('#multilines1 .next-button1'),
    stopButton: $('#multilines1 .stop-button'),
    startButton: $('#multilines1 .start-button'),

});
var multilines = $('#multilines3 .newsticker2').newsTicker({
    row_height: 82,
    speed: 1000,
    prevButton: $('#multilines3 .prev-button1'),
    nextButton: $('#multilines3 .next-button1'),
    stopButton: $('#multilines3 .stop-button'),
    startButton: $('#multilines3 .start-button'),

});


//Flex

$(document).ready(function() {
    //$(window).load(function() {

    $("#flexiselDemo3").flexisel({
        visibleItems: 4,
        itemsToScroll: 1,
        autoPlay: {
            enable: false,
            //interval: 3600,
            //autoPlay:false,
            pauseOnHover: true
        }
    });

    $("#flexiselDemo4").flexisel({
        visibleItems: 4,
        itemsToScroll: 1,
        autoPlay: {
            enable: false,
            interval: 3600,
            pauseOnHover: true
        }
    });
    $("#flexiselDemo5").flexisel({
        visibleItems: 5,
        itemsToScroll: 1,
        autoPlay: {
            enable: true,
            interval: 3800,
            pauseOnHover: true
        }
    });


});
//search button

$(document).ready(function() {
    var submitIcon = $('.searchbox-icon');
    var inputBox = $('.searchbox-input');
    var searchBox = $('.searchbox');
    var isOpen = false;
    submitIcon.click(function() {
        if (isOpen == false) {
            searchBox.addClass('searchbox-open');
            inputBox.focus();
            isOpen = true;
        } else {
            searchBox.removeClass('searchbox-open');
            inputBox.focusout();
            isOpen = false;
        }
    });
    submitIcon.mouseup(function() {
        return false;
    });
    searchBox.mouseup(function() {
        return false;
    });
    $(document).mouseup(function() {
        if (isOpen == true) {
            $('.searchbox-icon').css('display', 'block');
            submitIcon.click();
        }
    });
});

function buttonUp() {
    var inputVal = $('.searchbox-input').val();
    inputVal = $.trim(inputVal).length;
    if (inputVal !== 0) {
        $('.searchbox-icon').css('display', 'none');
    } else {
        $('.searchbox-input').val('');
        $('.searchbox-icon').css('display', 'block');
    }
}



//multistep form				

$(function() {

    //jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next").click(function() {
        if (animating) return false;
        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50) + "%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({ 'transform': 'scale(' + scale + ')' });
                next_fs.css({ 'left': left, 'opacity': opacity });
            },
            duration: 800,
            complete: function() {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".previous").click(function() {
        if (animating) return false;
        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1 - now) * 50) + "%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({ 'left': left });
                previous_fs.css({ 'transform': 'scale(' + scale + ')', 'opacity': opacity });
            },
            duration: 800,
            complete: function() {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".submit").click(function() {
        return false;
    })

});



//step wizard
$(document).ready(function() {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();

    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {

        var $target = $(e.target);

        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function(e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function(e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}

function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}