function ajax_load(url, content){
    
}

/* Add category */
	
$(document).ready(function(){
    jQuery('#add-category').click(function(){
            innerContentAddCategory();
            loadPopup();
            jQuery('#input-new-category').focus();
    });
});

function innerContentAddCategory(){
    jQuery('#popup-content').empty();
    var popup_content = '<div>';
    popup_content += '<form id="form-add-new-category" name="form-add-new-category" method="post">';
    popup_content += '		<label>Añadir una nueva categoría</label>';
    popup_content += '		<input type="text" id="input-new-category" name="input-new-category" />';
    popup_content += '		<input type="button" id="accept-new-category" name="accept-new-category" class="button" value="Añadir" onClick="saveCategory()" />';
    popup_content += '		<input type="button" id="cancel-new-category" name="cancel-new-category" class="button" value="Cancelar" onClick="closePopup()" />';
    popup_content += '	</form>';
    popup_content += '	</div>';
    $('#popup-content').append(popup_content);
}

function addCategory(new_category, new_category_id){
    var num_categories = jQuery('.slider-item-categories li').size();
    
    if(new_category != ''){
            if(num_categories % 6 == 0){
                    if(num_categories >= 6) { jQuery('#nav-categories').fadeIn('normal'); }
                    var new_html_slide = '<div id="slider-category-item-'+(num_categories / 6 + 1)+'" class="slider-item-categories">';
                    new_html_slide += '<nav>';
                    new_html_slide += '		<ul>';
                    new_html_slide += '			<li><a class="button" href="#" data-categoryid="'+ new_category_id +'" data-filter=".'+ new_category_id +'">'+new_category+'</a></li>';
                    new_html_slide += '		</ul>';
                    new_html_slide += '</nav>';
                    new_html_slide += '</div>';
                    jQuery('#slider-categories').append(new_html_slide);
            }
            else{
                    jQuery('#categories #container-slider-categories ul:last').append('<li><a class="button" href="#" data-categoryid="'+ new_category_id +'" data-filter=".'+ new_category_id +'">'+new_category+'</a></li>');
            }
            jQuery('#slider-categories-right').click();
            jQuery('#categories #container-slider-categories ul:last li:last').css('display','none');
            jQuery('#categories #container-slider-categories ul:last li:last').fadeIn('slow');
    }
    closePopup();
    click_category_filters();
}


function saveCategory(){
    var new_category = jQuery('#input-new-category').val();
    jQuery.ajax({
        url: base_url+ "category/add/" +new_category,
        async: false,
            success: function(respuesta){										
                addCategory(new_category, respuesta);
        }							  
    });	
}

/* Add a category to product */
function add_product_category(product_id, category_id){    
    var success = true;
    url = base_url + "category/add_product_category/" + product_id + "/" +category_id;
    jQuery.ajax({
        url: url,
        async: false,
        complete: function(objeto, exito){
            if(exito=="success"){
            }
        },
        error: function(objeto, quepaso, otroobj){
            success =  false;
        }
    });	
    return success;
}

/* Insert html to content*/
function insert_content(url){
    url = base_url + url;
    var miAjax = new Ajax(
        url,
        { method: 'get', update: $('#content') }
    );
    miAjax.request();
}