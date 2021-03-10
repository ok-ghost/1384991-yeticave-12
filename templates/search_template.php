<main class="container">
  <section class="lots">
    <h2><?php if (empty($_GET['search'])): ?>Вы ввели пустой запрос<?php elseif (!$searchResult): ?>По вашему запросу ничего не найдено
      <?php else: ?>Результаты поиска по запросу «<span><?=my_htmlspecialchars($_GET['search']) ?></span>»<?php endif; ?></h2>
    <?php if (!empty($_GET['search'])): ?>
    <ul class="lots__list">
      <?php foreach ($searchResult as $item): ?>
        <?php list($hours, $minuts) = get_expiry_time($item['end_date']); ?>
        <li class="lots__item lot">
          <div class="lot__image">
            <img src="/uploads/<?=my_htmlspecialchars($item['id'] . '.' . my_htmlspecialchars($item['img_url'])) ?>" width="350" height="260" alt="<?=my_htmlspecialchars($item['name_lot']) ?>">
          </div>
          <div class="lot__info">
            <span class="lot__category"><?=my_htmlspecialchars($item['cat_name']) ?></span>
            <h3 class="lot__title"><a class="text-link" href="/lot.php?id=<?=my_htmlspecialchars($item['id'])?>"><?=my_htmlspecialchars($item['name_lot']) ?></a></h3>
            <div class="lot__state">
              <div class="lot__rate">
                <span class="lot__amount">Стартовая цена</span>
                <span class="lot__cost"><?=my_htmlspecialchars(price_format($item['start_price'])) ?></span>
              </div>
              <div class="lot__timer timer <?php if ($hours < 1): ?>timer--finishing<?php endif;?>">
                <?php if($hours <= 0 && $minuts <= 0): ?>
                  00:00
                  <?php else: ?>
                  <?=my_htmlspecialchars($hours . ":" . $minuts); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  </section>
  <ul class="pagination-list">
    <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
    <li class="pagination-item pagination-item-active"><a>1</a></li>
    <li class="pagination-item"><a href="#">2</a></li>
    <li class="pagination-item"><a href="#">3</a></li>
    <li class="pagination-item"><a href="#">4</a></li>
    <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
  </ul>
</main>