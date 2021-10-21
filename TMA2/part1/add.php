<html>
    <head>
        <title>Adding</title>
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

            $conn->query("INSERT INTO [dbo].[marks] (link, id) VALUES ('" . $_POST['addNewLink'] . "', '" . $_POST['addUserid'] . "');");

            echo "<form id='form' action='home.php' method='POST'>";
            echo "<input id='link' name='link' type='hidden' value='" . $_POST['addNewLink'] . "'></input>";
            echo "<input id='userid' name='userid' type='hidden' value='" . $_POST['addUserid'] . "'></input>";
            echo "<input id='username' name='username' type='hidden' value='" . $_POST['addUsername'] . "'></input>";
            echo "<input id='password' name='password' type='hidden' value='" . $_POST['addPword'] . "'></input></form>";
        ?>

        <script>
            var request = new XMLHttpRequest();
            request.open('GET', "http://" + document.getElementById('link').value, true);
            request.onreadystatechange = function(){
                if(request.readyState == 4){
                    // READ HERE:
                    // This will accept everything due to running on the XAMPP server but is set up to
                    // function properly when running on the actual server.
                    if(request.status != 404){
                        document.getElementById("form").submit();
                    }else{
                        document.write("<form id='deleteForm' action='delete.php' method='POST'>");
                        document.write("<input id='userid' name='userid' type='hidden' value='" + document.getElementById('userid').value + "'></input>");
                        document.write("<input id='link' name='link' type='hidden' value='" + document.getElementById('link').value + "'></input>");
                        document.write("<input id='username' name='username' type='hidden' value='" + document.getElementById('username').value + "'></input>");
                        document.write("<input id='pword' name='pword' type='hidden' value='" + document.getElementById('password').value + "'></input></form>");
                        document.getElementById("deleteForm").submit();
                    }
                }
            }
            request.send();
        </script>
    </body>
</html>
