<?php
    $filename = base64_decode($_GET['file']);
    // Check the folder location to avoid exploit
    if (dirname($filename) == 'C:\Users\WORK\Pictures\Screenshots') # change to same directory as before ' /home/folder/images '
        echo file_get_contents($filename);
?>