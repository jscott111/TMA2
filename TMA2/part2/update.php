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
            $oldGrade = 0;
        
            try {
                 $conn = new PDO("sqlsrv:server = tcp:jscott11.database.windows.net,1433; Database = lms", "jscott11", "3557321Joh--");
                 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             }
             catch (PDOException $e) {
                 print("Error connecting to SQL Server.");
                 die(print_r($e));
             }

            echo "IN";
        
            $result = $database->query("SELECT grade FROM [dbo].[grades] WHERE username='" . $user . "' AND course=" . $course);
            foreach($result as $results){
                $oldGrade = $results['grade'];
            }
            
            echo "GRADE:" . $oldGrade;
        
            if($result->num_rows > 0 && $grade > $oldGrade){
                $database->query("UPDATE [dbo].[grades] SET grade=" . $grade . " WHERE username='" . $user . "' AND course=" . $course);
            }
            else{
                $database->query("INSERT INTO [dbo].[grades] (username, course, grade) VALUES ('" . $user . "', " . $course . ", " . $grade . ")");
            }
        
            echo "DONE";
        
            echo "<form id='homeForm' action='home.php' method='POST'>";
            echo "<input type='hidden' name='username' value='" . $user .  "'>";
            echo "<input type='hidden' name='password' value='" . $pass . "'>";
            echo "</form>";
        ?>
        <script>document.getElementById("homeForm").submit();</script>
    </body>
</html>
