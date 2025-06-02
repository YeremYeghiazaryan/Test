<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Message</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #4F46E5;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 30px;
            color: #333333;
        }

        .content p {
            margin: 0 0 10px;
            line-height: 1.6;
        }

        .footer {
            background-color: #f0f0f0;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">
        <h2>📬 New Message</h2>
    </div>

    <div class="content">
        <p><strong>Post Name:</strong> {{ $post->name}}</p>
        <p><strong>Post Title</strong> {{ $post->title}}</p>
    </div>

    <div class="footer">
        This letter has been sent automatically. Please do not reply to it.
    </div>
</div>
</body>
</html>
