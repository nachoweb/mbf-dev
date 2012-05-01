{
  // The id is used as a query parameter in the src of the <script> tag.
  "id": "mbf",
  "paths": ".",
  //Bootstrap de la aplicación
  "inputs": "js/app.js",
  //En produccion pondremos mode ADVANCED
  "mode":"SIMPLE",
  "level":"VERBOSE",
  "css-inputs":"gss/style.gss",
  "css-output-file":"gss/build/buildcss.css",
	"output-file":"js/build/buildapp.js",
	"externs":"externs.js",
	"define":{
		//Lo pondremos a false cuando queramos generar el archivo de producción para quitar todo el codigo que vaya en un if(goog.DEBUG)
		"goog.DEBUG":true  
	}
  
}
