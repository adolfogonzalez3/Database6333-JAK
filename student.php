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

if ($_SESSION['user_type'] == 'faculty')
    header("Location: faculty.php");

$username = $_SESSION['username'];

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
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <div class="main">
        <h1>JAK</h1>
        <h2>Student Page</h2>
        <?php
        echo "<div>Welcome, $username!</div>";
        ?>
        <div class="cv-btns">
            <form method="post">
                <input name='logout' hidden />
                <input class="form-input3 logout" type="submit" value="Logout"/>
            </form>
            <button class="form-input input-submit" onclick="viewProjects()">View Projects</button> <br>
            <button class="form-input input-submit" onclick="createExperiment()">Create Experiment</button> <br>
            <button class="form-input input-submit" onclick="viewExperiments()">View Experiments</button> <br>
        </div>
        <br>
        <div id="formDiv"></div>
        <?php
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
            var projects = <?php echo json_encode($projects); ?>;
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
                e1.innerHTML = "<br>Create Experiment <br>";
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
                e9.setAttribute("class", "form-input2 input-submit");
                form.appendChild(e9);
            }
            
            function viewExperiments() {
                window.location.href = "experiments.php";
            }
            
            function viewProjects() {
                window.location.href = "projects.php";
            }
        </script>
        </div>
    </body>
</html>