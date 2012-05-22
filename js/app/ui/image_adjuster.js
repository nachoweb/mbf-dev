$(document).ready(function(){
        $('.image-fit').css('visibility','hidden');
});

function fit(el, w, h){
        <!-- si width o height no están definidos se toman del padre
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