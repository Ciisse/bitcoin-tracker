<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Buy/Sell Cryptocurrency</title>
</head>

<body>
    <div class="container mt-5">

        <!-- The Modal -->
        <div class="modal fade" id="cryptoModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Buy/Sell Cryptocurrency</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/crypto">
                            @csrf
                            <div class="form-group">
                                <label for="action">Choose an action:</label>
                                <select class="form-control" id="action" name="action">
                                    <option value="buy">Buy</option>
                                    <option value="sell">Sell</option>
                                </select>
                            </div>
                            <?php
                            $endpoint = 'https://api.binance.com/api/v3/ticker/price?symbol=BTCUSDT';
                            $response = file_get_contents($endpoint);
                            $data = json_decode($response, true);
                            
                            echo 'Current Price of Bitcoin (BTC/USDT): ' . $data['price'];
                            ?>
                            <div class="form-group">
                                <label for="amount">Amount:</label>
                                <input type="number" class="form-control" id="amount" name="amount"
                                    placeholder="Amount">
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
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