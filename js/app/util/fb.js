var edn_fb = {
  config :{
  // CONFIG VARS: 

    app_id : '342711485817226', 

    use_xfbml : true,

    extendPermissions : 'publish_stream' , 
    // info: http://developers.facebook.com/docs/reference/api/permissions/

    locale : 'es_ES' 
    // all locales in: http://www.facebook.com/translations/FacebookLocales.xml

  // END CONFIG VARS
  },
  perms : [],
  hasPerm : function (perm) { for(var i=0, l=edn_fb.perms.length; i<l; i++) { if(edn_fb.perms[i] == perm) {return true;}} return false; },
  logged : false,
  user : false, // when login, is a user object: http://developers.facebook.com/docs/reference/api/user
  login : function (callback){
    FB.login(function(r) {
      if (r.status == 'connected') {
        FB.api('/me/permissions',function(perm){
          edn_fb.logged = true;
		  edn_fb.perms = [];
		  for(i in perm.data[0])
		  {
			if (perm.data[0][i] == 1)
			{
				edn_fb.perms.push(i);
			}
		  }
        });	   
		edn_fb.getUser(callback);
      } else {
        edn_fb.logged = false;
        edn_fb.perms = [];
		callback();
      }
    },{scope:edn_fb.config.extendPermissions});
    return false;
  },
  syncLogin : function (callback){
    if (!callback) callback = function(){};
    FB.getLoginStatus(function(r) {
      if (r.status == 'connected' ) { 
        FB.api('/me/permissions',function(perm){
          edn_fb.logged = true;
		  edn_fb.perms = [];
		  for(i in perm.data[0])
		  {
			if (perm.data[0][i] == 1)
			{
				edn_fb.perms.push(i);
			}
		  }
        });	   
        edn_fb.getUser(callback);
        return true; 
      } else {
        edn_fb.logged = false;
        callback();
        return false;
      }
    });
  },
  logout : function(callback) {FB.logout(callback);},
  getUser : function(callback){
    FB.api('/me', function(r){
      var user = r;
      user.picture = "https://graph.facebook.com/"+user.id+"/picture";
      edn_fb.user=user; callback(user); 
    }); 
  },
  publish : function (publishObj,callback,noReTry) {
  // publishObj: http://developers.facebook.com/docs/reference/api/post   
    if (edn_fb.logged && edn_fb.hasPerm('publish_stream'))
    { 
      FB.api('/me/feed', 'post', publishObj, function(response) {
      if (!response || response.error) {
        callback(false);
      } else {
        callback(true);
      }
      });
      return true;
    }
    else
    { 
      if (!noReTry)
      	return edn_fb.login(function() { return edn_fb.publish(publishObj,callback,1)});
      else
      {
        callback(false);
        return false;
      }
    }
  },
  readyFuncs : [],
  ready: function(func){edn_fb.readyFuncs.push(func)},
  launchReadyFuncs : function () {for(var i=0,l=edn_fb.readyFuncs.length;i<l;i++){edn_fb.readyFuncs[i]();};}
}
window.fbAsyncInit = function() { 
  if (edn_fb.config.app_id) FB.init({appId: edn_fb.config.app_id, status: true, cookie: true, xfbml: edn_fb.config.use_xfbml});
  edn_fb.syncLogin(edn_fb.launchReadyFuncs);
};
var oldload = window.onload;
window.onload = function() {
  var d = document.createElement('div'); d.id="fb-root"; document.getElementsByTagName('body')[0].appendChild(d);
  var e = document.createElement('script'); e.async = true; e.src = document.location.protocol + '//connect.facebook.net/'+edn_fb.config.locale+'/all.js';
  document.getElementById('fb-root').appendChild(e);
  if (typeof oldload == 'function') oldload();
};