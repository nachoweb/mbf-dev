/* globals */
var inter = 0;
var options = {"section" : "home"};
var category_active = {"id" : 0, "name" : ""};
var st_category = "members";




  

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

function send_message(){
    var params = {      
        "session_id":   $("#new-message").attr("data-session"),
        "last"      :   $("#new-message").attr("data-last"),     
        "text"      :   $("#new-message").val()
    } 
   $.post( base_url + "messages/add", params,
    function(data){
            add_messages(data.messages);
            $("#new-message").attr("data-last", data.last_message);
    }, "json");
}

/* Event click menu */
$(document).ready(function(){
    
    activar_slider_explicacion();
    $("#menu_inicio").click(function(e){
        //e.preventDefault();
        $("#menu-sidebar .active").removeClass("active");
        $(this).addClass("active");       
        options = {"section" : "inicio"};
        /*refresh_content(options);
        activar_slider_explicacion();*/
        $("#user-options").css("display", "none");
    });
    
    $("#menu_tiendas").click(function(e){
        //e.preventDefault();
        $("#menu-sidebar .active").removeClass("active");
        $(this).addClass("active");        
        /*options = {"section" : "stores"};
        refresh_content(options);*/
        $("#user-options").css("display", "none");
    });
    
     
    
    $("#menu_mis_cosas").click(function(e){
        //e.preventDefault();    
        $("#menu-sidebar .active").removeClass("active");
        $(this).addClass("active");
       /* options = {"section" : "products"};
        refresh_content(options);*/
        mis_cosas_events();
        $("#user-options").css("display", "none");
    });
    
    $("#menu_sesiones").click(function(e){
        //e.preventDefault();
        $("#menu-sidebar .active").removeClass("active");
        $(this).addClass("active");
        /*options = {"section" : "sessions"};
        refresh_content(options);*/
        $("#user-options").css("display", "none");
    });
    
    $("#menu_bookmarklet").click(function(e){
        //e.preventDefault();
        $("#menu-sidebar .active").removeClass("active");
        $(this).addClass("active");
        /*options = {"section" : "bookmarklet"};
        refresh_content(options);*/
        activar_slider_explicacion();
        $("#user-options").css("display", "none");
    });
    
    $("#session-back a").live("click",function(e){
        //e.preventDefault();
        $("#menu_sesiones").click();
    });
    
    $("#menu_tiendas").tipsy({gravity: 'w'});
    $("#menu_sesiones").tipsy({gravity: 'w'});
});

/* Navigability */
function refresh_content(options){
    var content = "";        
    if(options.section == "inicio"){
        document.getElementById("content").innerHTML = "";
        content = get_by_ajax(base_url + "main/inicio", "text");        
        document.getElementById("content").innerHTML = content;
        window.clearInterval(inter);
        _gaq.push(['_trackPageview', '/inicio']);
    }else if(options.section == "bookmarklet"){
        document.getElementById("content").innerHTML = "";
        content = get_by_ajax(base_url + "main/steps", "text");        
        document.getElementById("content").innerHTML = content;
        window.clearInterval(inter);    
        _gaq.push(['_trackPageview', '/bookmarklet']);
    }else if(options.section == "products"){
        content = get_by_ajax(base_url + "main/products", "text");
        document.getElementById("content").innerHTML = content;
        load_product_options();
        active_isotope_products();       
        window.clearInterval(inter);
        _gaq.push(['_trackPageview', '/mis_cosas']);
    }else if(options.section == "stores"){
        content = get_by_ajax(base_url + "main/stores", "text");
        document.getElementById("content").innerHTML = content;
        tool_bar_stores_events();
        cargar_tool_tips_stores();
        inicializar_menu_tiendas();   
        active_isotope_stores();
        window.clearInterval(inter);
        _gaq.push(['_trackPageview', '/tiendas']);
    }else if (options.section == "sessions"){
        content = get_by_ajax(base_url + "main/my_sessions", "text");
        document.getElementById("content").innerHTML = content;      
        window.clearInterval(inter);
         _gaq.push(['_trackPageview', '/sesiones']);
    }else if (options.section == "session"){
        content = get_by_ajax(base_url + "main/session/" + options.session, "text");
        document.getElementById("content").innerHTML = content;
        $("#sesion-chat").animate({scrollTop: $("#sesion-chat")[0].scrollHeight}, 0);
        inter = window.setInterval(refresh_messages, 15000);
        activate_session_events();
         _gaq.push(['_trackPageview', '/sesion_'+ options.session]);
    }       
}

function mis_cosas_events(){
    
}
/*
$(document).ready(function(){
    document.onkeydown = function(){ 
        if(window.event && window.event.keyCode == 116){ 
            event.preventDefault();
            //refresh();    
        } 
        if(window.event && window.event.keyCode == 505){
            event.preventDefault();
            //refresh();
        } 
    } 
});

function refresh(){
    console.log("refresh");
    refresh_content(options);
}
*/
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

/** NOTIFICACIONES **/
$(document).ready(function(){
    if(parseInt($('#user-notification-star').text()) != 0){       
        $('#user-notifications').fadeIn(1000, function(){});
    }
});



function prepare_session(session_id, messages, products){
    options = {
        "section" : "session" ,
        "session" : session_id
    };    
    refresh_content(options);
    num_act = parseInt($('#user-notification-star').text());
    num_new = num_act -  messages - products;
    if(num_new == 0){
        $("#user-notifications").fadeOut('normal');
    }else{
        $('#user-notification-star').text(num_new);
    }        
}

/* Add message sessions */
function activate_session_events(){
    $('#new-message').keypress(function(e){       
        if(e.which == 13){
            //Paramos maquinaria
            e.preventDefault();                
                send_message();
                $(this).val("");
            //Mandamos
      /*    url = base_url + "messages/add/" + session+ "/" + text + "/" + last;  
            var respuesta = get_by_ajax(url, "json");
            add_messages(respuesta.messages);
            jQuery(this).attr("data-last", respuesta.last_message);
            //Insertamos
            message =  "<div class='sesion-message'>";
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
    
    $("#session-pliegue").click(function(e){
        
        if($("#session-slide").css("display") != "none"){
            $("#session-slide").slideUp("normal", function(){});
            $("#session-pliegue").removeClass("pliegue-up");
            $("#session-pliegue").addClass("pliegue-down");
        }else{
            $("#session-slide").slideDown("normal", function(){});
            $("#session-pliegue").removeClass("pliegue-down");
            $("#session-pliegue").addClass("pliegue-up");
           
        }
    });
    
    $("#session-title span").click(function(e){
        
    });
}


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
            innerContent(current_item);
            loadPopup();  
    });
    $('#shadow').click(function(){
           
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
    popup_content += '			<span id="popup-brand"><a href="'+ link +'" target="_blank">'+brand+'</a></span>';
    popup_content += '		</div>';
    popup_content += '		<div id="popup-description">'+description+'</div>';
    popup_content += '		<div id="popup-social">';
    popup_content += '              <a href="#" onclick="show_sorry_msn();return false;"><div id="popup_facebook"></div></a>';
    popup_content += '              <a href="#" onclick="show_sorry_msn();return false;"><div id="popup_twitter"> </div></a>';
    popup_content += '		</div>';
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
    popup_content += '		<label>Título:</label><label id="session-message"></label>';
    popup_content += '		<input type="text" id="input-new-session" name="input-new-session" class="input-new-category"/>';
    popup_content += '		<input type="button" id="accept-new-category" name="accept-new-session" class="button" value="Añadir" onClick="saveSession()" />';
    popup_content += '		<input type="button" id="cancel-new-session" name="cancel-new-session" class="button" value="Cancelar" onClick="closePopup()" />';
    popup_content += '	</form>';
    popup_content += '	</div>';
    $('#popup-content').append(popup_content);
}

function innerContentRemoveProduct(product_id){
    jQuery('#popup-content').empty();
    var popup_content = '<div>';
    popup_content += '<form name="form-add-new-category" class="form-add-new-category" method="post">';
    popup_content += '		<div><label> ¿Deseas eliminar este producto de todas tus carpetas de forma permanente?<br/</label></div><br/>';
    popup_content += '		<input type="button"  class="button" value="Si" onClick="remove_product('+ product_id + ')" />';
    popup_content += '		<input type="button" id="cancel-new-category" name="cancel-new-category" class="button" value="No" onClick="closePopup()" />';
    popup_content += '	</form>';
    popup_content += '	</div>';
    $('#popup-content').append(popup_content);
}

function innerContentBaja(){
    jQuery('#popup-content').empty();
    var popup_content = '<div>';
    popup_content += '<form name="form-add-new-category" class="form-add-new-category" method="post">';
    popup_content += '		<div><label> ¿Estás seguro que deseas darte de baja de MybuyFriends?<br/</label></div><br/>';
    popup_content += '		<input type="button"  class="button" value="Si" onClick="darse_baja()" />';
    popup_content += '		<input type="button" id="cancel-new-category" name="cancel-new-category" class="button" value="No" onClick="closePopup()" />';
    popup_content += '	</form>';
    popup_content += '	</div>';
    $('#popup-content').append(popup_content);
}

function innerContentRemoveCatProduct(product_id, category_id, category_name){
    jQuery('#popup-content').empty();
    var popup_content = '<div>';
    popup_content += '<form name="form-add-new-category" class="form-add-new-category" method="post">';
    popup_content += '		<div><label>Este producto se borrará solo de tu carpeta "'+ category_name +'" <br/>¿Continuar?</label></div><br/>';
    popup_content += '		<input type="button"  class="button" value="Si" onClick="remove_product_category('+ product_id + ','+ category_id +')" />';
    popup_content += '		<input type="button" id="cancel-new-category" name="cancel-new-category" class="button" value="No" onClick="closePopup()" />';
    popup_content += '	</form>';
    popup_content += '	</div>';
    $('#popup-content').append(popup_content);
}

function innerContentImSorry(){
    jQuery('#popup-content').empty();
    var popup_content = '<div>';
    popup_content += '<form name="form-add-new-category" class="form-add-new-category" method="post">';
    popup_content += '		<div><label> Ups!. Lo sentimos, este operación aún no está disponible.<br/</label></div><br/>';
    popup_content += '		<input type="button"  class="button" value="Aceptar" onClick="closePopup()" />';
   
    popup_content += '	</form>';
    popup_content += '	</div>';
    $('#popup-content').append(popup_content);
}



function innerContentHex(hex){
    jQuery('#popup-content').empty();
    var popup_content = '<div class="form-add-new-category">';
    popup_content += "<p>Para invitar un amigo, copia y envíale este link: </p>";   
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
                jQuery('#input-new-session').focus();
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

function show_link_session(hex){
    innerContentHex(hex);
    loadPopup();
}

/* Add new DOM Session */
function addSession(session){
jQuery('#container-sesiones').append('<article class="sesion" onclick="prepare_session(' + session.id + ',0,0)"> <div class="sessions-left"><div class="sessions-nick"><span class="pendiente">pendiente...</span> </div> <div class="sessions-left-bottom"> <div class="sesion-title"> ' + session.name + ' </div> <div class="date-sesion"> 				' + session.date + ' </div> </div> 	</div> 	<div class="sessions-right"> 		<!-- NOTIFICACIONES DE MENSAJES --> 		<div class="contenedor_not_mensajes_0"> 			<div class="not-messagess"></div> 		</div> 		<!-- NOTIFICACIONES DE PRODUCTOS --> <div class="contenedor_not_products_0"> <div class="not-products"></div> </div> 	</div> </article>');    
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
            category_active.id = $(this).attr('data-categoryid');
            category_active.name = $(this).attr('data-name');
            $('#container-productos').isotope({filter: selector});
            $('#menu-productos a').removeClass("active");
            $(this).addClass("active");
            return false;
    });
}

/* Stores */

function active_isotope_stores(){
    // filter items when filter link is clicked  
     $('#container-stores').isotope({
        // options
        itemSelector : '.store',
        layoutMode : 'fitRows'
    });    
    click_st_category_filters();
}


function click_st_category_filters(){
    $('#stores_filters a').click(function(){ 
            /* BBQ */
            var href = $(this).attr('href').replace( /^#/, '' ),
                // convert href into object
                // i.e. 'filter=.inner-transition' -> { filter: '.inner-transition' }
                option = $.deparam( href, true );
            // set hash, triggers hashchange on window
            $.bbq.pushState( option );
            
            var element = $(this);
            $(".button-small").removeClass("active");
             $('#button-mis-tiendas').removeClass("active");
            element.addClass("active");
            if(st_category == "mis_tiendas"){
                st_category = "members";
                $('.menu-stores .button').removeClass('active');
                element.addClass('active');
                $('#mis-tiendas').fadeOut('slow',function(){
                        var selector = element.attr('data-filter');
                        $('#container-stores').isotope({filter: selector});
                        $('.menu-stores .button').removeClass('active');
                        element.addClass('active');    
                        $('#sidebar').animate({
                        'min-height': $('#content').css('height')
                        }, 5000);
                        $('#tiendas-mbf').fadeIn('slow',function(){
                            
                        });               
                    });                    
            }else{                
                var selector = $(this).attr('data-filter');
                $('#container-stores').isotope({filter: selector});
                $('.menu-stores .button').removeClass('active');
                $(this).addClass('active');  
            }
            if(element.attr("id") == "st-menu-moda"){
                $('#submenu-moda').fadeIn('slow');
                $('#submenu-moda a').removeClass("active");
                $("#submenu-todo").addClass("active");
            }else{
                $('#submenu-moda').fadeOut('slow');
            }  
           return false;
    });
    
    $('#submenu-moda a').click(function(){ 
            /* BBQ */
            var href = $(this).attr('href').replace( /^#/, '' ),
                // convert href into object
                // i.e. 'filter=.inner-transition' -> { filter: '.inner-transition' }
                option = $.deparam( href, true );
            // set hash, triggers hashchange on window
            $.bbq.pushState( option );
            
          var selector = $(this).attr('data-filter');
          $('#container-stores').isotope({filter: selector});
          $('#submenu-moda a').removeClass('active');
          $(this).addClass('active');   
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
        $('.menu-stores .button').removeClass('active');
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
       
        // set hash, triggers hashchange on window
        $.bbq.pushState( {"section" : "tiendas", "cat" : "mis_tiendas"} );
        st_category = "mis_tiendas";
        $('.button-small').removeClass('active');        
        $('#button-mis-tiendas').addClass('active');  
        $('#submenu-moda').fadeOut('normal');
        $('#tiendas-mbf').fadeOut('normal',function(){
            $('#mis-tiendas').fadeIn('normal');
           /* $('#sidebar').animate({
            'min-height': $('#content').css('height')
            }, 5000)*/
        });       
         return false;
    });
}

function tool_bar_stores_events(){
     /*   $('.store').on("mouseenter", function(){
            $(this).children('.options-store').fadeIn('normal');
        });
        $('.store').on("mouseleave", function(){
            $(this).children('.options-store').fadeOut('normal');
        }
        );*/
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
                $(this).children('.options-producto').fadeIn('normal');
                $(this).children('.delete-product').fadeIn('normal');
        },
        function(){
                $(this).children('.options-producto').fadeOut('normal')
                $(this).children('.delete-product').fadeOut('normal');
        }
    );

    /* Tooltip Carpeta */
    
    $('.producto-carpeta').hover(
            function(){
                    var element = $(this).parent().children('.tooltip-producto-carpeta');
                    element.stop().fadeIn('fast');
                    if(element.height() > 240){
                        element.css("max-height", "216px");
                        element.css("overflow-y", "scroll");
                        element.css("overflow-x", "hidden");
                        element.css("width", "135px");
                        element.css("left", "28px");
                    }
            },
            function(){
                    $(this).parent().children('.tooltip-producto-carpeta').fadeOut('fast');
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
                   
                    element = $(this).parent().children('.tooltip-producto-sesion');
                    element.stop().fadeIn('fast');
                    if(element.height() > 240){
                        element.css("max-height", "216px");
                        element.css("overflow-y", "scroll");
                        element.css("overflow-x", "hidden");
                        element.css("width", "135px");
                        element.css("left", "28px");
                    }
            },
            function(){
                    $(this).parent().children('.tooltip-producto-sesion').fadeOut('fast');
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
        
   /* Remove products */
    $(".delete-product").click(function (event){
        var producto_id = $(this).parent().attr("id");
        if(category_active.id == 0){
            innerContentRemoveProduct(producto_id)
            loadPopup();
        }else{
            innerContentRemoveCatProduct(producto_id, category_active.id, category_active.name);
            loadPopup();         
        }
        //console.log($(this).parent().attr("id"));
        //console.log(category_active);
       
       
   });
}

function remove_product(product_id){
   $('#container-productos').isotope( 'remove', $("#" + product_id), function(){} );
   get_by_ajax(base_url + "/product/remove_product/" + product_id, "text");
   closePopup();
}

function remove_product_category(product_id, category_id ){   
   //$('#container-productos').isotope( 'remove', $("#" + product_id), function(){} );
   get_by_ajax(base_url + "/product/remove_product_category/" + product_id + "/" + category_id, "text");
   $("#" + product_id).removeClass(category_id.toString());
   $('#container-productos').isotope({filter: '.' + category_id});
   closePopup();
}

function remove_product_session(session_id, product_id){
    
}


function close_session(){    
    var url = base_url + "main/close_session";
    console.log(url);
    jQuery.ajax({
        url: url,
        async: false,
        dataType: "text",
        success: function(respuesta){										
            document.location.href=base_url;
        },
        error: function(error){
            r = error;
            console.log(r);
        }
    });	    
}

/******************/
/* Limitaciones  **/
/******************/

$(document).ready(function(){
    $('#input-new-session').live('keydown', function(e){
        if($(this).val().length >= 15){
            if(e.keyCode!= 13 &&  e.keyCode!= 8 && e.keyCode!= 46 && e.keyCode!= 37 && e.keyCode!= 39 && e.keyCode!= 27 ){
                e.preventDefault();
            }
        }
    });
    $('#input-new-category').live('keydown', function(e){
        if($(this).val().length >= 10){
             if(e.keyCode!= 13 &&  e.keyCode!= 8 && e.keyCode!= 46 && e.keyCode!= 37 && e.keyCode!= 39 && e.keyCode!= 27 && e.keyCode!= 9){
                e.preventDefault();
            }
        }
    });
    $('#register-date').live('keydown', function(e){
        if($(this).val().length >= 4){
             if(e.keyCode!= 13 &&  e.keyCode!= 8 && e.keyCode!= 46 && e.keyCode!= 37 && e.keyCode!= 39 && e.keyCode!= 27 && e.keyCode!= 9){
                e.preventDefault();
            }
        }
    });
    
    $("#nick").live('keydown', function(e){
         if($(this).val().length >= 10){
             if(e.keyCode!= 13 &&  e.keyCode!= 8 && e.keyCode!= 46 && e.keyCode!= 37 && e.keyCode!= 39 && e.keyCode!= 27 && e.keyCode!= 27 && e.keyCode!= 9 ){
                e.preventDefault();
            }
        }
    });
    
});


function show_conditions(){
    
    myRef = window.open('condiciones','mywin',
'left=20,top=20,width=900,height=500,toolbar=1,resizable=0');
myRef.focus()
}


function darse_baja(){
    get_by_ajax(base_url + "register/delete_user", "text");
    closePopup();
    window.location.reload();
}



/* User options */

$(document).ready(function(){
    $("#nick").click(function(e){        
      toggle_menu_user()
    });
    
    $("#user-options").mouseleave( function(e){
        $("#user-options").css("display", "none");
} );
});

function toggle_menu_user(){
    if($("#user-options").css("display") == "none"){
        $("#user-options").css("display", "block");
    }else{
        $("#user-options").css("display", "none");
    }       
}

function show_sorry_msn(){
    innerContentImSorry();
     showPopupContent();
}

/********/
/* BBQ  */
/********/

$(function(){
  
  // Keep a mapping of url-to-container for caching purposes.
  var cache = {};
  
  // Bind an event to window.onhashchange that, when the history state changes,
  // gets the url from the hash and displays either our cached content or fetches
  // new content to be displayed.
  $(window).bind( 'hashchange', function(e) {
    
    // Get the hash (fragment) as a string, with any leading # removed. Note that
    // in jQuery 1.4, you should use e.fragment instead of $.param.fragment().
    var url = $.bbq.getState();
    console.log(url);
   
    $("#menu-sidebar a").removeClass("active");
    // Add .bbq-current class to "current" nav link(s), only if url isn't empty.
    if(!url.section ) {url = {"section" : "inicio"}}

    $( 'a[href="#section=' + url.section + '"]' ).addClass( 'active' );
    
    if ( cache[ url ] ) {
      // Since the element is already in the cache, it doesn't need to be
      // created, so instead of creating it again, let's just show it!
      cache[ url ].show();      
    } else {       
      // Show "loading" content while AJAX content loads.
      //$( '.bbq-loading' ).show();
      
      // Show "loading" content while AJAX content loads.
        if(url.section == "inicio"){
            options = {"section" : "inicio"};
            refresh_content(options);
        }else if (url.section == "mis_cosas"){
            options = {"section" : "products"};
            refresh_content(options);
        }else if(url.section == "tiendas"){
            if(!url.cat){
                options = {"section" : "stores"};
                refresh_content(options);
            }
        }else if(url.section == "sessions"){
            options = {"section" : "sessions"};
            refresh_content(options);
        }else if(url.section == "session"){
            var session = $("#session_" + url.id);            
            var messages = session.attr("data-messages");
            var products = session.attr("data-products"); 
            _kmq.push(['record', 'Conversion']);
            prepare_session( url.id, messages, products)
        }else if(url.section == "bm"){
            console.log("BM");
            options = {"section" : "bookmarklet"};
            refresh_content(options);
        }
        
      // Create container for this url's content and store a reference to it in
      // the cache.
      /*
      cache[ url ] = $( '<div class="bbq-item"/>' )
        
        // Append the content container to the parent container.
        .appendTo( '.bbq-content' )
        
        // Load external content via AJAX. Note that in order to keep this
        // example streamlined, only the content in .infobox is shown. You'll
        // want to change this based on your needs.
        .load( url, function(){
          // Content loaded, hide "loading" content.
          $( '.bbq-loading' ).hide();
        });*/
    }
  })
  
  // Since the event is only triggered when the hash changes, we need to trigger
  // the event now, to handle the hash the page may have loaded with.
  $(window).trigger( 'hashchange' );
  
});

