<html>
    <head>
        <title>Deleting</title>
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

            $conn->query("DELETE FROM [dbo].[marks] WHERE id = '" . $_POST['userid'] . "' AND link = '" . $_POST['link'] . "';");

            echo "<form id='form' action='home.php' method='POST'>";
            echo "<input id='username' name='username' type='hidden' value='" . $_POST['username'] . "'></input>";
            echo "<input id='password' name='password' type='hidden' value='" . $_POST['pword'] . "'></input></form>";
        ?>

        <script>
            document.getElementById("form").submit();
        </script>
    </body>
</html>
