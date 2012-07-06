/********************/
/*  Funciones ajax  */
/********************/

/* Add store_user */
function add_store_user(store_id){    
    var success = true;
    url = base_url + "store/add_user_store/" + store_id ;
    var store = $("#store_" + store_id);
    var store2 = store.clone();
    jQuery.ajax({
        url: url,
        async: false,
        complete: function(objeto, exito){
            if(exito=="success"){
                var store = $("#store_" + store_id);
                var store2 = store.clone();
                $("#mis-tiendas").prepend(store2);
                cargar_tool_tips();
                store2.children('.options-store').children('.tooltip-guardar').fadeOut('fast');
                store2.on("mouseenter", function(){
                    $(this).children('.options-store').fadeIn('normal');
                });
                store2.on("mouseleave", function(){
                    $(this).children('.options-store').fadeOut('normal');
                }
                );
                store2.attr("id","my_store_" + store_id);
                store2.children('.options-store').fadeOut('normal');
            }
        },
        error: function(objeto, quepaso, otroobj){
            success =  false;
        }
    });
    return false;
}



/****************/
/* Category     */
/****************/

	
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
    popup_content += '<form id="form-add-new-category" name="form-add-new-category" class="form-add-new-category" method="post">';
    popup_content += '		<label>Añadir una nueva categoría</label>';
    popup_content += '		<input type="text" id="input-new-category" name="input-new-category" class="input-new-category"/>';
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
                    if(num_categories >= 6) {jQuery('#nav-categories').fadeIn('normal');}
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
                    jQuery('#categories #container-slider-categories ul:last').append('<li><a class="button" href="#'+new_category+'" data-categoryid="'+ new_category_id +'" data-filter=".'+ new_category_id +'">'+new_category+'</a></li>');
            }
            jQuery('#slider-categories-right').click();
            jQuery('#categories #container-slider-categories ul:last li:last').css('display','none');
            jQuery('#categories #container-slider-categories ul:last li:last').fadeIn('slow');
    }
    closePopup();
    active_drop_products();
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

/* Add new DOM category */
function addCategory(new_category, new_category_id){
    if(new_category != ''){
                jQuery('#categories #container-slider-categories ul:last').append('<li><a class="button" href="#'+new_category+'" data-categoryid="'+ new_category_id +'" data-filter=".'+ new_category_id +'">'+new_category+'</a></li>');
        }
    jQuery('#categories #container-slider-categories ul:last li:last').css('display','none');
    jQuery('#categories #container-slider-categories ul:last li:last').fadeIn('slow');
    closePopup();
    active_drop_products();
    click_category_filters();
}

/* Add product-category */
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
    $('.producto').children('.options-producto').fadeOut('normal');
    return success;
}

/***********/
/* ISOTOPE */
/***********/


$(document).ready(function(){
   active_isotope_products();
});

function active_isotope_products(){
     // filter items when filter link is clicked
     $('#container-productos').isotope({
        // options
        itemSelector : '.producto',
        layoutMode : 'fitRows'
    });
    click_category_filters();
}

/* Products */
function click_category_filters(){
    $('#product_filters a').click(function(){ 
            var selector = $(this).attr('data-filter');
            $('#container-productos').isotope({filter: selector});
            console.log("filtro");
            return false;
    });
}


/************/
/* GUILLE   */
/************/

/* Ajustar tamaño imagen */
$(document).ready(function(){
	$('.image-fit').css('visibility','hidden');
});

function fit(el, w, h){
    /* si width o height no están definidos se toman del padre */
    if(w === undefined)
        w = el.parent().width();
    if(h === undefined)
        h = el.parent().height();
    if(el.width() >= el.height()){
        el.css('height', h+'px');
        if(el.width() < w){
            el.css('width', w+'px');
            el.css('height', 'auto');
            var margintop = (el.height() - h) / 2;
            el.css('marginTop',-margintop+'px');
        }
        var marginleft = (el.width() - w) / 2;
        el.css('marginLeft',-marginleft+'px');
    }
    else{
        el.css('width', w+'px');
        if(el.height() < h){
            el.css('height', h+'px');
            el.css('width', 'auto');
            var marginleft = (el.width() - w) / 2;
            el.css('marginLeft',-marginleft+'px');
        }
        var margintop = (el.height() - h) / 2;
        el.css('marginTop',-margintop+'px');
    }
    el.css('visibility','visible');
}

$(window).load(function(){		
    $('.image-fit').css('visibility','visible');
}); 

/* Alto sidebar igual a content */
$(document).ready(function(){
    $('#sidebar').css('min-height',$('#content').css('height'));
});


/* Menú tiendas */
$(document).ready(function(){
    $('#button-tiendas-mbf').click(function(){
        $('#menu-stores .button').removeClass('active');
        $('#button-tiendas-mbf').addClass('active');
        $('#tiendas-mbf').fadeIn('normal');
        $('#mis-tiendas').fadeOut('normal',function(){$('#sidebar').animate({
                'min-height': $('#content').css('height')
                })
        });
         return false;

    });
    $('#button-mis-tiendas').click(function(){
        $('#menu-stores .button').removeClass('active');
        $('#button-mis-tiendas').addClass('active');
        $('#mis-tiendas').fadeIn('normal');
        $('#tiendas-mbf').fadeOut('normal',function(){$('#sidebar').animate({
            'min-height': $('#content').css('height')
            })
        });
         return false;
    });
});

/* Opciones tienda */
$(document).ready(function(){
   tool_bar_stores_events();
});

/* Tooltip tienda */
$(document).ready(function(){
    cargar_tool_tips();
});

function tool_bar_stores_events(){
        $('.store').on("mouseenter", function(){
            $(this).children('.options-store').fadeIn('normal');
        });
        $('.store').on("mouseleave", function(){
            $(this).children('.options-store').fadeOut('normal');
        }
        );
}

function cargar_tool_tips(){
    $('.sesion').on("mouseenter", function(){
        $(this).parent().children('.tooltip-sesion').fadeIn('normal')
    });
    
    $('.sesion').on("mouseleave", function(){
        $(this).parent().children('.tooltip-sesion').fadeOut('fast')
    });

    $('.ir-tienda').on("mouseenter", function(){
            $(this).parent().children('.tooltip-tienda').fadeIn('normal')
    });
    
    $('.ir-tienda').on("mouseleave", function(){
            $(this).parent().children('.tooltip-tienda').fadeOut('fast')
    });
    
    $('.suscribirse').on("mouseenter", function(){
            $(this).parent().children('.tooltip-guardar').fadeIn('normal')
    });
    
    $('.suscribirse').on("mouseleave", function(){
        $(this).parent().children('.tooltip-guardar').fadeOut('fast')
        }
    );
}

/* Opciones producto */
$(document).ready(function(){
	$('.producto').hover(
		function(){
			$(this).children('.options-producto').fadeIn('normal')
		},
		function(){
			$(this).children('.options-producto').fadeOut('normal')
		}
	);
});

/* Tooltip producto */
$(document).ready(function(){
	$('.producto-carpeta').hover(
		function(){
			$(this).parent().children('.tooltip-producto-carpeta').stop().fadeIn('fast')
		},
		function(){
			$(this).parent().children('.tooltip-producto-carpeta').fadeOut('fast')
		}
	);
	$('.tooltip-producto-carpeta').hover(
		function(){
			$(this).stop().fadeIn('normal')
		},
		function(){
			$(this).fadeOut('fast')
		}
	);
});