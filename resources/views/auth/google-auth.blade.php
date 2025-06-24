<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Google Auth Callback</title>
</head>
<body>
<script>

    if (window.opener && window.opener !== window) {
        window.opener.postMessage({
            code: '{{ $code }}'
        }, window.location.origin);
    }
    window.close();
</script>
</body>
</html>
