<?php
require_once 'Functions/ConnectionFunctionSet.php';
require_once 'Functions/ValidationFunctionSet.php';
require_once 'Functions/UpdateFunctionSet.php';
require_once 'Functions/RetrievalFunctionSet.php';

if(!isset($_SESSION)) {
    session_start();
}

if ($conn = DB_CONNECT()) {
    if (!login_check($conn)) {
        header("Location: index.php");
    }
}

if (isset($_POST['logout'])) {
    logout();
}

if ($_SESSION['user_type'] == 'student')
    header("Location: student.php");
 
$username = $_SESSION['username'];
$users = getAllUsers($conn);
$projects = array();
$conn = DB_CONNECT();
$ID = $_SESSION['user_id'];
$rows = getUserProjects($conn, $ID);
while($row = $rows->fetch_row()) {
    array_push($projects, $row[4]);
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
        echo "<div>Welcome, $username!</div><br><br>";
        ?>
        <button onclick="createStudent()">Create Student</button> <br>
        <button onclick="createFaculty()">Create Faculty</button> <br>
        <button onclick="createProject()">Create Project</button> <br>
        <button onclick="viewProjects()">View Projects</button> <br>
        <button onclick="createExperiment()">Create Experiment</button> <br>
        <button onclick="viewExperiments()">View Experiments</button> <br>
        <button onclick="createEquipment()">Create Equipment</button> <br>
        <button onclick="viewEquipment()">View Equipment</button> <br>
        <form method="post">
            <input name='logout' hidden />
            <input type="submit" value="Logout"/>
        </form>
        <br>
        <div id="formDiv"></div>
        <?php
        if (isset($_POST['name'], $_POST['major'], $_POST['classification'], $_POST['pass1'], $_POST['pass2'])) {
            $name = $_POST['name'];
            $password = $_POST['pass1'];
            $major = $_POST['major'];
            $classification = $_POST['classification'];
            if ($conn = DB_CONNECT()) {
                $ID = createStudent($conn, $name, $password, $major, $classification);
                if ($ID != FALSE)
                    echo "Student created successfully!";
            } else {
                echo "Something went wrong...";
            }
        }

        if (isset($_POST['name'], $_POST['department'], $_POST['pass1'], $_POST['pass2'])) {
            $name = $_POST['name'];
            $password = $_POST['pass1'];
            $department = $_POST['department'];
            if ($conn = DB_CONNECT()) {
                $ID = createFaculty($conn, $name, $password, $department);
                if ($ID != FALSE)
                    echo "Faculty created successfully!";
            } else {
                echo "Something went wrong...";
            }
        }

        if (isset($_POST['startDate'], $_POST['endDate'], $_POST['leadID'], $_POST['name'])) {
            $name = $_POST['name'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
            if ($conn = DB_CONNECT()) {
                $leadID = getUserByName($conn, $_POST['leadID'])[0];
                $ID = createProject($conn, $name, $leadID, $startDate, $endDate);
                if ($ID != FALSE)
                    echo "Project created successfully!";
                else {
                    echo "FAILURE";
                }
            } else {
                echo "Something went wrong...";
            }
        }

        if (isset($_POST['name'], $_POST['category'], $_POST['location'])) {
            $name = $_POST['name'];
            $category = $_POST['category'];
            $location = $_POST['location'];
            $FacultyID = $_SESSION['user_id'];
            if ($conn = DB_CONNECT()) {
                $ID = createEquipment($conn, $name, $category, $location);
                assignEquipmentToFaculty($conn, $ID, $FacultyID);
                if ($ID != FALSE)
                    echo "Equipment created successfully!";
            } else {
                echo "Something went wrong...";
            }
        }
        
        if (isset($_POST['projectID'], $_POST['category'])) {
            $projectID = $_POST['projectID'];
            $category = $_POST['category'];
            if ($conn = DB_CONNECT()) {
                $ID = createExperiment($conn, $projectID, $category);
                if ($ID != FALSE)
                    echo "Experiment created successfully!";
                else {
                }
            } else {
                echo "Something went wrong...";
            }
        }
        ?>
        
        <script type="text/javascript">
            var data = <?php echo json_encode($users); ?>;
            var projects = <?php echo json_encode($projects); ?>;
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
            
            function viewEquipment() {
                window.location.href = "equipment.php";
            }
            
            function createExperiment() {
                var formDiv = document.getElementById("formDiv");
                if (formDiv.childNodes.length > 0) {
                    var element = document.getElementById("leForm");
                    element.parentNode.removeChild(element);
                }
                
                var form = document.createElement('form');
                form.setAttribute('id', "leForm");
                form.setAttribute('autocomplete', 'off');
                form.setAttribute('method', 'POST');
                formDiv.appendChild(form);
                
                var e1 = document.createElement('text');
                e1.innerHTML = "Create Experiment <br>";
                form.appendChild(e1);
                
                var e2 = document.createElement('text');
                e2.innerHTML = "<br>Enter Project ID: <br>";
                form.appendChild(e2);
                
                var e3 = document.createElement('select');
                e3.setAttribute('name', 'projectID');
                e3.setAttribute('required', true);
                var i;
                for (i = 0; i < projects.length; i++) {
                    var o = document.createElement('option');;
                    o.setAttribute('value', projects[i]);
                    o.innerHTML = projects[i];
                    e3.appendChild(o);
                }
                form.appendChild(e3);
                
                var e6 = document.createElement('text');
                e6.innerHTML = "<br>Category: <br>";
                form.appendChild(e6);
                
                var e7 = document.createElement('input');
                e7.setAttribute('name', 'category');
                e7.setAttribute('type', 'number');
                e7.setAttribute('required', true);
                e7.setAttribute('min', 0);
                e7.setAttribute('max', 2);
                form.appendChild(e7);
                
                var e8 = document.createElement('text');
                e8.innerHTML = "<br><br>";
                form.appendChild(e8);
                
                var e9 = document.createElement('input');
                e9.setAttribute("type", "submit");
                e9.setAttribute("value", "Submit");
                form.appendChild(e9);
            }
            
            function viewExperiments() {
                window.location.href = "experiments.php";
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