<?php if(empty($item->id) || $user->id == $item->userId || $user->hasPermission(\Merkar\Entity\User::EDIT_ITEMS)): ?> 
<form action="" method="post">
    <input type="hidden" name="item[id]" 
    value="<?=$item->id ?? '';?>">
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="item[name]" 
    value="<?=$item->name ?? '';?>">
    <label for="userId">Cliente:</label>
    <input type="text" id="userId" name="item[userId]" 
    value="<?=$item->userId ?? '';?>">

    <p>Selecciona una categoría para este producto:</P>
    <?php foreach ($categories as $category): ?>
    <?php if ($item && $item->hasCategory($category->id)): ?>
    <input type="checkbox" checked name="category[]" value="<?=$category->id?>"/>
    <?php else: ?>
    <input type="checkbox" name="category[]" value="<?=$category->id?>"/>
    <?php endif; ?>
    <label><?=$category->name?></label>
<?php endforeach; ?>
    <input type="submit" name="submit" value="Save">
</form>
<?php else: ?>
<p>You may only edit jokes that you posted.</p>
<?php endif; ?>