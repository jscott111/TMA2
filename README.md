# TMA2

<html>
    <body>
        <h1>CS466</h1>
        <h2>Assignment 2</h2>
        <h2>John Scott 3542569</h2>
        <ul>
            <h4>Start Date: July 26 2021</h4>
            <h4>End Date: Sept 30 2021</h4>
            <h4>Hours Spent: 120</h4>
        </ul>
        <h2>Part 1</h2>
        <ul style="margin-left: 20px; margin-right: 40%;">
            <p>
                In this part of the assignment, when opened you will be greeted with a login/signup page and a list of the top 10 bookmarks
                of all of the users on the server. If you do not have an account, enter the your username and password and click sign up, if
                the username is taken you will be presented with an error and then must back up and choose another. Then, you will be brought
                to your home page where your list of bookmarks are listed. At the bottom of the list there is a textbox with an 'add' button.
                If you have bookmarks in the server, they will be listed with a delete and edit button. When the edit button is pressed, the
                user will be prompted for the new link and then submitted to the server.
            </p>
            <p>
                Each edit and new link is checked using javascript but on the xampp server, no link comes back with a 404 code due to none
                of the sites being on the xampp server, once the online server is running, the application should decline incorrect links. I
                made two tables in the server, one to keep track of users and the other to keep track of bookmarks. In the bookmarks table, I use
                the username of the user to identify what bookmarks they have, this lets me list the top 10 most popular bookmarks on the server across
                all users. I query for those by counting the distinct address and then get them cut off at the top 10 ordered by amount from count().
                Every link display in the top 10 list or personal list is clickable and will take you to that website.
            </p>
            <p>
                I didn't see the need for menu buttons with how I designed my application. I have the name of the site on a banner up above and it
                is present on each page. When you open my application you are greeted with a welcome message and a list of the top 10 bookmarks on
                the server across all of the users. Once logged in, there is a table with the user's bookmarks and a prompt to add a bookmark. If the
                user clicks a bookmark it will open the website in a new tab. There are buttons to add, edit and delete bookmarks.
            </p>
            <a href="./part1/welcome.php" target="_blank">Click here to open the application.</a>
            <a href="https://github.com/jscott111/TMA2/blob/main/TMA2/part1/welcome.php" target="_blank">welcome.php</a>
            <a href="https://github.com/jscott111/TMA2/blob/main/TMA2/part1/home.php" target="_blank">home.php</a>
            <a href="https://github.com/jscott111/TMA2/blob/main/TMA2/part1/add.php" target="_blank">add.php</a>
            <a href="https://github.com/jscott111/TMA2/blob/main/TMA2/part1/delete.php" target="_blank">delete.php</a>
            <a href="https://github.com/jscott111/TMA2/blob/main/TMA2/part1/edit.php" target="_blank">edit.php</a>
            <a href="https://github.com/jscott111/TMA2/blob/main/TMA2/part1/prompt.php" target="_blank">prompt.php</a>
            <a href="https://github.com/jscott111/TMA2/blob/main/TMA2/part1/style.css" target="_blank">style.css</a>
        </ul>
        <h2>Part 2</h2>
        <ul style="margin-left: 20px; margin-right: 40%;">
            <p>
                In part 2 of this assignment, I was tasked with creating a learning management system designed with functionality for SME's that are not
                techonologically literate. To accomplish this I have two XML files for the content, and questions for quizes. In the XML files they are
                divided up by course, then unit, then subunit. The quiz file is seperated by course number, then question, then each answer. These get
                reposted to the server each time that the start page is loading so that is why it takes a few seconds to load. Once the page loads, the
                user is presented with a similar log in screen as in part 1 where they can create an account or sign up. I did not incorperate an enrollment
                table to keep track of what courses a student is enrolled in as I didn't see this as a requirement and instead make it so that every student
                can see all of the courses. I only incorperated content for 3 courses to simulate a full time student's workload and filled it with content
                from the New Brunswick driver's handbook, Canadian Boater's Exam and the same content as in Assignment 1 as was said is acceptable. When
                logged in, the user is presented with a menu but a blank content screen. Once they are here they can hover over the menu buttons to display
                the units and do the same action to the units to display the subunits. Once a subunit is selected, the content screen will fill with the
                appropriate content.
            </p>
            <p>
                So, the EML that I wrote is used by throwing in special characters in place of html tags that are
                easier for the SME's to understand and use. I tried many different ways to google an EML but couldn't find
                any examples so I tried my best to interperet what you were looking for. Certain characters, it is specified,
                need a closer to indicate the ending of the desired change. Below are the characters and their functions:
                <ul>
                    <li>/+ - This is a title, needs a closer</li>
                    <li>/$ - This is a line break (new line) or the enter key</li>
                    <li>/@ - This makes the font bold, needs a closer</li>
                    <li>/! - This puts the text in italics, needs a closer</li>
                    <li>/# - This is slightly large bold text, smaller than a title but bigger than small text, needs a closer</li>
                    <li>/- - This is a bullet point</li>
                    <li>/lt - This is the < character</li>
                    <li>/gt - This is the > character</li>
                    <li>/^ - This will add an apostrophe</li>
                    <li>/% - This is a teb character</li>
                    <li>/= - This is the Ampersand character</li>
                </ul>

                <br>I filled the DB with  the New Brunswick driver manual content because there wasn't any instruction as to what type of content
                it should be.
            </p>
            <p>
                I encorperated a quiz functionality and since there was no specification of how it should work, I took some liberty and made it like
                a practice quiz type. This lets users do the quiz as many times as they'd like to practice the content, so after the user clicks 'submit'
                to grade the quiz, the grade for that attempt is presented with the highest attempted grade display below that which is queried from a
                table in the server called 'grades'. Once the user would like to save that grade, they can press the 'save' button and that will update
                the grade to the server if the attempted grade is higher than the current highest. The quiz questions are stored the same way as the
                course contents, all in the same table to allow for easy use of foreach loops to iterate through the data when displaying.
            </p>
            <img src="Images/content.png" alt="Contents Table">
            <img src="Images/users.png" alt="Users Table">
            <img src="Images/questions.png" alt="Question Table">
            <img src="Images/grades.png" alt="Grade Table">
            <br><br><p>
                Above are screen shots of the 4 tables I used in the application. Here are examples of the queries I used when adding the content and questions
                to the database.
                <br><br><b>$database->query("INSERT INTO lms.content (code, unit, subunit, content, name) VALUES (" . $course->code . " , " . $unit->title . ", " . $subUnit->number . ", '" . $subUnit->content . "', '" . $course->name . "')");</b>
                <br><br><b>$database->query("INSERT INTO lms.questions (course, question, answera, answerb, answerc, answerd, correct, courseName) VALUES (" . $num . " , '" . $text . "', '" . $question->answera->letter . ": " . $question->answera->text . "', '" . $question->answerb->letter . ": " . $question->answerb->text . "', '" . $question->answerc->letter . ": " . $question->answerc->text . "', '" . $question->answerd->letter . ": " . $question->answerd->text . "', '" . $question->correct . "', '" . $name . "')");</b>
                <br><br>Below is the code used to build the menu. I query the pertinent content based on the course/unit that I am currently writing for
                in the foreach loop.
                <br><br><img src="Images/menu.png" alt="Menu Building Code">
                <br><br>Below is the query I use to get the highest grade of a user for a course from the database.
                <br><br><b>$database->query("SELECT grade FROM lms.grades WHERE user='" . $username . "' AND course=" . $course);</b>
                <br><br>Below is the code I wrote to update or create the submission of a user's grade only if it is higher than the current one in the database.
                <br><br><img src="Images/gradeCode.png" alt="Grade Updating Code">
            </p>

            <a href="https://tmapart2.azurewebsites.net/TMA2/part2/start.php" target="_blank">Click here to open the application.</a>
            <a href="https://github.com/jscott111/TMA2/blob/main/TMA2/part2/start.php" target="_blank">start.php</a>
            <a href="https://github.com/jscott111/TMA2/blob/main/TMA2/part2/home.php" target="_blank">home.php</a>
            <a href="https://github.com/jscott111/TMA2/blob/main/TMA2/part2/update.php" target="_blank">update.php</a>
            <a href="https://github.com/jscott111/TMA2/blob/main/TMA2/part2/material.xml" target="_blank">material.xml</a>
            <a href="https://github.com/jscott111/TMA2/blob/main/TMA2/part2/questions.xml" target="_blank">questions.xml</a>
            <a href="https://github.com/jscott111/TMA2/blob/main/TMA2/part2/part2style.css" target="_blank">part2style.css</a>
        </ul>
    </body>
</html>
