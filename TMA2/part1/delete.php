<html>
    <head>
        <title>Deleting</title>
    </head>
    <body>
        <?php
            if (!($database = new mysqli("127.0.0.1:3306", "root", "3557321Joh--", "bookmarks"))){
                echo "Failed to connect";
            }

            $database->query("DELETE FROM bookmarks.marks WHERE id = '" . $_POST['userid'] . "' AND link = '" . $_POST['link'] . "';");

            echo "<form id='form' action='home.php' method='POST'>";
            echo "<input id='username' name='username' type='hidden' value='" . $_POST['username'] . "'></input>";
            echo "<input id='password' name='password' type='hidden' value='" . $_POST['pword'] . "'></input></form>";
        ?>

        <script>
            document.getElementById("form").submit();
        </script>
    </body>
</html>
