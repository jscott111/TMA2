
 <html>
     <head>
         <meta charset="utf-8">
         <title>LMS</title>
         <link rel = "stylesheet" type = "text/css" href = "./part2style.css"></link>
     </head>
     <body style="font-family:Arial; margin: 0;">
         <?php

             $connectionInfo = array("UID" => "jscott11", "pwd" => "3557321Joh--", "Database" => "lms", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
             $serverName = "tcp:jscottlms.database.windows.net,1433";
             $database = sqlsrv_connect($serverName, $connectionInfo);
             if (!($database = new mysqli("127.0.0.1:3306", "root", "3557321Joh--", "lms"))){
                 echo "Failed to connect";
             }

             $xml = simplexml_load_file("material.xml");

             $database->sqlsrv_query("DELETE FROM lms.content");

             foreach($xml->course as $course){
                 foreach($course->unit as $unit){
                     foreach($unit->subUnit as $subUnit){
                        $database->query("INSERT INTO lms.content (code, unit, subunit, content, name) VALUES (" . $course->code . " , " . $unit->title . ", " . $subUnit->number . ", '" . $subUnit->content . "', '" . $course->name . "')");
                     }
                 }
             }


             if (!($database = new mysqli("127.0.0.1:3306", "root", "3557321Joh--", "lms"))){
                 echo "Failed to connect";
             }

             $xml = simplexml_load_file("questions.xml");

             $database->sqlsrv_query("DELETE FROM lms.questions");

             foreach($xml->course as $course){
                $num = $course->number;
                $name = $course->name;
                foreach($course->question as $question){
                    $text = $question->text;
                    $query = "INSERT INTO lms.questions (course, question, answera, answerb, answerc, answerd, correct, courseName) VALUES (" . $num . " , '" . $text . "', '" . $question->answera->letter . ": " . $question->answera->text . "', '" . $question->answerb->letter . ": " . $question->answerb->text . "', '" . $question->answerc->letter . ": " . $question->answerc->text . "', '" . $question->answerd->letter . ": " . $question->answerd->text . "', '" . $question->correct . "', '" . $name . "')";
                    $database->sqlsrv_query($query);
                }
             }
         ?>
         <div class="header">
             <h2 style = "margin-left: 15px;">Learning Management System</h2>
         </div>

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