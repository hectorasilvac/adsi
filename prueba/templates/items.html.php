<nav class="category">
    <div class="dropdown">
        <p class="dropdown__title">Departamentos</p>
        <img class="dropdown__icon" src="/images/cheuron.svg">
    </div>
    <ul class="category__list">
        <?php foreach ($categories as $category): ?>
        <li class="category__item">
            <a class="category__link" href="list?category=<?=$category->id?>"><?=$category->name?></a>
        </li>
        <?php endforeach;?>
    </ul>
    <!-- <ul class="category__list">
        <li class="category__item">
            <a class="category__link">1</a>
        </li>
    </ul> -->
</nav>

<main class="main">

    <!-- <p><?=$totalItems?> items han sido almacenados.</p> -->
    <section class="section">
        <div class="wrapper section__header">
        <h2 class="section__title">En Oferta</h2>
        <a class="section__link">Más productos</a>
        <div class="wrapper card">
            <?php foreach ($items as $item): ?>
            <article class="item">
                <p class="item__discount"></P>
                <img class="item__image" src="/photos/<?=$item->getImage()->url?>" alt="">
                <h2 class="item__name"><?=(new \Generic\Markdown($item->name))->toHtml()?></h2>
                <p class="item__save">Ahorra $5.000</p>
                <p class="item__price"><span class="item_price item__price--old-price">$19.800</span> $20.500</p>
                <p class="item__gram">Gramo a X</p>
                <input type="number" min="1" max="50">
                <button><i class='fas fa-cart-plus fa-lg'></i></button>
                <p></p>
            </article>
            <?php endforeach;?>
        </div>
    </section>


    <!-- <?php foreach ($items as $item): ?>
    <blockquote>
        <pre>
        <?php print_r($item->getImage()->url); ?>
    </pre>
        <?=(new \Generic\Markdown($item->name))->toHtml()?>
        by
        <?=(new \Generic\Markdown($item->getUser()->firstname))->toHtml()?>
        <?php if ($user): ?>
        <?php if ($user->id == $item->userId || $user->hasPermission(\Merkar\Entity\User::EDIT_ITEMS)): ?>
        <a href="edit?id=<?=$item->id?>">
            Edit</a>
        <?php endif;?>
        <?php if ($user->id == $item->userId || $user->hasPermission(\Merkar\Entity\User::DELETE_ITEMS)): ?>
        <form action="delete" method="post">
            <input type="hidden" name="id" value="<?=$item->id?>">
            <input type="submit" value="Delete">
        </form>
        <?php endif;?>
        <?php endif;?>
    </blockquote>
    <?php endforeach;?> -->

    Select page:


    <?php
    // Calculate the number of pages
    $numPages = ceil($totalItems / 10);
    // Display a link for each page
    for ($i = 1; $i <= $numPages; $i++):
        if ($i == $currentPage):
        ?>
    <a href="list?page=<?=$i?>
                        <?=!empty($categoryId) ? '&category=' . $categoryId : ''?>">
        <?=$i?></a>
    <?php else: ?>
    <a href="list?page=<?=$i?>
        <?=!empty($categoryId) ?
    '&category=' . $categoryId : ''?>">
        <?=$i?></a>
    <?php endif;?>
    <?php endfor;?>
</main>