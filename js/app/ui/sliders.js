/* Script Slider productos */		

$(document).ready(function(){
    var slider_width = $('#container-slider-products').width();
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
        $('#slider-products').stop().animate({	'left' : -current_item * slider_width	},{
            duration: 1200,
            easing: 'easeInCubic'
        });
    });
});

		
/* Script Slider tiendas */

$(document).ready(function(){
    var slider_stores_width = $('#container-slider-stores').width();
    var current_stores_item = 0;
    $('#nav-stores .nav-item').click(function (){
        if($(this).attr('id') == 'slider-stores-left'){
            if (current_stores_item > 0)
                    current_stores_item--;
        }
        else if($(this).attr('id') == 'slider-stores-right'){						
            if (current_stores_item < $('.slider-item-stores').length-1)
                    current_stores_item++;
        }
        $('#slider-stores').stop().animate({	'left' : -current_stores_item * slider_stores_width	},{
            duration: 1200,
            easing: 'easeInCubic'
        });
    });
});

		


/* Script Slider categorias */
		
$(document).ready(function(){
    var slider_stores_width = $('#container-slider-categories').width();
    var current_stores_item = 0;
    $('#nav-categories .nav-item').click(function (){
            if($(this).attr('id') == 'slider-categories-left'){
                if (current_stores_item > 0)
                        current_stores_item--;
            }
            else if($(this).attr('id') == 'slider-categories-right'){						
                if (current_stores_item < $('.slider-item-categories').length-1)
                        current_stores_item++;
            }
            $('#slider-categories').stop().animate({	'left' : -current_stores_item * slider_stores_width	},{
                duration: 1200,
                easing: 'easeInCubic'
            });
    });
});
	