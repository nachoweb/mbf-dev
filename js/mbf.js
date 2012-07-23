/* Variables */
var inter = 0;
var options = {"section" : "home"};

/********************/
/*  Funciones ajax  */
/********************/

/* Ajax */
function get_by_ajax(url, type){
    var r = "";
    jQuery.ajax({
        url: url,
        async: false,
        dataType: type,
        success: function(respuesta){										
            r = respuesta;
        },
        error: function(error){
            r = error;
        }
    });	
    return r;
}

/* Event click menu */
$(document).ready(function(){
    activar_slider_explicacion();
    $("#menu_inicio").click(function(){
        options = {"section" : "home"};
        refresh_content(options);
        $("#menu-sidebar .active").removeClass("active");
        $(this).addClass("active");
        activar_slider_explicacion();
    });
    
    $("#menu_tiendas").click(function(){
        options = {"section" : "stores"};
        refresh_content(options);
        $("#menu-sidebar .active").removeClass("active");
        $(this).addClass("active");
    });
    
    $("#menu_mis_cosas").click(function(){
        options = {"section" : "products"};
        refresh_content(options);
        $("#menu-sidebar .active").removeClass("active");
        $(this).addClass("active");
    });
    
    $("#menu_sesiones").click(function(){
        options = {"section" : "sessions"};
        refresh_content(options);
        $("#menu-sidebar .active").removeClass("active");
        $(this).addClass("active");
    });
});

/* Navigability */
function refresh_content(options){
    var content = "";
    
    if(options.section == "home"){
        document.getElementById("content").innerHTML = "";
        content = get_by_ajax(base_url + "main/steps", "text");
        console.log(base_url + "main/steps");
        document.getElementById("content").innerHTML = content;
        window.clearInterval(inter);
    }else if(options.section == "products"){
        content = get_by_ajax(base_url + "main/products", "text");
        document.getElementById("content").innerHTML = content;
        load_product_options();
        active_isotope_products();
         console.log(inter);
        window.clearInterval(inter);
    }else if(options.section == "stores"){
        content = get_by_ajax(base_url + "main/stores", "text");
        document.getElementById("content").innerHTML = content;
        tool_bar_stores_events();
        cargar_tool_tips_stores();
        inicializar_menu_tiendas();    
         console.log(inter);
        window.clearInterval(inter);
    }else if (options.section == "sessions"){
        content = get_by_ajax(base_url + "main/my_sessions", "text");
        document.getElementById("content").innerHTML = content;
        console.log(inter);
        window.clearInterval(inter);
    }else if (options.section == "session"){
        content = get_by_ajax(base_url + "main/session/" + options.session, "text");
        document.getElementById("content").innerHTML = content;
        $("#sesion-chat").animate({scrollTop: $("#sesion-chat")[0].scrollHeight}, 0);
        inter = window.setInterval(refresh_messages, 15000);
        console.log(inter);
    }   
}

$(document).ready(function(){
    document.onkeydown = function(){ 
        if(window.event && window.event.keyCode == 116){ 
            event.preventDefault();
            refresh();    
        } 
        if(window.event && window.event.keyCode == 505){
            event.preventDefault();
            refresh();
        } 
    } 
});

function refresh(){
    refresh_content(options);
}

/* Slider explicación */
function activar_slider_explicacion(){
var slider_width = $('.slider-register-container').width();
var current_item = 0;
$('#nav-slider-register .nav-item-register').click(function (){
        if($(this).attr('id') == 'slider-left'){
                if (current_item > 0){
                        current_item--;
                }
                if(current_item==1){
                    jQuery("#slider-right").text("Siguiente")
                }
        }
        else if($(this).attr('id') == 'slider-right'){						
                if (current_item < $('.slider-register-item').length-1){
                        current_item++;
                }
                if(current_item==2){
                    jQuery("#slider-right").text("")
                }
        }
        $('.slider').animate({'left' : -current_item * slider_width});
    });
}


function prepare_session(session_id){
    options = {
        "section" : "session" ,
        "session" : session_id
    };
    refresh_content(options);
}

/* Add message sessions */
$(document).ready(function(){
    $('#new-message').live('keypress', function(e){
        var text = encodeURIComponent($(this).val());
        var session = $(this).attr('data-session');
        var last = $(this).attr('data-last');
        if(e.which == 13){
            //Paramos maquinaria
            e.preventDefault();
                $(this).val("");

            //Mandamos
            url = base_url + "messages/add/" + session+ "/" + text + "/" + last;  
            var respuesta = get_by_ajax(url, "json");
            add_messages(respuesta.messages);
            jQuery(this).attr("data-last", respuesta.last_message);
            //Insertamos
        /*    message =  "<div class='sesion-message'>";
            message += "    <div class='sesion-message-left'>";
            message += "        <span class='sesion-message-name'>Nachete</span>"
            message += "        <span class='sesion-message-time'>16:00h</span>"
            message += "    </div>"
            message += "   <div class='sesion-message-right'>"
            message += "        <p class='sesion-message-text'>"
            message +=              text
            message += "        </p>"
            message += "   </div>"
            message += "</div>"
            $("#sesion-chat").append(message);
            $("#sesion-chat").animate({ scrollTop: $("#sesion-chat")[0].scrollHeight }, 3000);*/
        }
       
    });  
});


function add_messages(messages){
    var dom = "";
    for(var i in messages){
        dom += "<div class='sesion-message'>";
        dom += "    <div class='sesion-message-left'>";
        dom += "        <span class='sesion-message-name'>" + messages[i].nick + "</span>"
        dom += "        <span class='sesion-message-time'>" + messages[i].date + "</span>"
        dom += "    </div>"
        dom += "   <div class='sesion-message-right'>"
        dom += "        <p class='sesion-message-text'>"
        dom +=              messages[i].text
        dom += "        </p>"
        dom += "   </div>"
        dom += "</div>"
    }
    $("#sesion-chat").append(dom);
    $("#sesion-chat").animate({scrollTop: $("#sesion-chat")[0].scrollHeight}, 3000);
    
}


function refresh_messages(){
    var session = $('#new-message').attr('data-session');
    var last = $('#new-message').attr('data-last');
    url = base_url + "messages/get_messages/" + session + "/" + last;
    var respuesta = get_by_ajax(url, "json");
    console.log(respuesta);
    add_messages(respuesta.messages);
    if(respuesta.last_message != 0){
        $('#new-message').attr("data-last",respuesta.last_message );
    }
}

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
                cargar_tool_tips_stores();
                store2.children('.options-store').children('.tooltip-guardar').css("display", "none");
                store2.on("mouseenter", function(){
                    $(this).children('.options-store').fadeIn('normal');
                });
                store2.on("mouseleave", function(){
                    $(this).children('.options-store').fadeOut('normal');
                }
                );
                store2.attr("id","my_store_" + store_id);
                store2.children('.options-store').css("display", "none");
            }
        },
        error: function(objeto, quepaso, otroobj){
            success =  false;
        }
    });
    return false;
}

/************/
/* Popup    */
/************/

$(document).ready(function(){
    var current_item;
    $('.container-img-producto').live('click', function(){
            current_item = $(this).parent('.producto');
            console.log(current_item);
            innerContent(current_item);
            loadPopup();
    });
    $('#shadow').click(function(){
            closePopup();
    });

    $('#popup-next').live('click', function(){
            clearPopupContent();
            innerContent(current_item.next('.producto'));
            current_item = current_item.next('.producto');
            //showPopupContent();

    });
    $('#popup-prev').live('click', function(){
            clearPopupContent();
            innerContent(current_item.prev('.producto'));
            current_item = current_item.prev('.producto');
           // showPopupContent();
    });
    
    
      $('#input-link').live('click', function(){
            $(this).select();        
           // showPopupContent();
    });
});

function innerContent(item){
    jQuery('#popup-content').empty();
    var img = item.data("img");
    var price = item.data("price");
    var brand = item.data("brand");
    var description = item.data("description");
    var link = item.data("producturl");
    var title = item.data("title");
    var popup_content = '<div id="popup-content-left" >';
    popup_content += '		<a href="'+link+'" target="_blank"><img id="popup-img" src="'+img+'" onload="showPopupContent();"/></a>';
    popup_content += '	</div>';
    popup_content += '	<div id="popup-content-right">';
    popup_content += '		<span id="popup-title">'+ title +'</span>';
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

function innerContentAddSession(){
    jQuery('#popup-content').empty();
    var popup_content = '<div>';
    popup_content += '<form id="form-add-new-session" name="form-add-new-session" class="form-add-new-category" method="post">';
    popup_content += '		<label>Crear sesión</label>';
    popup_content += '		<input type="text" id="input-new-session" name="input-new-session" class="input-new-category"/>';
    popup_content += '		<input type="button" id="accept-new-category" name="accept-new-session" class="button" value="Añadir" onClick="saveSession()" />';
    popup_content += '		<input type="button" id="cancel-new-session" name="cancel-new-session" class="button" value="Cancelar" onClick="closePopup()" />';
    popup_content += '	</form>';
    popup_content += '	</div>';
    $('#popup-content').append(popup_content);
}

function innerContentHex(hex){
    jQuery('#popup-content').empty();
    var popup_content = '<div class="form-add-new-category">';
    popup_content += "<p>Para invitar un amigo, copia y envía este link a un amigo: </p>";   
    popup_content += "<input type='text' id='input-link' value='" + base_url + "?invitation=" + hex + "'><br/>";    
    popup_content += "<input type='button' class='button' value='Ok' onClick='closePopup()'>";   
    popup_content += "</div>";    
    $('#popup-content').append(popup_content);
}

function loadPopup(event){
    //Add events
    $(document).bind('keypress', function(e) {
                if (e.keyCode == 27) {closePopup();}   // esc
                if (e.keyCode == 37) {jQuery('#popup-prev').click();}           // left
                if (e.keyCode == 39) {jQuery('#popup-next').click();}           // right
                if (e.keyCode == 13) {jQuery('#accept-new-category').click();e.preventDefault();}   // enter
                
    });
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
                jQuery('#input-new-category-store').focus();
        });
   
}
function clearPopupContent(){
    jQuery('#popup-content').css('display', 'none');
    jQuery('#popup').css('background-image','url(images/loading.gif');
    jQuery('#popup-content').empty();
    jQuery('#popup-content').appendTo('body');
}
function closePopup(){
    //Remove events
    $(document).unbind('keypress');
    jQuery('#shadow').css('display', 'none');
    jQuery('#popup').css('display', 'none');
    jQuery('#popup-content').css('display', 'none');
    jQuery('#popup').width('300px');
    jQuery('#popup').height('150px');
    jQuery('#popup').css('background-image','url(images/loading.gif');
    jQuery('#popup-content').empty();
    jQuery('#popup-content').appendTo('body');
}

/****************/
/* Category     */
/****************/

	
$(document).ready(function(){
    jQuery('#add-category').live("click",function(){
            innerContentAddCategory();
            loadPopup();
            jQuery('#input-new-category').focus();
    });
});


function saveCategory(){
    var new_category = jQuery('#input-new-category').val();
    jQuery.ajax({
        url: base_url+ "category/add/" + new_category,
        async: false,
            success: function(respuesta){										
                addCategory(new_category, respuesta);
        }							  
    });	
}

/* Add new DOM category */
function addCategory(new_category, new_category_id){
    if(new_category != ''){
                var ids = new Array();
                jQuery('#product_filters').append('<li><a class="button" href="#'+new_category+'" data-categoryid="'+ new_category_id +'" data-filter=".'+ new_category_id +'">'+new_category+'</a></li>');  
                var productos = $('.producto');
                for (var i = 0; i< productos.length; i++){ 
                  
                    var li =  '<li><a  href="#'+ new_category +'" data-categoryid="'+ new_category_id +'" data-filter="'+ new_category_id +'" onClick="add_product_category(' + productos[i].id + ',' +  new_category_id +')">' + new_category + '</a></li>';
                    $('#' + productos[i].id).children('.options-producto').children('.tooltip-producto-carpeta').children('.menu-tooltip-producto').children('nav').children('ul').append(li);
                }
    }
    jQuery('#product_filters li:last').css('display','none');
    jQuery('#product_filters li:last').fadeIn('slow');
    closePopup();
    jQuery('#product_filters li:last a').click(function(){ 
            var selector = $(this).attr('data-filter');
            $('#container-productos').isotope({filter: selector});
            return false;
    });
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
    $("#" + product_id).addClass(category_id.toString());
    $('.producto').children('.options-producto').fadeOut('normal');
    return success;
}

/* Add product-sesion */
function add_product_sesion(product_id, sesion_id){    
    var success = true;
    url = base_url + "product/add_product_session/" + product_id + "/" +sesion_id;
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
/****************/
/* Session      */
/****************/

	
$(document).ready(function(){
    jQuery('#add_session').live("click",function(){
            innerContentAddSession();
            loadPopup();
            jQuery('#input-new-session').focus();
    });
});


function saveSession(){
    var session_name = jQuery('#input-new-session').val();
    var url = base_url + "/session/add/" + encodeURIComponent(session_name);   
    var new_session = get_by_ajax(url, "json");
    innerContentHex(new_session.hex);
    addSession(new_session);
}

/* Add new DOM Session */
function addSession(session){
    console.log(jQuery('#container-sesiones'));
    jQuery('#container-sesiones').append(' <article class="sesion" onClick="prepare_session(' + session.id + ')"> 	<span class="sesion-title">' + session.name + '</span> 	<div class="container-avatar-sesion"> 			<img src="' + base_url + 'images/avatar_sesion.jpg" /> 	</div> 	<span class="date-sesion">'+ session.date +'</span> </article> ');
  /*  jQuery('#product_filters li:last').css('display','none');
    jQuery('#product_filters li:last').fadeIn('slow');
    closePopup();
    jQuery('#product_filters li:last a').click(function(){ 
            var selector = $(this).attr('data-filter');
            $('#container-productos').isotope({filter: selector});
            return false;
    });*/
}


/***********/
/* ISOTOPE */
/***********/

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
function inicializar_menu_tiendas(){
    $('#button-tiendas-mbf').click(function(){
        $('#menu-stores .button').removeClass('active');
        $('#button-tiendas-mbf').addClass('active');
        $('#mis-tiendas').fadeOut('normal',function(){
                $('#sidebar').animate({
                'min-height': $('#content').css('height')
                }, 5000);
                $('#tiendas-mbf').fadeIn('normal');
        });
         return false;

    });
    
    $('#button-mis-tiendas').click(function(){
        $('#menu-stores .button').removeClass('active');
        $('#button-mis-tiendas').addClass('active');       
        $('#tiendas-mbf').fadeOut('normal',function(){
            $('#mis-tiendas').fadeIn('normal');
            $('#sidebar').animate({
            'min-height': $('#content').css('height'),
            }, 5000)
        });
       
         return false;
    });
}

function tool_bar_stores_events(){
        $('.store').on("mouseenter", function(){
            $(this).children('.options-store').fadeIn('normal');
        });
        $('.store').on("mouseleave", function(){
            $(this).children('.options-store').fadeOut('normal');
        }
        );
}

function cargar_tool_tips_stores(){
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

function load_product_options(){
    $('.producto').hover(
        function(){
                $(this).children('.options-producto').fadeIn('normal')
        },
        function(){
                $(this).children('.options-producto').fadeOut('normal')
        }
    );

    /* Tooltip Carpeta */
    
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
        
    /* Tooltip Session */
    
     $('.producto-sesion').hover(
            function(){
                    $(this).parent().children('.tooltip-producto-sesion').stop().fadeIn('fast')
            },
            function(){
                    $(this).parent().children('.tooltip-producto-sesion').fadeOut('fast')
            }
    );
    $('.tooltip-producto-sesion').hover(
            function(){
                    $(this).stop().fadeIn('normal')
            },
            function(){
                    $(this).fadeOut('fast')
            }
    );
}




function close_session(){
    var url = base_url + "main/close_session";
    var respuesta = get_by_ajax(url, "text");
    document.location.href=base_url;
}

/****************/
/* Limitaciones */
/****************/

$(document).ready(function(){
    $('#input-new-session').live('keydown', function(e){
        if($(this).val().length >= 15){
            e.preventDefault();
        }
    });
    $('#input-new-category').live('keydown', function(e){
        if($(this).val().length >= 10){
            e.preventDefault();
        }
    });
});