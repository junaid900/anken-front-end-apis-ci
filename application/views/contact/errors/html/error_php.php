<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head><title>Error</title></head>
<body>
    <h1>A PHP Error was encountered</h1>
    <p><strong>Severity:</strong> <?php echo $severity; ?></p>
    <p><strong>Message:</strong> <?php echo $message; ?></p>
    <p><strong>Filename:</strong> <?php echo $filepath; ?></p>
    <p><strong>Line Number:</strong> <?php echo $line; ?></p>
</body>
</html>