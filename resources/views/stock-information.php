<?php require_once(__DIR__ . '/header.php'); ?>
<div class="container">
    <div class="col-lg-8">
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
                for ($i = 0; $i < count($news); $i++) : ?>
                    <?php
                    $sentimentEmoticon = ':-|';
                    if ($news[$i]->getSentiment() > 2) {
                        $sentimentEmoticon = ':-)';
                    }

                    if ($news[$i]->getSentiment() < 0) {
                        $sentimentEmoticon = ':-(';
                    }
                    ?>
                    <li>
                        <span class="lead">
                            <a href="#" class="expand-news" id="expand-<?= $i ?>"><?= $news[$i]->getHeadline() ?>&hellip;</a>
                        </span>
                        <div class="rotate"><?= $sentimentEmoticon ?></div>
                        <div style="display: none" id="news-<?= $i ?>"><?= $news[$i]->getBody() ?></div>
                    </li>
                <?php endfor; ?>
            </ul>
        <?php else : ?>
            <p>No news stories available.</p>
        <?php endif; ?>
        <script type="application/javascript">
            $('.expand-news').click(function () {
                var newsId = this.id.replace('expand-', 'news-');
                $('#' + newsId).toggle();
            });
        </script>
    </div>
    <p><a href="<?= route('companies') ?>">Back to company list</a></p>
</div>
<?php require_once(__DIR__ . '/footer.php'); ?>
