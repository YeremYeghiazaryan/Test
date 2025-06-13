<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notification for Message Owner</title>
</head>
<body>
<h2>Hello!</h2>
<p>You have a new message.</p>
<p>
    Please confirm the message by clicking the link below:
</p>
<p>
    <a href="{{ route('posts-verify', ['id' => $post->id]) }}">
        Click here to verify
    </a>
</p>
<p>Thank you!</p>
</body>
</html>
