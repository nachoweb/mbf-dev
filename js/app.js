goog.provide('mbf.bootstrap');

goog.require('mbf.test.tmpl');


/**
 * Funcion que inicializa la aplicación.
 * Será llamada en el evento onload
 */
mbf.bootstrap=function(){

	console.log("Aplicación arrancada");
	document.getElementById("body").innerHTML=mbf.test.tmpl.test({testnum:4});

};

goog.exportSymbol('mbf.bootstrap', mbf.bootstrap);
