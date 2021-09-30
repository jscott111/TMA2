<html>
    <head>
        <title>Editing</title>
    </head>
    <body>
        <?php
            echo "<form id='form' action='edit.php' method='POST'>";
            echo "<input id='editLink' name='editLink' type='hidden' value=''></input>";
            echo "<input id='link' name='link' type='hidden' value='" . $_POST['link'] . "'></input>";
            echo "<input id='userid' name='userid' type='hidden' value='" . $_POST['userid'] . "'></input>";
            echo "<input id='username' name='username' type='hidden' value='" . $_POST['username'] . "'></input>";
            echo "<input id='password' name='password' type='hidden' value='" . $_POST['pword'] . "'></input></form>";
        ?>

        <script>
            var answer = prompt('Please enter the new address');
            document.getElementById('editLink').value = answer;

            document.getElementById("form").submit();
        </script>
    </body>
</html>
