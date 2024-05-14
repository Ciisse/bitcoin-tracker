<?php
$endpoint = "https://api.binance.com/api/v3/ticker/price?symbol=BTCUSDT";
$response = file_get_contents($endpoint);
$data = json_decode($response, true);

echo "Current Price of Bitcoin (BTC/USDT): " . $data['price'];
var_dump($data);
?>


<?php
$endpoint = "https://api.binance.com/api/v3/ticker/24hr?symbol=BTCUSDT";
$response = file_get_contents($endpoint);
$data = json_decode($response, true);

echo "24-Hour Price Change for Bitcoin (BTC/USDT): " . PHP_EOL;
echo "Price Change: " . $data['priceChange'] . PHP_EOL;
echo "Price Change Percent: " . $data['priceChangePercent'] . "%" . PHP_EOL;
echo "Last Price: " . $data['lastPrice'] . PHP_EOL;
echo "High Price: " . $data['highPrice'] . PHP_EOL;
echo "Low Price: " . $data['lowPrice'] . PHP_EOL;
?>