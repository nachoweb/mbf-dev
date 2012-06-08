/* POPUP */
$(document).ready(function(){
        var item_numbers = $('.item').length;
        var item_index = 0;
        var current_item;   
       
        $('.item').click(function(){
                current_item = $(this);
                innerContent($(this));
                loadPopup();
        });
        $('#shadow').click(function(){
                closePopup();
        });
        $('#popup-next').click(function(){
             if(item_index < item_numbers-1){
                clearPopupContent();
                innerContent(current_item.next('.item'));
                current_item = current_item.next('.item');
                showPopupContent();
                item_index++;
             }
        });
        $('#popup-prev').click(function(){
            if(item_index > 0){
                clearPopupContent();
                innerContent(current_item.prev('.item'));
                current_item = current_item.prev('.item');
                showPopupContent();
                item_index--;
             }
        });
});

function innerContent(item){
        console.log(item.data("store-url"));
        jQuery('#popup-content').empty();
        var img = item.data("img");
        var price = item.data("price");
        var brand = item.data("brand");
        var store_url = 'http://' + item.data("store-url");
        var description = item.data("description");
        var popup_content = '<div id="popup-content-left">';
        popup_content += '		<img id="popup-img" src="'+img+'" />';
        popup_content += '	</div>';
        popup_content += '	<div id="popup-content-right">';
        popup_content += '		<span id="popup-title">título</span>';
        popup_content += '		<div id="popup-price-brand">';
        popup_content += '			<span id="popup-price">'+price+'</span><br />';
        popup_content += '			<span id="popup-brand"><a href="'+store_url+'" target="_blank">'+brand+'</a></span>';
        popup_content += '		</div>';
        popup_content += '		<div id="popup-description">'+description+'</div>';
        popup_content += '		<form action="" method="post" id="popup-form-send" name="popup-form-send">';
        popup_content += '			<input type="text" id="popup-input-send" name="popup-input-send" placeholder="enviar a un amigo" />';
        popup_content += '			<input type="submit" id="popup-submit" class="button-blue" name="popup-submit" value="enviar" /><br />';
        //popup_content += '			<span id="popup-fb">facebook</span>';
        popup_content += '		</form>';
        popup_content += '	</div>';
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
        'width': jQuery('#popup-content').outerWidth() + 10,
        'height': jQuery('#popup-content').outerHeight() + jQuery('#popup-nav').outerHeight(),
        'left': (jQuery(window).outerWidth() - (jQuery('#popup').outerWidth() - jQuery('#popup').width() + jQuery('#popup-content').outerWidth())) / 2.0,
        'top': (window.innerHeight - (jQuery('#popup').outerHeight() - jQuery('#popup').height() + jQuery('#popup-content').outerHeight())) / 3.0,
        }, function(){						
                jQuery('#popup-content').appendTo('#popup');
                jQuery('#popup').css('background-image','none');
                jQuery('#popup-content').fadeIn('normal');
        });
}
function clearPopupContent(){
        jQuery('#popup-content').css('display', 'none');
        jQuery('#popup').css('background-image','url('+ base_url + 'css/images/loading.gif)');
        jQuery('#popup-content').empty();
        jQuery('#popup-content').appendTo('body');
}
function closePopup(){
        jQuery('#shadow').css('display', 'none');
        jQuery('#popup').css('display', 'none');
        jQuery('#popup-content').css('display', 'none');
        jQuery('#popup').width('300px');
        jQuery('#popup').height('150px');
        jQuery('#popup').css('background-image','url('+ base_url + 'css/images/loading.gif)');
        jQuery('#popup-content').empty();
        jQuery('#popup-content').appendTo('body');
}
