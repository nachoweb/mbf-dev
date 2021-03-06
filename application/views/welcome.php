<div id="wellcome-content">
        <section id="login-register">
            <article id="login">
                <h3>¿Eres usuario?</h3>
                <form id="form-login" name="form-login" method="post" action="<?php echo $base_url?>/pasarela" onSubmit="return checkLogin()">
                        <input type="text" id="login-email" name="login-email" placeholder="E-mail" />
                        <input type="password" id="login-password" name="login-password" placeholder="contraseña" />
                        <?php
                            echo "<input type='hidden' name='invitation' id='invitation' value='$invitation' />";
                        ?>
                        <br/>
                        <input type="submit" class="button" id="login-submit" name="login-submit" value="ENTRAR" />
                        <div id="info-login-email" class="form-info-login"></div>
                </form>
                <fb:login-button perms='email' onlogin='window.location="https://graph.facebook.com/oauth/authorize?client_id=342711485817226&redirect_uri=http://www.mybuyfriends.com/dev/main/checkFb&amp;r="+window.location.href;'></fb:login-button>
              
            </article>
            <article id="register">
                <h3>Regístrate</h3>
                <form id="form-register" name="form-register" method="post" action="<?php echo $base_url?>/register/signup" onSubmit="return form_register_validate()" method="post">
                        <input type="hidden" id="validated-register" />
                        <input type="text" id="register-name" name="register-name" placeholder="Nombre" /><div id="info-register-name" class="form-info"></div>
                        <input type="text" id="register-surname" name="register-surname" placeholder="Apellidos" /><div id="info-register-surname" class="form-info"></div><br/>
                        <input type="text" id="register-date" name="register-date" placeholder="Año de nacimiento (aaaa)" /><div id="info-register-date" class="form-info"> </div><br/>
                        <label id="label-sex">sexo</label>
                        <input type="radio" name="gender" value="male" checked="checked"/><label>hombre</label>
                        <input type="radio" name="gender" value="female" /><label>mujer</label><br/><br/>
                        <input type="text" id="nick" name="nick" placeholder="Nick" /><div id="info-nick" class="form-info"></div>
                        <input type="text" id="register-email" name="register-email" placeholder="E-mail"/><div id="register-info-email" class="form-info"></div>
                        <input type="password" id="register-password1" name="register-password1" placeholder="contraseña" /><div id="register-info-password" class="form-info"></div>
                        <input type="password" id="register-password2" name="register-password2" placeholder="repetir contraseña" /><br/>
                        <input type="checkbox" name="conditions" id="conditions" value="conditions"> <span id="conditions-span">Acepto las <a href="#" onClick="show_conditions();"> condiciones de uso </a> </span><div id="info-register-condiciones" class="form-info"></div>
                        <br/><br/>
                        <?php 
                            echo "<input type='hidden' name='invitation' id='invitation' value='$invitation' />";
                        ?>
                        <input type="submit" class="button" id="register-submit" name="register-submit" value="ACEPTAR" />
                </form>
            </article>
        </section>
    </div>
</div>
