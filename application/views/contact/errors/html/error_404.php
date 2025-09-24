<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 - Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            background: #000000ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #333;
        }
        .container {
            text-align: center;
        }
        .error-code {
            font-size: 8rem;
            font-weight: 900;
            color: #ffffffff;
            animation: bounce 1s ease-in-out infinite;
        }
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        .message {
            font-size: 1.5rem;
            margin: 20px 0;
            color: white;
        }
        .home-button {
            background: #ffffffff;
            color: black;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 1rem;
            text-decoration: none;
            transition: background 0.3s ease;
        }
        .home-button:hover {
            background: #000000ff;
            color: white;
        }

        @media (max-width: 600px) {
            .error-code {
                font-size: 5rem;
            }
            .message {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-code">404</div>
        <div class="message">Oops! The page you're looking for doesn't exist.</div>
        <a href="<?= base_url(); ?>" class="home-button">Go to Homepage</a>
    </div>
</body>
</html>
