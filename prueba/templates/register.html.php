<?php
if (!empty($errors)) :
    ?>
    <div class="errors">
        <p>Your account could not be created,
         please check the following:</p>
        <ul>
        <?php
            foreach ($errors as $error) :
                ?>
                <li><?= $error ?></li>
                <?php
            endforeach; ?>
        </ul>
    </div>
<?php
endif;
?>

<form action="" method="post">
<label for="email">Your email address</label>
<input name="customer[email]" id="email" type="text" value="<?=$customer['email'] ?? ''?>">
<label for="name">Your name</label>
<input name="customer[firstname]" id="firstname" type="text" value="<?=$customer['firstname'] ?? ''?>">
<label for="password">Password</label>
<input name="customer[password]" id="password"
    type="password" value="<?=$customer['password'] ?? ''?>">
<input type="submit" name="submit" 
    value="Register account">
</form>