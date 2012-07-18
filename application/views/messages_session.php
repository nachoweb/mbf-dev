 <?php foreach ($messages as $message){  ?>
        <div class="sesion-message">
            <div class="sesion-message-left">
                    <span class="sesion-message-name"><?php echo $message->nick ?></span>
                    <span class="sesion-message-time">16:00h</span>
            </div>
            <div class="sesion-message-right">
                    <p class="sesion-message-text">
                            <?php echo $message->text ?>
                    </p>
            </div>
        </div>        
<?php }   ?>		