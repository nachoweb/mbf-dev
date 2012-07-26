<!doctype html>
<html>
	<head lang="es">
		<title>Mybuyfriends</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="<?php echo $site_url;?>/css/style.css">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<!-- Script Slider -->		
		<script type="text/javascript">
			$(document).ready(function(){
				var slider_width = $('.slider-register-container').width();
				var current_item = 0;
				$('#nav-slider-register .nav-item-register').click(function (){
					if($(this).attr('id') == 'slider-left'){
						if (current_item > 0){
							current_item--;
                                                        console.log(current_item);
                                                }
                                                if(current_item==1){
                                                    jQuery("#slider-right").css("display","inline");
                                                    jQuery("#start").css("display","none");
                                                }
					}
					else if($(this).attr('id') == 'slider-right'){						
						if (current_item < $('.slider-register-item').length-1){
							current_item++;
                                                }
                                                if(current_item==2){
                                                   jQuery("#slider-right").css("display","none");
                                                   jQuery("#start").css("display","inline");
                                                }
					}
					$('.slider').animate({	'left' : -current_item * slider_width	});
				});
                                
                                jQuery("#start").click(function(){
                                    document.location.href="<?php echo $site_url ?>/main";
                                });
			});
		</script>
	</head>
	<body>
		
				<div id="bg-header">
                                    <header id="header">
                                        <div id="container-logo">
                                            <h1><a href=""><img id="logo" src="<?php echo $site_url ?>images/logotipo.png" alt="Mybuyfriends" /></a></h1>
                                            <?php 
                                                if($close_session){
                                            ?>
                                            <div id="close-session">
                                                <a href="#" onClick="close_session()" > Cerrar sesión </a>
                                            </div>
                                            <?php
                                                }
                                            ?>
                                        </div>

                                    </header>
                                </div>
            <div id="page">
				<div id="content-register">
					<section class="slider-register-container">
						<section class="slider">
						<section id="register-2"  class="slider-register-item">
                                                    <div id="register-2-center">
								<section id="what-is">
									<header class="register-title">
										<span class="register-step">
										1.
										</span>
										<span class="register-title">
										¿Qué es MyBuyFriends?	
										</span>
									</header>
									<div class="register-description">
										Es una herramienta para almacenar los productos que encuentres navegando por internet.
									</div>						
								</section>
								<section id="how-works">
									<header class="register-title">
										<span class="register-step">
										2.
										</span>
										<span class="register-title">
										¿Cómo Funciona?
										</span>
									</header>
									<div class="register-description">
										<div id="register-2-description">
											Es muy fácil, instala este botón simplemente arrastrándolo a tu navegador como ves en la pantalla de abajo
										</div>
										<div id="register-2-button">
											<img src="<?php echo $site_url;?>/images/register/arrow.png">
											<div id="register-bookmarklet"> <a href="javascript:void((function(){window.mbfUser='<?php echo $hex; ?>';var mbfBookmarklet=document.createElement('script');mbfBookmarklet.setAttribute('type','text/javascript');mbfBookmarklet.setAttribute('src','<?php echo $script_bm ?>?' + Math.random() * 9999999);document.getElementsByTagName('head')[0].appendChild(mbfBookmarklet);})());">MBF</a> </div> 

										</div>
									</div>
									<div id="register-2-screen1">
										<img src="<?php echo $site_url;?>/images/register/imagen1.jpg">
									</div>
								</section>
                                                    </div> <!-- END REGISTER-2-CENTER -->
							</section><!-- END ITEM1 -->
							<section id="register-3"  class="slider-register-item">
								<div id="register-3-top">
									<section id="register-step-3">
										<header class="register-title">
											<span class="register-step">
											3.
											</span>
											<span class="register-title">
											¡Ya estás listo para navegar!
											</span>
										</header>
										<div class="register-description">
											Navega por tus tiendas como lo harías normalmente
										</div>	
										<div class="register-3-img">
											<img src="<?php echo $site_url;?>/images/register/imagen2.jpg" id="register-imagen2">
										</div>
									</section>
									<section id="register-step-4">
										<header class="register-title">
											<span class="register-step">
											4.
											</span>
											<span class="register-title">
											¿Cómo uso el botón?
											</span>
										</header>
										<div class="register-description">
											Si encuentras algo que te gusta, simplemente pulsa el botón que instalaste en el navegador
										</div>	
										<div class="register-3-img">
											<img src="<?php echo $site_url;?>/images/register/imagen3.jpg">
										</div>
									</section>
								</div> <!-- END #register-3-top -->
								<div id="register-3-bottom">
									<section id="register-step-5">
										<header class="register-title">
											<span class="register-step">
											5.
											</span>
											<span class="register-title">
											Pulsa el botón para enviar
											</span>
										</header>
										<div class="register-description">
											La imagen del producto aparecerá resaltada, pulsa sobra la que te interese
										</div>	
										<div class="register-3-img">
											<img src="<?php echo $site_url;?>/images/register/imagen5.jpg">
										</div>
									</section>
									<section id="register-step-6">
										<header class="register-title">
											<span class="register-step">
											6.
											</span>
											<span class="register-title">
											Rellena los campos si quieres o dale a enviar directamente
											</span>
										</header>
										<div class="register-description">
											
										</div>	
										<div class="register-3-img">
											<img src="<?php echo $site_url;?>/images/register/imagen5.jpg">
										</div>
									</section>
								</div>
							</section> <!-- END ITEM 3 -->
							<section id="register-4"  class="slider-register-item">
								<header class="register-title">
									<span class="register-step">
									7.
									</span>
									<span class="register-title">
									¡Listo! Tu producto ya está guardado y puedes volver a verlo cuando quieras entrando en
									Mybuybriends.com
									</span>
								</header>
								<img src="<?php echo $site_url;?>/images/register/imagen6.jpg">
								<div id="last-menssage">
									<span class="register-title">
										Recuerda, todo esto es privado así que nadie puede ver lo que has guardado, salvo que tu quieras compartirlo
									</span>
								</div>
							</section> <!-- END ITEM 4 -->
						</section>  <!-- END slider -->
					</section> <!-- END slider container -->
					<nav id="nav-slider-register">	 	
						<ul class="nav-list">
							<li class="nav-item-register" id="slider-left">Anterior</li>
							<li class="nav-item-register" id="slider-right">Siguiente</li>
                                                        <li class="nav-item-register" id="start">Empezar</li>
						</ul>
					</nav>
				</div>
			</div> <!-- END PAGE -->
	</body>
</html>