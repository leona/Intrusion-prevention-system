<?php
header("HTTP/1.1 404 Not Found");
echo "<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">\r\n<html><head>\r\n<title>404 Not Found</title>\r\n</head><body>\r\n<h1>Not Found</h1>\r\n<p>The requested URL " . htmlentities($_SERVER['SCRIPT_NAME']) . " was not found on this server.</p>\r\n</body></html>";
?>