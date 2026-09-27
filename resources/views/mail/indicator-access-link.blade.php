<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TradingView access</title>
</head>
<body style="margin:0;background:#f2f5ef;color:#202920;font-family:Arial,sans-serif;line-height:1.6">
    <main style="max-width:620px;margin:32px auto;padding:32px;background:#fff">
        <p style="margin:0 0 10px;color:#397a31;font-size:12px;font-weight:bold;letter-spacing:1px">GENESIS BLOCK</p>
        <h1 style="margin:0 0 16px;font-family:Georgia,serif;font-size:28px;font-weight:normal">Your indicator access is ready</h1>
        <p>Your {{ $deliveryType }} for <strong>{{ $indicatorName }}</strong> has been approved.</p>
        <p style="margin:28px 0"><a href="{{ $accessUrl }}" style="display:inline-block;padding:12px 18px;background:#397a31;color:#fff;text-decoration:none">Open TradingView access</a></p>
        <p>If the button does not open, use this link: <a href="{{ $accessUrl }}">{{ $accessUrl }}</a></p>
        <p style="color:#687466;font-size:13px">Trading setups and indicators are educational material, not financial advice. Review the risks before making trading decisions.</p>
    </main>
</body>
</html>
