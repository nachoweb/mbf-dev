//Slider Products 
$(document).ready(function(){
    var slider_width = $('.container-slider').width();
    var current_item = 0;
    $('#nav-slider .nav-item').click(function (){
        if($(this).attr('id') == 'slider-left'){
                if (current_item > 0)
                        current_item--;
        }
        else if($(this).attr('id') == 'slider-right'){						
                if (current_item < $('.slider-item').length-1)
                        current_item++;
        }
        $('.slider').animate({	'left' : -current_item * slider_width	});
    });
});
