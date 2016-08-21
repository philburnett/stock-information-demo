
<h1>Companies</h1>
<h2>Click a company name to view stock data</h2>
<?php if (!empty($companies)): ?>
    <ul>
<?php foreach ($companies as $company) : ?>
        <li>
            <a href="<?= route('stock-info', ['tickerCode' => $company['tickerCode']]) ?>"><?= $company['name'] ?></a>
        </li>
<?php endforeach; ?>
    </ul>
<?php else: ?>
<p>Sorry, no companies found</p>
<?php endif; ?>
