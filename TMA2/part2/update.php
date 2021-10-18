<html>
    <head>
        <title>Updating</title>
    </head>
    <body>
        <?php
            $user = $_POST['user'];
            $pass = $_POST['password'];
            $course = $_POST['course'];
            $grade = $_POST['grade'];
            try {
                 $conn = new PDO("sqlsrv:server = tcp:jscott11.database.windows.net,1433; Database = lms", "jscott11", "3557321Joh--");
                 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             }
             catch (PDOException $e) {
                 print("Error connecting to SQL Server.");
                 die(print_r($e));
             }

            $result = $database->query("SELECT grade FROM [dbo].[grades] WHERE user='" . $user . "' AND course=" . $course);
            foreach($result as $results){
                $DBGrade = $results['grade'];
            }

            if($grade > $DBGrade){
                if($result->num_rows == 0){
                    $database->query("INSERT INTO [dbo].[grades] (user, course, grade) VALUES ('" . $user . "', " . $course . ", " . $grade . ")");
                }
                else{
                    $database->query("UPDATE [dbo].[grades] SET grade=" . $grade . " WHERE user='" . $user . "' AND course=" . $course);
                }
            }
            echo "<form id='homeForm' action='home.php' method='POST'>";
            echo "<input type='hidden' name='username' value='" . $user .  "'>";
            echo "<input type='hidden' name='password' value='" . $pass . "'>";
            echo "</form>";
        ?>
        <script>document.getElementById("homeForm").submit();</script>
    </body>
</html>
