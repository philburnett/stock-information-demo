<h1><?= $stock->getName() ?></h1>
<h2>
    <?= $stock->getTickerCode() ?>
    <?= $stock->getLatestPrice()->getAmount() ?>
    <?= $stock->getCurrencyText() ?>
</h2>

<?php if (!empty($stock->getNews())) : ?>
<ul>
<?php
$news = $stock->getNews();
for ($i=0; $i<count($news); $i++) : ?>
    <li>
        <?= $news[$i]->getHeadline() ?><a href="#" class="expand-news" id="expand-<?= $i ?>">&hellip;</a>
        <div style="display: none" id="news-<?= $i ?>"><?= $news[$i]->getBody() ?></div>
    </li>
<?php endfor; ?>
</ul>
<?php endif; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="application/javascript">
    $('.expand-news').click(function(){
        var newsId = this.id.replace('expand-', 'news-');
        $('#'+newsId).toggle();
    });
</script>
