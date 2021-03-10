<main>
    <section class="lot-item container">
      <h2><?=replace_specialchars($row_lot['name_lot']) ?></h2>
      <div class="lot-item__content">
        <div class="lot-item__left">
          <div class="lot-item__image">
            <img src="/uploads/<?=replace_specialchars($row_lot['id'] . '.' . replace_specialchars($row_lot['img_url']))?>" width="730" height="548" alt="<?=replace_specialchars($row_lot['name_lot']) ?>">
          </div>
          <p class="lot-item__category">Категория: <span><?=replace_specialchars($categories_arr[$row_lot['cat_id']]['cat_name'])?></span></p>
          <p class="lot-item__description"><?=replace_specialchars($row_lot['description_lot'])?></p>
        </div>
        <div class="lot-item__right">
          <div class="lot-item__state">
            <?php list($hours, $minuts) = get_expiry_time($row_lot['end_date']); ?>
            <div class="lot-item__timer timer <?php if ($hours < 1): ?>timer--finishing<?php endif;?>">
              <?php if($hours <= 0 && $minuts <= 0): ?>
                00:00
              <?php else: ?>
                <?=$hours . ":" . $minuts; ?>
              <?php endif; ?>
            </div>
            <div class="lot-item__cost-state">
              <div class="lot-item__rate">
                <span class="lot-item__amount">Текущая цена</span>
                <span class="lot-item__cost"><?=replace_specialchars(price_format($row_lot['current_price']))?></span>
              </div>
              <div class="lot-item__min-cost">
                Мин. ставка <span><?=replace_specialchars(price_format($min_bet))?></span>
              </div>
            </div>
            <?php if(isset($_SESSION['user'])): ?>
            <form class="lot-item__form" action="/lot.php?id=<?=replace_specialchars($row_lot['id'])?>" method="post" autocomplete="off">
              <p class="lot-item__form-item <?php if (count($err)): ?>form__item form__item--invalid<?php endif; ?>">
                <label for="cost">Ваша ставка</label>
                <input id="cost" type="text" name="cost" placeholder="<?=replace_specialchars(price_format($min_bet))?>">
                <span class="form__error"><?=replace_specialchars($err['cost'])?></span>
              </p>
              <button type="submit" class="button">Сделать ставку</button>
            </form>
            <?php endif; ?>
          </div>
          <div class="history">
            <h3>История ставок (<span><?=count($list_bets)?></span>)</h3>
            <table class="history__list">
              <?php foreach ($list_bets as $bet): ?>
              <tr class="history__item">
                <td class="history__name"><?=replace_specialchars($bet['user_name']) ?></td>
                <td class="history__price"><?=replace_specialchars(price_format($bet['bet_price'])) ?></td>
                <td class="history__time"><?=replace_specialchars(date('d.m.y в H:i', strtotime ($bet['add_date']))) ?><!--19.03.17 в 08:21--></td>
              </tr>
            <?php endforeach; ?>
            </table>
          </div>
        </div>
      </div>
    </section>
</main>