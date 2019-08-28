<?php

function read_dir($path) {
    if ($dh = opendir($path)) {
        while(($file = readdir($dh)) != false) {
            if (substr($file, 0, 1) === '.') {
                continue;
            }

            $file_path = $path . "/" . $file;
            $fmt = filemtime($file_path);
            if (is_dir($file_path)) {
                echo "<ul>";
                echo "<p>$file</p>";
                read_dir($file_path);
                echo "</ul>";
            } else {
                echo
                "<li>" .
                    "<a href='./$file_path' download='$file'>" .
                        $file .
                    "</a>" .
                    "<span>". date("Y-m-d", $fmt) ."</span>" .
                "</li>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>File list.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
        <style type="text/css">
            .container {
                width: 800px;
                margin: 30px auto 0 auto;
                box-shadow:1px 2px 5px #333333;
                min-height: 300px;
                padding: 20px;
            }
            .logo {
                text-align: center;
                padding: 30px 0;
                text-shadow:#000 1px 0 0,#000 0 1px 0,#000 -1px 0 0,#000 0 -1px 0;  
                color:white;
                font-size:60px
            }
            ul, li {
                margin: 0px;
                padding: 0px;
                list-style: none;
            }
            ul>p {
                padding: 0;
                margin: 0;
                font-size: 20px;
                color: #1670FD;
                font-weight: bold;
            }
            ul ul {
                border: 1px solid #ccc;
                padding: 10px;
                margin: 10px 0;
            }
            li {
                margin: 5px 0;
                display: flex;
                flex-direction: 'row';
            }
            li>a {
                flex: 1;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="logo">
                File List
            </div>

            <ul>
                <p>根目录:</p>
                <?php read_dir("./"); php?>
            </ul>
        </div>
    </body>
</html>