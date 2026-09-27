<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Free indicator access request</title>
</head>
<body style="margin:0;background:#f2f5ef;color:#202920;font-family:Arial,sans-serif;line-height:1.6">
    <main style="max-width:620px;margin:32px auto;padding:32px;background:#fff">
        <p style="margin:0 0 10px;color:#397a31;font-size:12px;font-weight:bold;letter-spacing:1px">GENESIS BLOCK ADMIN</p>
        <h1 style="margin:0 0 16px;font-family:Georgia,serif;font-size:26px;font-weight:normal">Free indicator access requested</h1>
        <p><strong>Indicator:</strong> {{ $indicatorName }}</p>
        <p><strong>Name:</strong> {{ $requesterName ?: 'Not provided' }}</p>
        <p><strong>Email:</strong> <a href="mailto:{{ $requesterEmail }}">{{ $requesterEmail }}</a></p>
        @if ($requestMessage)
            <p><strong>Message:</strong><br>{{ $requestMessage }}</p>
        @endif
        <p style="margin:28px 0"><a href="{{ $adminUrl }}" style="display:inline-block;padding:12px 18px;background:#397a31;color:#fff;text-decoration:none">Review request in admin</a></p>
    </main>
</body>
</html>
