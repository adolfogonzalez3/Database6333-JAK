<?php
require_once 'DatabaseConnect/db_connect.php';
require_once 'Functions/login.php';

if(!isset($_SESSION)) {
    session_start();
}

if ($mysqli = DB_CONNECT()) {
    if (!login_check($mysqli)) {
        header("Location: index.php");
    }
}

$username = $_SESSION['username'];

// Connect to database
if ($mysqli = DB_CONNECT()) {
    if ($stmt = $mysqli->prepare("SELECT name FROM person")) {
        $users = array();
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            array_push($users, $row['name']);
        }
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
        echo "<div>Welcome, $username!</div><a href='logout.php'>Logout</a><br><br>";
        ?>
        <button onclick="createStudent()">Create Student</button> <br>
        <button onclick="createFaculty()">Create Faculty</button> <br>
        <button onclick="createProject()">Create Project</button> <br>
        <button onclick="viewProjects()">View Projects</button> <br>
        <button onclick="createEquipment()">Create Equipment</button> <br>
        <br><br>
        <div id="formDiv"></div>
        
        <script type="text/javascript">
            var data = <?php echo json_encode($users); ?>;
            function createStudent() {
                // Gets the div
                var formDiv = document.getElementById("formDiv");
                if (formDiv.childNodes.length > 0) {
                    var element = document.getElementById("leForm");
                    element.parentNode.removeChild(element);
                }
                
                var form = document.createElement('form');
                form.setAttribute('id', "leForm");
                form.setAttribute('autocomplete', 'off');
                form.setAttribute('action', 'Functions/create_student.php');
                form.setAttribute('method', 'POST');
                formDiv.appendChild(form);
                
                var e1 = document.createElement('text');
                e1.innerHTML = "Create Student <br>";
                form.appendChild(e1);
                
                var e2 = document.createElement('text');
                e2.innerHTML = "<br>Enter Name: <br>";
                form.appendChild(e2);
                
                var e3 = document.createElement('input');
                e3.setAttribute('name', 'name');
                e3.setAttribute('required', true);
                form.appendChild(e3);
                
                var e4 = document.createElement('text');
                e4.innerHTML = "<br>Enter Major: <br>";
                form.appendChild(e4);
                
                var e5 = document.createElement('input');
                e5.setAttribute('name', 'major');
                e5.setAttribute('required', true);
                form.appendChild(e5);
                
                var e6 = document.createElement('text');
                e6.innerHTML = "<br>Enter Classification: <br>";
                form.appendChild(e6);
                
                var e7 = document.createElement('select');
                e7.setAttribute('name', 'classification');
                e7.setAttribute('required', true);
                var i;
                for (i = 0; i < 5; i++) {
                    var o = document.createElement('option');
                    o.setAttribute('value', i);
                    o.innerHTML = i;
                    e7.appendChild(o);
                }
                form.appendChild(e7);
                
                var e8 = document.createElement('text');
                e8.innerHTML = "<br>Enter Password: <br>";
                form.appendChild(e8);
                
                var e9 = document.createElement('input');
                e9.setAttribute('name', 'pass1');
                e9.setAttribute('type', 'password');
                e9.setAttribute('required', true);
                form.appendChild(e9);
                
                var e10 = document.createElement('text');
                e10.innerHTML = "<br>Re-enter Password: <br>";
                form.appendChild(e10);
                
                var e11 = document.createElement('input');
                e11.setAttribute('name', 'pass2');
                e11.setAttribute('type', 'password');
                e11.setAttribute('required', true);
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
                form.setAttribute('autocomplete', 'off');
                form.setAttribute('action', 'Functions/create_faculty.php');
                form.setAttribute('method', 'POST');
                formDiv.appendChild(form);
                
                var e1 = document.createElement('text');
                e1.innerHTML = "Create Faculty <br>";
                form.appendChild(e1);
                
                var e2 = document.createElement('text');
                e2.innerHTML = "<br>Enter Name: <br>";
                form.appendChild(e2);
                
                var e3 = document.createElement('input');
                e3.setAttribute('name', 'name');
                e3.setAttribute('required', true);
                form.appendChild(e3);
                
                var e4 = document.createElement('text');
                e4.innerHTML = "<br>Enter Department: <br>";
                form.appendChild(e4);
                
                var e5 = document.createElement('input');
                e5.setAttribute('name', 'department');
                e5.setAttribute('required', true);
                form.appendChild(e5);
                
                var e6 = document.createElement('text');
                e6.innerHTML = "<br>Enter Password: <br>";
                form.appendChild(e6);
                
                var e7 = document.createElement('input');
                e7.setAttribute('type', 'password');
                e7.setAttribute('id', 'pass1');
                e7.setAttribute('name', 'pass1');
                e7.setAttribute('required', true);
                form.appendChild(e7);
                
                var e8 = document.createElement('text');
                e8.innerHTML = "<br>Re-enter Password: <br>";
                form.appendChild(e8);
                
                var e9 = document.createElement('input');
                e9.setAttribute('type', 'password');
                e9.setAttribute('id', 'pass2');
                e9.setAttribute('name', 'pass2');
                e9.setAttribute('required', true);
                form.appendChild(e9);
                
                var e10 = document.createElement('text');
                e10.innerHTML = "<br><br>";
                form.appendChild(e10);
                
                var e11 = document.createElement('input');
                e11.setAttribute("type", "submit");
                e11.setAttribute("value", "Submit");
                form.appendChild(e11);
                
                e7.onchange = validatePassword;
                e9.onchange = validatePassword;
            }
            
            function createProject() {
                var formDiv = document.getElementById("formDiv");
                if (formDiv.childNodes.length > 0) {
                    var element = document.getElementById("leForm");
                    element.parentNode.removeChild(element);
                }
                
                var form = document.createElement('form');
                form.setAttribute('id', "leForm");
                form.setAttribute('autocomplete', 'off');
                form.setAttribute('action', 'Functions/create_project.php');
                form.setAttribute('method', 'POST');
                formDiv.appendChild(form);
                
                var e1 = document.createElement('text');
                e1.innerHTML = "Create Project <br>";
                form.appendChild(e1);
                
                var e2 = document.createElement('text');
                e2.innerHTML = "<br>Enter Name: <br>";
                form.appendChild(e2);
                
                var e3 = document.createElement('input');
                e3.setAttribute('name', 'name');
                e3.setAttribute('required', true);
                form.appendChild(e3);
                
                var e4 = document.createElement('text');
                e4.innerHTML = "<br>Enter Lead User: <br>";
                form.appendChild(e4);
                
                var e5 = document.createElement('select');
                e5.setAttribute('name', 'leadID');
                e5.setAttribute('required', true);
                var i;
                for (i = 0; i < data.length; i++) {
                    var o = document.createElement('option');
                    o.setAttribute('value', data[i]);
                    o.innerHTML = data[i];
                    e5.appendChild(o);
                }                
                form.appendChild(e5);
                
                var e6 = document.createElement('text');
                e6.innerHTML = "<br>Enter Start Date: <br>";
                form.appendChild(e6);
                
                var e7 = document.createElement('input');
                e7.setAttribute('name', 'startDate');
                e7.setAttribute('type', 'date');
                e7.setAttribute('required', true);
                form.appendChild(e7);
                
                var e8 = document.createElement('text');
                e8.innerHTML = "<br>Enter End Date: <br>";
                form.appendChild(e8);
                
                var e9 = document.createElement('input');
                e9.setAttribute('name', 'endDate');
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
                form.setAttribute('autocomplete', 'off');
                form.setAttribute('action', 'Functions/create_equipment.php');
                form.setAttribute('method', 'POST');
                formDiv.appendChild(form);
                
                var e1 = document.createElement('text');
                e1.innerHTML = "Create Equipment <br>";
                form.appendChild(e1);
                
                var e2 = document.createElement('text');
                e2.innerHTML = "<br>Enter Name: <br>";
                form.appendChild(e2);
                
                var e3 = document.createElement('input');
                e3.setAttribute('name', 'name');
                e3.setAttribute('required', true);
                form.appendChild(e3);
                
                var e4 = document.createElement('text');
                e4.innerHTML = "<br>Category: <br>";
                form.appendChild(e4);
                
                var e5 = document.createElement('select');
                e5.setAttribute('name', 'category');
                e5.setAttribute('required', true);
                var i;
                for (i = 0; i < 4; i++) {
                    var o = document.createElement('option');
                    o.setAttribute('value', i);
                    o.innerHTML = i;
                    e5.appendChild(o);
                }
                form.appendChild(e5);
                
                var e6 = document.createElement('text');
                e6.innerHTML = "<br>Location: <br>";
                form.appendChild(e6);
                
                var e7 = document.createElement('input');
                e7.setAttribute('name', 'location');
                e7.setAttribute('required', true);
                form.appendChild(e7);
                
                var e8 = document.createElement('text');
                e8.innerHTML = "<br><br>";
                form.appendChild(e8);
                
                var e9 = document.createElement('input');
                e9.setAttribute("type", "submit");
                e9.setAttribute("value", "Submit");
                form.appendChild(e9);
            }
            
            function viewProjects() {
                window.location.href = "projects.php";
            }
            
            function validatePassword() {
                var pass1 = document.getElementById('pass1');
                var pass2 = document.getElementById('pass2');
                if (pass1.value != pass2.value) {
                    pass2.setCustomValidity("Passwords Don't Match");
                } else {
                    pass2.setCustomValidity('');
                }
            }
        </script>
    </body>
</html>