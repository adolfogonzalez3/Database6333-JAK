<html>
    <head>
        <title>Website Title</title>
    </head>
    <body>
        <h1>JAK</h1>
        <h2>Projects Page</h2>
        
        <button onclick="homePage()">Home Page</button>
        
        <script type="text/javascript">
            function homePage() {
                // Need to distinguish between Students and Faculty
                // Probably can make a session cookie or something to handle that
                window.location.href = "faculty.php";
            }
        </script>
    </body>
</html>