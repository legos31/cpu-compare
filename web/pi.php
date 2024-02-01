<?php

$time = 'Wed, 21 Oct 2016 07:28:00 GMT';
header('Cache-Control: no-cache, must-revalidate');
header('Last-Modified: ' . $time );

if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $time === $_SERVER['HTTP_IF_MODIFIED_SINCE']) {
    http_response_code(304);
    header('X-MODIFIED-SINCE: MATCH'); 
    die();
}

http_response_code(200);
header('X-CONTENT-RETURN: YES');
echo '<a href="/pi.php">link to pi.php</a>';
