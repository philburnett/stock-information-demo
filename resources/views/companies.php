<?php require_once(__DIR__ . '/header.php'); ?>
<div class="container">
    <h1>Companies</h1>
    <h2>Click a company name to view stock data</h2>
    <?php if (!empty($companies)): ?>
        <ul>
            <?php foreach ($companies as $company) : ?>
                <li>
                    <a class="lead" href="<?= route(
                        'stock-info', ['tickerCode' => $company['tickerCode']]
                    ) ?>"><?= $company['name'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Sorry, no companies found</p>
    <?php endif; ?>
</div>
<?php require_once(__DIR__ . '/footer.php'); ?>
