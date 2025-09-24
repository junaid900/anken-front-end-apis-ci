<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>404 Page Not Found</title>
    <style>
        body {
            margin: 0;
            background: #000000;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #ffffff;
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: radial-gradient(circle at 75% 25%, rgba(40,40,40,0.8) 0%, rgba(0,0,0,1) 100%);
        }

        .container {
            text-align: center;
            padding: 40px;
            max-width: 600px;
            animation: fadeIn 0.8s ease-out;
        }

        .logo {
            width: 180px;
            margin-bottom: 30px;
            filter: drop-shadow(0 0 10px rgba(255,255,255,0.2));
        }

        h1 {
            font-size: 100px;
            margin: 0;
            color: #ffffff;
            font-weight: 700;
            text-shadow: 0 5px 15px rgba(255,255,255,0.1);
        }

        h2 {
            font-size: 32px;
            margin: 10px 0 20px;
            font-weight: 600;
        }

        p {
            font-size: 18px;
            color: #aaa;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background-color: #ffffff;
            color: #000000;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(255,255,255,0.2);
            border: 2px solid transparent;
        }

        a:hover {
            background-color: transparent;
            color: #ffffff;
            border-color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(255,255,255,0.3);
        }

        .emoji {
            font-size: 64px;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-20px);}
            60% {transform: translateY(-10px);}
        }

        .stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .star {
            position: absolute;
            background-color: #fff;
            border-radius: 50%;
            animation: twinkle var(--duration) infinite ease-in-out;
        }

        @keyframes twinkle {
            0% { opacity: 0.2; }
            50% { opacity: 1; }
            100% { opacity: 0.2; }
        }
    </style>
</head>
<body>
    <div class="stars" id="stars"></div>
    <div class="container">
        <img src="<?=  config_item('base_url') ?>themes/default/images/logo_white.png" alt="Logo" class="logo">
        <div class="emoji">😕</div>
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <p>The page you're looking for doesn't exist or may have been moved. Let's get you back on track.</p>
        <a href="/">Go to Homepage</a>
    </div>

    <script>
        // Create stars background
        const starsContainer = document.getElementById('stars');
        const starCount = 100;
        
        for (let i = 0; i < starCount; i++) {
            const star = document.createElement('div');
            star.classList.add('star');
            
            // Random properties for each star
            const size = Math.random() * 2 + 1;
            const x = Math.random() * 100;
            const y = Math.random() * 100;
            const duration = Math.random() * 3 + 2;
            
            star.style.width = `${size}px`;
            star.style.height = `${size}px`;
            star.style.left = `${x}%`;
            star.style.top = `${y}%`;
            star.style.setProperty('--duration', `${duration}s`);
            
            starsContainer.appendChild(star);
        }
    </script>
</body>
</html>