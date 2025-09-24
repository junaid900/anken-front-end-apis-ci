<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Exception Occurred</title>
    <style type="text/css">
        body {
            background-color: #fff;
            margin: 40px;
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 14px;
            color: #333;
        }

        h1 {
            color: #d9534f;
            font-size: 22px;
            border-bottom: 1px solid #d9534f;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        p {
            margin: 0 0 10px;
        }

        .details {
            margin-top: 20px;
            padding: 10px;
            background: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <h1>An Exception Was Encountered</h1>

    <div class="details">
        <p><strong>Severity:</strong> <?php echo isset($severity) ? $severity : 'N/A'; ?></p>
        <p><strong>Message:</strong> <?php echo isset($message) ? $message : 'N/A'; ?></p>
        <p><strong>Filename:</strong> <?php echo isset($filepath) ? $filepath : 'N/A'; ?></p>
        <p><strong>Line Number:</strong> <?php echo isset($line) ? $line : 'N/A'; ?></p>
    </div>

</body>
</html>
