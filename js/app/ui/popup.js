/* PopUp */
$(document).ready(function(){
    var current_item;
    $('.container-item-img').click(function(){
            current_item = $(this).parent('.item');
            innerContent(current_item);
            loadPopup();
    });
    $('#shadow').click(function(){
            closePopup();
    });
    $('#popup-next').live('click', function(){
            clearPopupContent();
            innerContent(current_item.next('.item'));
            current_item = current_item.next('.item');
            showPopupContent();

    });
    $('#popup-prev').live('click', function(){
            clearPopupContent();
            innerContent(current_item.prev('.item'));
            current_item = current_item.prev('.item');
            showPopupContent();
    });
});

function innerContent(item){
    jQuery('#popup-content').empty();
    var img = item.data("img");
    var price = item.data("price");
    var brand = item.data("brand");
    var description = item.data("description");
    var popup_content = '<div id="popup-content-left">';
    popup_content += '		<img id="popup-img" src="'+img+'" />';
    popup_content += '	</div>';
    popup_content += '	<div id="popup-content-right">';
    popup_content += '		<span id="popup-title">título</span>';
    popup_content += '		<div id="popup-price-brand">';
    popup_content += '			<span id="popup-price">'+price+'</span><br />';
    popup_content += '			<span id="popup-brand"><a href="#">'+brand+'</a></span>';
    popup_content += '		</div>';
    popup_content += '		<div id="popup-description">'+description+'</div>';
    popup_content += '		<form action="" method="post" id="popup-form-send" name="popup-form-send">';
    popup_content += '			<input type="text" id="popup-input-send" name="popup-input-send" placeholder="enviar a un amigo" />';
    popup_content += '			<input type="submit" id="popup-submit" class="button-blue" name="popup-submit" value="enviar" /><br />';
    popup_content += '			<span id="popup-fb">facebook</span>';
    popup_content += '		</form>';
    popup_content += '	</div>';
    popup_content += '  <nav id="popup-nav">';
    popup_content += '		<ul class="nav-list">';
    popup_content += '			<li class="nav-popup-item" id="popup-prev"><img src="images/left.png"></li>';
    popup_content += '			<li class="nav-popup-item" id="popup-next"><img src="images/right.png"></li>';
    popup_content += '		</ul>';
    popup_content += '	</nav>';
    $('#popup-content').append(popup_content);
}

function loadPopup(event){
    jQuery('#shadow').css('width','100%');
    jQuery('#shadow').css('height', jQuery(document).height());
    var left = (jQuery(window).outerWidth() - jQuery('#popup').outerWidth()) / 2.0;
    var top = ((window.innerHeight - jQuery('#popup').outerHeight()) / 3.0);
    jQuery('#popup').css('left', left);
    jQuery('#popup').css('top', top);
    jQuery('#shadow').fadeTo('normal','0.8', function(){
            jQuery('#popup').fadeIn('normal');
                showPopupContent();
    });
}

function showPopupContent(){
    jQuery('#popup').animate({
    'width': jQuery('#popup-content').outerWidth(),
    'height': jQuery('#popup-content').outerHeight() + jQuery('#popup-nav').outerHeight(),
    'left': (jQuery(window).outerWidth() - (jQuery('#popup').outerWidth() - jQuery('#popup').width() + jQuery('#popup-content').outerWidth())) / 2.0,
    'top': (window.innerHeight - (jQuery('#popup').outerHeight() - jQuery('#popup').height() + jQuery('#popup-content').outerHeight())) / 3.0
    }, function(){						
            jQuery('#popup-content').prependTo('#popup');
            jQuery('#popup').css('background-image','none');
            jQuery('#popup-content').fadeIn('normal');
            jQuery('#input-new-category').focus();
    });
}

function clearPopupContent(){
    jQuery('#popup-content').css('display', 'none');
    jQuery('#popup').css('background-image','url(images/loading.gif');
    jQuery('#popup-content').empty();
    jQuery('#popup-content').appendTo('body');
}

function closePopup(){
    jQuery('#shadow').css('display', 'none');
    jQuery('#popup').css('display', 'none');
    jQuery('#popup-content').css('display', 'none');
    jQuery('#popup').width('300px');
    jQuery('#popup').height('150px');
    jQuery('#popup').css('background-image','url(images/loading.gif');
    jQuery('#popup-content').empty();
    jQuery('#popup-content').appendTo('body');
}

/***********/
/* ISOTOPE */
/***********/


$(document).ready(function(){
    // filter items when filter link is clicked
     $('.slider-item').isotope({
        // options
        itemSelector : '.item',
        layoutMode : 'fitRows'
    });
    click_category_filters();
    click_st_category_filters();
});

/* Products */
function click_category_filters(){
    $('#filters a').click(function(){ 
        console.log(content_control);
        if(content_control == "products"){
            var selector = $(this).attr('data-filter');
            $('.slider-item').isotope({filter: selector});
            return false;
        }else{
            content_control = "products";
            url = base_url + "main/products";
            var selector = $(this).attr('data-filter');
            insert_content(url);
            var a = $(this);
            $('#fade').animate({opacity: 1}, 400, function(){                
                active_drag_drop_products();
                a.click();
            });
        }
    });
}

/* Stores */

function click_st_category_filters(){
    $('#filters-stores a').click(function(){ 
         if(content_control == "stores"){
            var selector = $(this).attr('data-filter');
            $('.my-stores').isotope({filter: selector});
            return false;
        }else{
            content_control = "stores";
            var selector = $(this).attr('data-filter');
            url = base_url + "main/stores";
            insert_content(url);
            $('#fade').animate({opacity: 1}, 400, function(){ 
                 $('.my-stores').isotope({
                    // options
                    itemSelector : '.store',
                    layoutMode : 'fitRows'
                });  
                $('.my-stores').isotope({filter: selector}); 
                active_drag_store();
            });
        }
    });
}

/*****************/
/* Drag and drop */
/*****************/

$(document).ready(function(){
    active_drag_drop_products();
    active_drop_stores();
    
});

function active_drag_drop_products(){
    active_drag_products();
    active_drop_products();
}

function active_drag_drop_stores(){
    active_drag_store();
    active_drop_stores();
}

function active_drag_products(){
    
     $( ".item" ).draggable({
        appendTo: "body",
        helper: "clone",
        revert: "invalid",
        cursorAt: {left: 75 , top: 116},
        start: function(event, ui){
           ui.helper.fadeTo('fast', 0.5 );
        },
        stop: function(event, ui){  
          
        }
    });
}

function active_drop_products(){
    $( "#filters li a" ).droppable({
        activeClass: "readyDrop",
        hoverClass: "dropping",
        accept: ".item",
        drop: function( event, ui ) {
            var product_id = ui.draggable.data("id");
            var category_id = $( this ).data("categoryid");
            if(add_product_category(product_id , category_id)){
                ui.draggable.addClass(category_id + '');
            }
            ui.helper.effect("size", {to: {width: 0,height: 0}}, 1000);
            $( this ).removeClass("readyDrop");
            return false;
        }
    });
}



function active_drag_store(){
     $( ".store" ).draggable({
        appendTo: "body",
        helper: "clone",
        revert: "invalid",
        cursorAt: {left: 74 , top: 50},
        start: function(event, ui){
           ui.helper.fadeTo('fast', 0.5 );
        },
        stop: function(event, ui){ 
        }
    });
}

function active_drop_stores(){
    $( "#filters-stores li a" ).droppable({
        activeClass: "readyDrop",
        hoverClass: "dropping",
        accept: ".store",
        drop: function( event, ui ) {
            var store = ui.draggable.data("id");
            var category_id = $( this ).data("categoryid");
            if(add_store_to_StCategory(store , category_id)){
                ui.draggable.addClass(category_id + '');
            }
            ui.helper.effect("size", {to: {width: 0,height: 0}}, 1000);
            $( this ).removeClass("readyDrop");
            return false;
        }
    });
}

