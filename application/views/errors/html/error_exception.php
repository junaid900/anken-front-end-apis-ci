<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Exception</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            border: 1px solid #990000;
            padding: 20px;
            border-radius: 5px;
            background: #fff;
        }
        h1 {
            color: #990000;
        }
        p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>An uncaught Exception was encountered</h1>
        <p><strong>Type:</strong> <?php echo get_class($exception); ?></p>
        <p><strong>Message:</strong> <?php echo $message; ?></p>
        <p><strong>Filename:</strong> <?php echo $exception->getFile(); ?></p>
        <p><strong>Line Number:</strong> <?php echo $exception->getLine(); ?></p>

        <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>
            <h2>Backtrace:</h2>
            <?php foreach ($exception->getTrace() as $error): ?>
                <?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>
                    <p style="margin-left:10px">
                        File: <?php echo $error['file']; ?><br>
                        Line: <?php echo $error['line']; ?><br>
                        Function: <?php echo $error['function']; ?>
                    </p>
                <?php endif ?>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</body>
</html>
