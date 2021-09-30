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
            if (!($database = new mysqli("127.0.0.1:3306", "root", "3557321Joh--", "lms"))){
                echo "Failed to connect";
            }

            $result = $database->query("SELECT grade FROM lms.grades WHERE user='" . $user . "' AND course=" . $course);
            foreach($result as $results){
                $DBGrade = $results['grade'];
            }

            if($grade > $DBGrade){
                if($result->num_rows == 0){
                    $database->query("INSERT INTO lms.grades (user, course, grade) VALUES ('" . $user . "', " . $course . ", " . $grade . ")");
                }
                else{
                    $database->query("UPDATE lms.grades SET grade=" . $grade . " WHERE user='" . $user . "' AND course=" . $course);
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
