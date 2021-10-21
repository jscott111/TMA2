<html>
    <head>
        <title>Editing</title>
    </head>
    <body>
        <?php
            try {
                $conn = new PDO("sqlsrv:server = tcp:jscott11.database.windows.net,1433; Database = bookmarks", "jscott11", "3557321Joh--");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) {
                print("Error connecting to SQL Server.");
                die(print_r($e));
            }

            $conn->query("UPDATE [dbo].[marks] SET link = '" . $_POST['editLink'] . "', id = '" . $_POST['userid'] . "' WHERE link = '" . $_POST['link'] . "';");

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
