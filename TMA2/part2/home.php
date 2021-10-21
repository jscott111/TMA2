<html>
    <head>
        <meta charset="utf-8">
        <title>LMS</title>
        <link rel = "stylesheet" type = "text/css" href = "./part2style.css"></link>
    </head>
    <body style="font-family:Arial; margin: 0;">
        <div class="header">
            <h2 style = "margin-left: 15px;">Learning Management System</h2>
        </div>

        <?php
            try {
                 $conn = new PDO("sqlsrv:server = tcp:jscott11.database.windows.net,1433; Database = lms", "jscott11", "3557321Joh--");
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
                $result = $conn->query("SELECT username, pword FROM [dbo].[users]");
                $exists = false;
                foreach($result as $name){
                    if($username == $name['username']){
                        $exists = true;
                    }
                }

                if(!$exists){
                    $sql = "INSERT INTO [dbo].[users] (username, pword) VALUES ('" . $username . "', '" . $password . "');";

                    if(!($conn->query($sql))){
                        echo "<h3 style='margin-left: 20px; margin-top: 20px; color: red;'>Error creating your account, username and password must not be null</h3>";
                    }else{
                        navBar($username, $password);
                    }
                }else{
                    echo "<h3 style='margin-left: 20px; margin-top: 20px; color: red;'>Username already exists<br>Please try another username</h3>";
                }
            }else if(isset($_POST['login'])){
                if(!($conn->query("SELECT id FROM [dbo].[users] WHERE username='" . $username . "' AND pword='" . $password . "'"))){
                    echo "<h3 style='margin-left: 20px; margin-top: 20px; color: red;'>Incorrect username or password</h3>";
                }else{
                    navBar($username, $password);
                }
            }else{
                navBar($username, $password);
            }

            function navBar($username, $password){
                try {
                    $conn = new PDO("sqlsrv:server = tcp:jscott11.database.windows.net,1433; Database = lms", "jscott11", "3557321Joh--");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch (PDOException $e) {
                    print("Error connecting to SQL Server.");
                    die(print_r($e));
                }
                
                $courses = $conn->query("SELECT DISTINCT code, courseName FROM [dbo].[material]");
                echo "<div class='col-md-5 col-lg-5'>";
                echo "<div class='mainmenu nav'><ul id='nav'>";
                foreach($courses as $course){
                    echo "<li class='menuborder'><a>" . $course['courseName'] . "</a><ul>";
                    $units = $conn->query("SELECT DISTINCT unit FROM [dbo].[material] WHERE code='" . $course['code'] . "'");
                    foreach($units as $unit){
                        echo "<li class='sub-sub-menu'><a>" . $unit['unit'] . "</a><ul>";
                        $subunits = $conn->query("SELECT DISTINCT subunit FROM [dbo].[material] WHERE code='" . $course['code'] . "' AND unit='" . $unit['unit'] . "'");
                        foreach($subunits as $subunit){
                            $result = $conn->query("SELECT courseContent FROM [dbo].[material] WHERE code='" . $course['code'] . "' AND unit='" . $unit['unit'] . "' AND subunit='" . $subunit['subunit'] . "'");
                            foreach($result as $content){
                                $cont = $content['courseContent'];
                            }
                            $string = parser($cont);
                            echo "<li><a href='javascript:display(\"$string\")'>" . $unit['unit'] . "." . $subunit['subunit'] . "</a></li>";
                        }
                        echo "</ul></li>";
                    }
                    echo "</ul></li>";
                }
                echo "<li class='menuborder'><a>Quizes</a><ul>";
                $quiz = $conn->query("SELECT DISTINCT course, courseName FROM [dbo].[questions]");
                foreach($quiz as $quiz){
                    $quizString = quizWriter($quiz['course'], $username, $password);
                    echo "<li class='menuborder'><a href='javascript:display(\"$quizString\")'>" . $quiz['courseName'] . "</a><ul>";
                    echo "</ul></li>";
                }
                echo "</ul></div></div>";
            }

            function quizWriter($course, $username, $password){
                $string = "";
                $counter = 0;


                try {
                    $conn = new PDO("sqlsrv:server = tcp:jscott11.database.windows.net,1433; Database = lms", "jscott11", "3557321Joh--");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch (PDOException $e) {
                    print("Error connecting to SQL Server.");
                    die(print_r($e));
                }

                $question = $conn->query("SELECT question, answera, answerb, answerc, answerd, correct FROM [dbo].[questions] WHERE course = " . $course);
                foreach($question as $question){
                    $counter++;
                    $string .= "<div><h3>" . $counter . ". " . $question['question'] . "</h3></div>";
                    $string .= "<div id=&apos;div" . $counter . "&apos;>";
                    $string .= "<label><input type=&apos;radio&apos; id=&apos;q" . $counter . "a&apos; name=&apos;question" . $counter . "&apos; value=&apos;a&apos;>" . $question['answera'] . "</label>";
                    $string .= "<br><label><input type=&apos;radio&apos; id=&apos;q" . $counter . "b&apos; name=&apos;question" . $counter . "&apos; value=&apos;b&apos;>" . $question['answerb'] . "</label>";
                    if(!($question['answerc'] == ": ")){
                        $string .= "<br><label><input type=&apos;radio&apos; id=&apos;q" . $counter . "c&apos; name=&apos;question" . $counter . "&apos; value=&apos;c&apos;>" . $question['answerc'] . "</label>";
                    }
                    if(!($question['answerd'] == ": ")){
                        $string .= "<br><label><input type=&apos;radio&apos; id=&apos;q" . $counter . "d&apos; name=&apos;question" . $counter . "&apos; value=&apos;d&apos;>" . $question['answerd'] . "</label>";
                    }
                    $string .= "<br><input type=&apos;hidden&apos; id=&apos;question" . $counter . "&apos; value=&apos;" . $question['correct'] . "&apos;>";
                    $string .= "</div>";
                }

                $grade = 0;
                $result = $conn->query("SELECT grade FROM [dbo].[grades] WHERE user='" . $username . "' AND course=" . $course);
                foreach($result as $result){
                    $grade = $result['grade'];
                }

                $string .= "<br><input type=&apos;hidden&apos; id=&apos;highest&apos; value=&apos;" . $grade . "&apos;>";
                $string .= "<br><input type=&apos;hidden&apos; id=&apos;numQuestions&apos; value=&apos;" . $counter . "&apos;>";
                $string .= "<br><input type=&apos;hidden&apos; id=&apos;courseNumber&apos; value=&apos;" . $course . "&apos;>";
                $string .= "<br><input type=&apos;hidden&apos; id=&apos;user&apos; value=&apos;" . $username . "&apos;>";
                $string .= "<br><input type=&apos;hidden&apos; id=&apos;password&apos; value=&apos;" . $password . "&apos;>";
                $string .= "<br><button class=&apos;buttons&apos; id=&apos;submit&apos;>Submit</button>";
                $string .= "<br><button class=&apos;buttons&apos; id=&apos;save&apos;>Save</button>";

                return parser($string);
            }

            function parser($string){
                $titleNeedsClosed = false;
                $boldNeedsClosed = false;
                $italNeedsClosed = false;
                $headerNeedsClosed = false;
                $str = $string;
                for($i = 0; $i < strlen($str); $i++){
                    if($str[$i] == '/' && $str[$i + 1] == '+'){
                        if($titleNeedsClosed == true){
                            $str = substr_replace($str, "</h1>", $i, 2);
                            $titleNeedsClosed = false;
                        }else{
                            $str = substr_replace($str, "<h1>", $i, 2);
                            $titleNeedsClosed = true;
                        }
                    }
                    if($str[$i] == '/' && $str[$i + 1] == '$'){
                        $str = substr_replace($str, "<br>", $i, 2);
                    }
                    if($str[$i] == '"'){
                        $str = substr_replace($str, "&amp;quot;", $i, 1);
                    }
                    if($str[$i] == '/' && $str[$i + 1] == '^'){
                        $str = substr_replace($str, "&amp;apos;", $i, 2);
                    }
                    if($str[$i] == '/' && $str[$i + 1] == '/'){
                        $str = substr_replace($str, "/", $i, 2);
                    }
                    if($str[$i] == '/' && $str[$i + 1] == '%'){
                        $str = substr_replace($str, "&amp;emsp;", $i, 2);
                    }
                    if($str[$i] == '/' && $str[$i + 1] == '='){
                        $str = substr_replace($str, "&amp;amp;", $i, 2);
                    }
                    if($str[$i] == '/' && $str[$i + 1] == 'l' && $str[$i + 2] == 't'){
                        $str = substr_replace($str, "&amp;lt;", $i, 3);
                    }
                    if($str[$i] == '/' && $str[$i + 1] == 'g' && $str[$i + 2] == 't'){
                        $str = substr_replace($str, "&amp;gt;", $i, 3);
                    }
                    if($str[$i] == '/' && $str[$i + 1] == '-'){
                        $str = substr_replace($str, "•", $i, 2);
                    }
                    if($str[$i] == '/' && $str[$i + 1] == '@'){
                        if($boldNeedsClosed == true){
                            $str = substr_replace($str, "</b>", $i, 2);
                            $boldNeedsClosed = false;
                        }else{
                            $str = substr_replace($str, "<b>", $i, 2);
                            $boldNeedsClosed = true;
                        }
                    }
                    if($str[$i] == '/' && $str[$i + 1] == '!'){
                        if($italNeedsClosed == true){
                            $str = substr_replace($str, "</i>", $i, 2);
                            $italNeedsClosed = false;
                        }else{
                            $str = substr_replace($str, "<i>", $i, 2);
                            $italNeedsClosed = true;
                        }
                    }
                    if($str[$i] == '/' && $str[$i + 1] == '#'){
                        if($headerNeedsClosed == true){
                            $str = substr_replace($str, "</h3>", $i, 2);
                            $headerNeedsClosed = false;
                        }else{
                            $str = substr_replace($str, "<h3>", $i, 2);
                            $headerNeedsClosed = true;
                        }
                    }
                }
                return $str;
            }
        ?>

        <br>
        <br>
        <br>
        <div class = "results"><div id = "results" style="position: fixed;"></div></div>
        <div id="body" style="margin-left: 20px; margin-bottom: 100px; margin-right: 30%;"></div>

        <script type="text/javascript">
            // window.addEventListener('pageshow', function() {
            //     document.getElementById("body").style.color = "red";
            //     alert(performance.navigation.type);
            //     Location.reload();
            //     if (performance.navigation.type == 2) {
            //         //alert('test');
            //         //window.location.reload();
            //     }
            //     //location.reload(true);
            // });

            function createListener() {
                document.getElementById("submit").addEventListener("click", function() {
                    var numCorrect = 0;
                    var percentage = 0;

                    for(let i = 1; i <= document.getElementById("numQuestions").value; i++){
                        var correct = document.getElementById("question" + i).value;
                        if(document.getElementById("q" + i + correct).checked){
                            numCorrect++;
                            document.getElementById("div" + i).style.color = "green";
                        }else{
                            document.getElementById("div" + i).style.color = "red";
                        }
                    }

                    percentage = Math.round((numCorrect / document.getElementById("numQuestions").value) * 100);
                    var highest = document.getElementById("highest").value;
                    document.getElementById("results").innerHTML = percentage + "%";
                    document.getElementById("results").innerHTML += "<p style='font-size: 15px;'>Highest Grade Attempt: " + highest + "%</p>";
                });



                document.getElementById("save").addEventListener("click", function() {
                    var numCorrect = 0;
                    var percentage = 0;

                    for(let i = 1; i <= document.getElementById("numQuestions").value; i++){
                        var correct = document.getElementById("question" + i).value;
                        if(document.getElementById("q" + i + correct).checked){
                            numCorrect++;
                        }
                    }

                    percentage = Math.round((numCorrect / document.getElementById("numQuestions").value) * 100);
                    var course = document.getElementById("courseNumber").value;
                    var user = document.getElementById("user").value;

                    document.write("<form id='updateForm' action='update.php' method='POST'>");
                    document.write("<input type='hidden' name='user' value='" + user + "'>");
                    document.write("<input type='hidden' name='course' value='" + course + "'>");
                    document.write("<input type='hidden' name='grade' value='" + percentage + "'>");
                    document.write("</form>");
                    document.getElementById("updateForm").submit();
                });
            }

            function display(content){
                document.getElementById("body").innerHTML = content;
                createListener();
            }


        </script>
    </body>
</html>
