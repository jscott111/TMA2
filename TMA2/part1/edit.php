<html>
    <head>
        <title>Editing</title>
    </head>
    <body>
        <?php
            if (!($database = new mysqli("127.0.0.1:3306", "root", "3557321Joh--", "bookmarks"))){
                echo "Failed to connect";
            }

            $database->query("UPDATE bookmarks.marks SET link = '" . $_POST['editLink'] . "', id = '" . $_POST['userid'] . "' WHERE link = '" . $_POST['link'] . "';");

            echo "<form id='form' action='home.php' method='POST'>";
            echo "<input id='link' name='link' type='hidden' value='" . $_POST['editLink'] . "'></input>";
            echo "<input id='userid' name='userid' type='hidden' value='" . $_POST['userid'] . "'></input>";
            echo "<input id='username' name='username' type='hidden' value='" . $_POST['username'] . "'></input>";
            echo "<input id='password' name='password' type='hidden' value='" . $_POST['password'] . "'></input></form>";
        ?>

        <script>
            document.getElementById("form").submit();
        </script>
    </body>
</html>
