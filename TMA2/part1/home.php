<html>
    <head>
        <meta charset="utf-8">
        <title>Bookmarks</title>
        <link rel = "stylesheet" type = "text/css" href = "style.css"></link>
    </head>
    <body>
        <div class="header">
            <h2 style = "margin-left: 15px;">Your Bookmarks</h2>
            <h4 style = "margin-left: 15px;">Please omit "http://"</h4>
        </div>

        <?php
            try {
                 $conn = new PDO("sqlsrv:server = tcp:jscott11.database.windows.net,1433; Database = bookmarks", "jscott11", "3557321Joh--");
                 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             }
             catch (PDOException $e) {
                 print("Error connecting to SQL Server.");
                 die(print_r($e));
             }

            $username = $_POST['username'];
            $password = $_POST['password'];
            $userid = 0;

            if(isset($_POST['signup'])){
                $result = $conn->query("SELECT username FROM [dbo].[users]");
                $exists = false;
                foreach($result as $name){
                    if($username == $name['username']){
                        $exists = true;
                    }
                }

                if(!$exists){
                    $sql = "INSERT INTO [dbo].[users] (username, pword) VALUES ('" . $username . "', '" . $password . "');";

                    if(!($conn->query($sql))){
                        echo "<h3 style='margin-left: 20px; margin-top: 20px; color: red;'>Error creating your account</h3>";
                    }else{
                        display($username, $password);
                    }
                }else{
                    echo "<h3 style='margin-left: 20px; margin-top: 20px; color: red;'>Username already exists<br>Please try another username</h3>";
                }
            }else if(isset($_POST['login'])){
                $result = $conn->query("SELECT id FROM [dbo].[users] WHERE username='" . $username . "' AND pword='" . $password . "'");

                foreach($result as $row){
                    $userid = $row['id'];
                }

                if($userid){
                    display($username, $password);
                }else{
                    echo "<h3 style='margin-left: 20px; margin-top: 20px; color: red;'>Incorrect username or password</h3>";
                }
            }else{
                display($username, $password);
            }

            function display($username, $password){
                try {
                    $conn = new PDO("sqlsrv:server = tcp:jscott11.database.windows.net,1433; Database = bookmarks", "jscott11", "3557321Joh--");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch (PDOException $e) {
                    print("Error connecting to SQL Server.");
                    die(print_r($e));
                }

                $result = $conn->query("SELECT id FROM [dbo].[users] WHERE username='" . $username . "' AND pword='" . $password . "'");

                foreach($result as $row){
                    $userid = $row['id'];
                }

                $result = $conn->query("SELECT link FROM [dbo].[marks] INNER JOIN [dbo].[users] ON marks.id = users.id WHERE username='" . $username . "' AND pword='" . $password . "';");
                echo "<table>";
                foreach($result as $row){
                    echo "<form action='delete.php' method='POST'><tr><th style='border: 1px solid black;'><a href='https://";
                    echo $row['link'] . "' target='_blank'>" . $row['link'] . "</a></th>";
                    echo "<th style='border: 1px solid black;'>";
                    echo "<input id='userid' name='userid' type='hidden' value='" . $userid . "'></input>";
                    echo "<input id='link' name='link' type='hidden' value='" . $row['link'] . "'></input>";
                    echo "<input id='username' name='username' type='hidden' value='" . $username . "'></input>";
                    echo "<input id='pword' name='pword' type='hidden' value='" . $password . "'></input>";
                    echo "<button type='submit'>Delete</button></th></form>";
                    echo "<form id='editForm' action='prompt.php' method='POST'>";
                    echo "<th style='border: 1px solid black;'><button id='editButton' type='submit'>Edit</button></th>";
                    echo "<input id='editLink' name='editLink' type='hidden' value=''></input>";
                    echo "<input id='userid' name='userid' type='hidden' value='" . $userid . "'></input>";
                    echo "<input id='link' name='link' type='hidden' value='" . $row['link'] . "'></input>";
                    echo "<input id='username' name='username' type='hidden' value='" . $username . "'></input>";
                    echo "<input id='pword' name='pword' type='hidden' value='" . $password . "'></input></tr></form>";
                }
                echo "<form action='add.php' method='POST'><tr><th style='border: 1px solid black;'>";
                echo "<input id='addNewLink' name='addNewLink' type='text' style='font-size: 20px;' rows='1' cols='40'></input>";
                echo "<input id='addUserid' name='addUserid' type='hidden' value='" . $userid . "'></input>";
                echo "<input id='addUsername' name='addUsername' type='hidden' value='" . $username . "'></input>";
                echo "<input id='addPword' name='addPword' type='hidden' value='" . $password . "'></input>";
                echo "</th><th style='border: 1px solid black;'><button type='submit'>Add</button></th></tr>";
                echo "</form></table>";
            }
        ?>

        <script>

            document.getElementById("editButton").addEventListener("click",  e => {
                var newAddress = prompt("Please enter the new address");

                var request = new XMLHttpRequest();
                request.open('GET', "http://" + newAddress, true);
                request.onreadystatechange = function(){
                    if(request.readyState == 4){
                        // READ HERE:
                        // This will accept everything due to running on the XAMPP server but is set up to
                        // function properly when running on the actual server.
                        if(request.status != 404){

                            document.write("<form id='editForm' action='edit.php' method='POST'>");
                            document.write("<input id='editLink' name='editLink' type='hidden' value='" + document.getElementById("editLink").value + "'></input>");
                            document.write("<input id='userid' name='userid' type='hidden' value='" + document.getElementById("userid").value + "'></input>");
                            document.write("<input id='link' name='link' type='hidden' value='" + document.getElementById("link").value + "'></input>");
                            document.write("<input id='username' name='username' type='hidden' value='" + document.getElementById("username").value + "'></input>");
                            document.write("<input id='pword' name='pword' type='hidden' value='" + document.getElementById("pword").value + "'></input>");
                            document.write("</form>";

                            document.write(document.getElementById("editLink").value);
                            document.write(document.getElementById("userid").value);
                            document.write(document.getElementById("link").value);
                            document.write(document.getElementById("username").value);
                            document.write(document.getElementById("pword").value);

                            document.getElementById("editForm").submit();
                        }else{
                            document.write("<h2 class='invalid'>Address is not active!</h2>");
                        }
                    }
                }
                request.send();
            });
        </script>
    </body>
</html>
