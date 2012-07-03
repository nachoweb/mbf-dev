<div id="wellcome-content">
        <header id="header">
            <div id="container-logo">
                <h1><a href="">MY BUYFRIENDS</a></h1>
            </div>
        </header>
        <section id="login-register">
            <article id="login">
                <h3>¿Eres usuario?</h3>
                <form id="form-login" name="form-login" method="post" action="<?php echo $base_url?>/main" onSubmit="return checkLogin()">
                        <input type="text" id="login-email" name="login-email" placeholder="E-mail" />
                        <input type="password" id="login-password" name="login-password" placeholder="contraseña" />
                        <?php
                            echo "<input type='hidden' name='invitation' id='invitation' value='$invitation' />";
                        ?>
                        <input type="submit" id="login-submit" name="login-submit" value="ENTRAR" />
                        <div id="info-login-email" class="form-info-login"></div>
                </form>
            </article>
            <article id="register">
                <h3>Regístrate</h3>
                <form id="form-register" name="form-register" method="post" action="<?php echo $base_url?>/register/signup" onSubmit="return form_register_validate()" method="post">
                        <input type="hidden" id="validated-register" />
                        <input type="text" id="register-name" name="register-name" placeholder="Nombre" /><div id="info-register-name" class="form-info"></div>
                        <input type="text" id="register-surname" name="register-surname" placeholder="Apellidos" /><div id="info-register-surname" class="form-info"></div>
                        <label id="label-sex">sexo</label>
                        <input type="radio" name="gender" value="male" checked="checked"/><label>hombre</label>
                        <input type="radio" name="gender" value="female" /><label>mujer</label>
                        <input type="text" id="register-work" name="register-work" placeholder="elije una situación laboral" /><div id="info-register-work" class="form-info"></div>
                        <input type="text" id="register-email" name="register-email" placeholder="E-mail"/><div id="register-info-email" class="form-info"></div>
                        <input type="password" id="register-password1" name="register-password1" placeholder="contraseña" /><div id="register-info-password" class="form-info"></div>
                        <input type="password" id="register-password2" name="register-password2" placeholder="repetir contraseña" />
                        <?php 
                            echo "<input type='hidden' name='invitation' id='invitation' value='$invitation' />";
                        ?>
                        <input type="submit" id="register-submit" name="register-submit" value="ACEPTAR" />
                </form>
            </article>
        </section>
    </div>
</div>
