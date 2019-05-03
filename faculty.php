<?php
// $user = $_POST['user'];
// Connect to database
require_once 'DatabaseConnect/db_connect.php';
if ($mysqli = DB_CONNECT()) {
    if ($stmt = $mysqli->prepare("SELECT name FROM user WHERE id = ?")) {
        $user = 1;
        $password = 'test';
        $stmt->bind_param("i", $user);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($result->num_rows === 0)
            exit("No user with id $user exists");
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $stmt->close();
    } else {
        exit('Statement failed');
    }
} else {
    exit('Database failed to connect');
}
?>

<html>
    <head>
        <title>Website Title</title>
    </head>
    <body>
        <h1>JAK</h1>
        <h2>Faculty Page</h2>
        <?php
        echo "<h3>Welcome, $name!</h3>";
        ?>
        <button onclick="createStudent()">Create Student</button> <br>
        <button onclick="createFaculty()">Create Faculty</button> <br>
        <button onclick="createProject()">Create Project</button> <br>
        <button onclick="createEquipment()">Create Equipment</button> <br>
        <br><br>
        <div id="formDiv"></div>
        
        <script type="text/javascript">
            function createStudent() {
                // Gets the div
                var formDiv = document.getElementById("formDiv");
                if (formDiv.childNodes.length > 0) {
                    var element = document.getElementById("leForm");
                    element.parentNode.removeChild(element);
                }
                
                var form = document.createElement('form');
                form.setAttribute('id', "leForm");
                formDiv.appendChild(form);
                
                var e1 = document.createElement('text');
                e1.innerHTML = "Create Student <br>";
                form.appendChild(e1);
                
                var e2 = document.createElement('text');
                e2.innerHTML = "<br>Enter Name: <br>";
                form.appendChild(e2);
                
                var e3 = document.createElement('input');
                form.appendChild(e3);
                
                var e4 = document.createElement('text');
                e4.innerHTML = "<br>Enter Major: <br>";
                form.appendChild(e4);
                
                var e5 = document.createElement('input');
                form.appendChild(e5);
                
                var e6 = document.createElement('text');
                e6.innerHTML = "<br>Enter Classification: <br>";
                form.appendChild(e6);
                
                var e7 = document.createElement('input');
                form.appendChild(e7);
                
                var e8 = document.createElement('text');
                e8.innerHTML = "<br>Enter Password: <br>";
                form.appendChild(e8);
                
                var e9 = document.createElement('input');
                e9.setAttribute('type', 'password');
                form.appendChild(e9);
                
                var e10 = document.createElement('text');
                e10.innerHTML = "<br>Re-enter Password: <br>";
                form.appendChild(e10);
                
                var e11 = document.createElement('input');
                e11.setAttribute('type', 'password');
                form.appendChild(e11);
                
                var e12 = document.createElement('text');
                e12.innerHTML = "<br><br>";
                form.appendChild(e12);
                
                var e13 = document.createElement('input');
                e13.setAttribute("type", "submit");
                e13.setAttribute("value", "Submit");
                form.appendChild(e13);
            }
            
            function createFaculty() {
                var formDiv = document.getElementById("formDiv");
                if (formDiv.childNodes.length > 0) {
                    var element = document.getElementById("leForm");
                    element.parentNode.removeChild(element);
                }
                
                var form = document.createElement('form');
                form.setAttribute('id', "leForm");
                formDiv.appendChild(form);
                
                var e1 = document.createElement('text');
                e1.innerHTML = "Create Faculty <br>";
                form.appendChild(e1);
                
                var e2 = document.createElement('text');
                e2.innerHTML = "<br>Enter Name: <br>";
                form.appendChild(e2);
                
                var e3 = document.createElement('input');
                form.appendChild(e3);
                
                var e4 = document.createElement('text');
                e4.innerHTML = "<br>Enter Department: <br>";
                form.appendChild(e4);
                
                var e5 = document.createElement('input');
                form.appendChild(e5);
                
                var e6 = document.createElement('text');
                e6.innerHTML = "<br>Enter Password: <br>";
                form.appendChild(e6);
                
                var e7 = document.createElement('input');
                e7.setAttribute('type', 'password');
                form.appendChild(e7);
                
                var e8 = document.createElement('text');
                e8.innerHTML = "<br>Re-enter Password: <br>";
                form.appendChild(e8);
                
                var e9 = document.createElement('input');
                e9.setAttribute('type', 'password');
                form.appendChild(e9);
                
                var e10 = document.createElement('text');
                e10.innerHTML = "<br><br>";
                form.appendChild(e10);
                
                var e11 = document.createElement('input');
                e11.setAttribute("type", "submit");
                e11.setAttribute("value", "Submit");
                form.appendChild(e11);
            }
            
            function createProject() {
                var formDiv = document.getElementById("formDiv");
                if (formDiv.childNodes.length > 0) {
                    var element = document.getElementById("leForm");
                    element.parentNode.removeChild(element);
                }
                
                var form = document.createElement('form');
                form.setAttribute('id', "leForm");
                formDiv.appendChild(form);
                
                var e1 = document.createElement('text');
                e1.innerHTML = "Create Project <br>";
                form.appendChild(e1);
                
                var e2 = document.createElement('text');
                e2.innerHTML = "<br>Enter Name: <br>";
                form.appendChild(e2);
                
                var e3 = document.createElement('input');
                form.appendChild(e3);
                
                var e4 = document.createElement('text');
                e4.innerHTML = "<br>Enter Lead UserID: <br>";
                form.appendChild(e4);
                
                var e5 = document.createElement('input');
                e5.setAttribute("type", "number");
                form.appendChild(e5);
                
                var e6 = document.createElement('text');
                e6.innerHTML = "<br>Enter Start Date: <br>";
                form.appendChild(e6);
                
                var e7 = document.createElement('input');
                e7.setAttribute('type', 'date');
                form.appendChild(e7);
                
                var e8 = document.createElement('text');
                e8.innerHTML = "<br>Enter End Date: <br>";
                form.appendChild(e8);
                
                var e9 = document.createElement('input');
                e9.setAttribute('type', 'date');
                form.appendChild(e9);
                
                var e10 = document.createElement('text');
                e10.innerHTML = "<br><br>";
                form.appendChild(e10);
                
                var e11 = document.createElement('input');
                e11.setAttribute("type", "submit");
                e11.setAttribute("value", "Submit");
                form.appendChild(e11);
            }
            
            function createEquipment() {
                var formDiv = document.getElementById("formDiv");
                if (formDiv.childNodes.length > 0) {
                    var element = document.getElementById("leForm");
                    element.parentNode.removeChild(element);
                }
                
                var form = document.createElement('form');
                form.setAttribute('id', "leForm");
                formDiv.appendChild(form);
                
                var e1 = document.createElement('text');
                e1.innerHTML = "Create Equipment <br>";
                form.appendChild(e1);
                
                var e2 = document.createElement('text');
                e2.innerHTML = "<br>Enter Name: <br>";
                form.appendChild(e2);
                
                var e3 = document.createElement('input');
                form.appendChild(e3);
                
                var e4 = document.createElement('text');
                e4.innerHTML = "<br>Category: <br>";
                form.appendChild(e4);
                
                var e5 = document.createElement('input');
                e5.setAttribute("type", "number");
                form.appendChild(e5);
                
                var e6 = document.createElement('text');
                e6.innerHTML = "<br>Location: <br>";
                form.appendChild(e6);
                
                var e7 = document.createElement('input');
                form.appendChild(e7);
                
                var e8 = document.createElement('text');
                e8.innerHTML = "<br><br>";
                form.appendChild(e8);
                
                var e9 = document.createElement('input');
                e9.setAttribute("type", "submit");
                e9.setAttribute("value", "Submit");
                form.appendChild(e9);
            }
        </script>
    </body>
</html>