<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bitcoin Tracker</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>
<body>
    <div id="wallet">
        <?php
            // Fetching the price for BTC
            $btcEndpoint = "https://api.binance.com/api/v3/ticker/price?symbol=BTCUSDT";
            $btcResponse = file_get_contents($btcEndpoint);
            $btcData = json_decode($btcResponse, true);
            
            // Fetching the price for ETH
            $ethEndpoint = "https://api.binance.com/api/v3/ticker/price?symbol=ETHUSDT";
            $ethResponse = file_get_contents($ethEndpoint);
            $ethData = json_decode($ethResponse, true);
            
            // Fetching the price for DOGE
            $dogeEndpoint = "https://api.binance.com/api/v3/ticker/price?symbol=DOGEUSDT";
            $dogeResponse = file_get_contents($dogeEndpoint);
            $dogeData = json_decode($dogeResponse, true);
        ?>
        <h1>Bitcoin Tracker</h1>
        <div class="coins">
            <!-- Displaying the fetched prices -->
            <p>BTC: $<?= $btcData['price'];?></p>
            <p>ETH: $<?= $ethData['price'];?></p>
            <p>DOGE: $<?= $dogeData['price'];?></p>
        </div>
    </div>
    <?php
        $endpoint = "https://api.binance.com/api/v3/klines?symbol=BTCUSDT&interval=1h&limit=5";
        $response = file_get_contents($endpoint);
        $data = json_decode($response, true);
        
        // TODO: Show data in chart: gemiddelde high en low
        echo "Historical Candlestick Data for Bitcoin (BTC/USDT):" . PHP_EOL;
        foreach ($data as $kline) {
            echo "<br>";
            echo "Open Time: " . date("Y-m-d H:i:s", $kline[0] / 1000) . PHP_EOL;
            echo "Open: " . $kline[1] . PHP_EOL;
            echo "High: " . $kline[2] . PHP_EOL;
            echo "Low: " . $kline[3] . PHP_EOL;
            echo "Close: " . $kline[4] . PHP_EOL;
            echo "Volume: " . $kline[5] . PHP_EOL;
            echo "<br>";
        }
    ?>
    <div class="tokens">
    <form action="{{ route('overview') }}" method="POST">
        @csrf
        <label for="token_name">Token Name:</label>
        <input type="text" id="token_name" name="token_name">
        <button type="submit">Create Token</button>
    </form>
    @if ($tokens->isNotEmpty())
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Created at</th>
                    <th class="px-4 py-2">Last used at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tokens as $token)
                    <tr class="border-b dark:border-gray-700">
                        <td class="px-4 py-2">{{ $token->name }}</td>
                        <td class="px-4 py-2">{{ $token->created_at }}</td>
                        <td class="px-4 py-2">{{ $token->last_used_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You have not created any tokens yet.</p>
    @endif
    </div>
</body>
<html>
