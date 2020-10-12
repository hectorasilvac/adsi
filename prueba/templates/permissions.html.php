<h2>Edit <?=$user->firstname?>’s Permissions</h2>
<form action="" method="post">
    <?php foreach ($permissions as $name => $value): ?>
    <div>
    <input name="permissions[]" 
        type="checkbox" 
        value="<?=$value?>" 
        <?php if ($user->hasPermission($value)): 
        echo 'checked'; endif; ?> />
    <label><?=$name?>
    </div>
    <?php endforeach; ?>
    <input type="submit" value="Submit" />
</form>