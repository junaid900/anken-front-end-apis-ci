<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Error</title>
    <style>
        body {
            background: #fff;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .container {
            border: 1px solid #990000;
            padding: 20px;
            border-radius: 5px;
            background: #f9f9f9;
        }
        h1 {
            color: #990000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>A PHP Error was encountered</h1>
        <p><strong>Severity:</strong> <?php echo $severity; ?></p>
        <p><strong>Message:</strong> <?php echo $message; ?></p>
        <p><strong>Filename:</strong> <?php echo $filepath; ?></p>
        <p><strong>Line Number:</strong> <?php echo $line; ?></p>
        <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>
            <h2>Backtrace:</h2>
            <?php foreach (debug_backtrace() as $error): ?>
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
