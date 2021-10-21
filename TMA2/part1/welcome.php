<html>
    <head>
        <meta charset="utf-8">
        <title>Bookmarks</title>
        <link rel = "stylesheet" type = "text/css" href = "style.css"></link>
    </head>
    <body>
        <div class="header">
            <h2 style = "margin-left: 15px;">Your Bookmarks</h2>
        </div>

        <div style="float: right; height: 500px; border: 1px solid black;">
            <h2 style="margin-right: 30px;">Top 10 Bookmarks</h2>
            <ol>
                <?php
                    try {
                        $conn = new PDO("sqlsrv:server = tcp:jscott11.database.windows.net,1433; Database = bookmarks", "jscott11", "3557321Joh--");
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }
                    catch (PDOException $e) {
                        print("Error connecting to SQL Server.");
                        die(print_r($e));
                    }

                    $result = $conn->query("SELECT TOP 10 link FROM [dbo].[marks] GROUP BY link ORDER BY COUNT(id) DESC");
                    foreach($result as $row){
                        echo "<br><li style='padding: 10px;'><a href='https://" . $row['link'] . "' target='_blank'>" . $row['link'] . "</a></li>";
                    }
                ?>
            </ol>
        </div>

        <h2 style="margin-left: 20px; margin-right: 50%; color: grey;">Welcome to my bookmark application. If you don't have an account, please fill out the fields below and click the 'sign up' button.
        Once logged in you can view your list of saved bookmarks and can modify, add and delete your bookmarks. Thank you for using my website and enjoy!</h2>

        <h2 class="padded">Login or Sign Up</h2>
        <form action="home.php" method="POST">
            <label for="username" class="padded">Username: </label>
            <input id="username" name="username" type="text" style="font-size: 20px;" rows="1" cols="20"></input>
            <br><label for="password" class="padded">Password: </label>
            <input id="password" name="password" type="password" style="font-size: 20px;" rows="1" cols="20"></input>
            <br>
            <button type="submit" class="buttons" name="login">Login</button>
            <button type="submit" class="buttons" name="signup">Sign Up</button>
        </form>

    </body>
</html>
