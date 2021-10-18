
 <html>
     <head>
         <meta charset="utf-8">
         <title>LMS</title>
         <link rel = "stylesheet" type = "text/css" href = "./part2style.css"></link>
     </head>
     <body style="font-family:Arial; margin: 0;">
         <?php

             try {
                 $conn = new PDO("sqlsrv:server = tcp:jscott11.database.windows.net,1433; Database = lms", "jscott11", "3557321Joh--");
                 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             }
             catch (PDOException $e) {
                 print("Error connecting to SQL Server.");
                 die(print_r($e));
             }
      
             $xml = simplexml_load_file("material.xml");

             $conn->query("DELETE FROM [dbo].[material]");
             if ($getResults == FALSE){
                echo (sqlsrv_errors());
             }

             foreach($xml->course as $course){
                 foreach($course->unit as $unit){
                     foreach($unit->subUnit as $subUnit){
                        $conn->query("INSERT INTO [dbo].[material] (code, unit, subunit, courseContent, courseName) VALUES (" . $course->code . " , " . $unit->title . ", " . $subUnit->number . ", '" . $subUnit->content . "', '" . $course->name . "')");
                     }
                 }
             }
             echo "<br>Content added";

      
      
             $xml = simplexml_load_file("questions.xml");

             $conn->query("DELETE FROM dbo.questions");

             foreach($xml->course as $course){
                $num = $course->number;
                $name = $course->name;
                foreach($course->question as $question){
                    $text = $question->text;
                    $query = "INSERT INTO dbo.questions (course, question, answera, answerb, answerc, answerd, correct, courseName) VALUES (" . $num . " , '" . $text . "', '" . $question->answera->letter . ": " . $question->answera->text . "', '" . $question->answerb->letter . ": " . $question->answerb->text . "', '" . $question->answerc->letter . ": " . $question->answerc->text . "', '" . $question->answerd->letter . ": " . $question->answerd->text . "', '" . $question->correct . "', '" . $name . "')";
                    $conn->query($query);
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
