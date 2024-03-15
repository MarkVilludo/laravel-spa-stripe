<!DOCTYPE html>
<html>
<head>
    <title>New Message</title>
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
        }
        p {
            color: #666666;
            line-height: 1.6;
        }
        .message {
            border-top: 2px solid #cccccc;
            padding-top: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Message</h1>
        <div class="message">
            <p><strong>From:</strong> {{ $content['name'] }}</p>
            <p><strong>Email:</strong> {{ $content['email'] }}</p>
            <p><strong>Subject:</strong> {{ $content['subject'] }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $content['message'] }}</p>
        </div>
        <p>Feel free to reply directly to this email to respond to the sender.</p>
    </div>
</body>
</html>
