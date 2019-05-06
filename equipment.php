<html>
    <?php
        require_once 'Functions/RetrievalFunctionSet.php';
        require_once 'Functions/ConnectionFunctionSet.php';
        session_start();
    ?>
    <head>
        <title>Website Title</title>
    </head>
    <body>
        <h1>JAK</h1>
        <h2>Equipment Page</h2>
        <?php
            $conn = DB_CONNECT();
            $ID = $_SESSION['user_id'];
            $rows = getAllEquipmentOwnedByUser($conn, $ID);
            $finfo = $rows->fetch_fields();
        ?>
        <table>
        <tr>
        <?php
            foreach ($finfo as $val) {
        ?>
                <th><?=$val->name?></th>
        <?php
            }
        ?>
            </tr>
        <?php
            while($row = $rows->fetch_row()) {
        ?>
                <tr>
        <?php
                foreach($row as $col) {
        ?>
                    <td><?=$col?></td>
        <?php
                }
        ?>
                </tr>
        <?php
            }
        ?>
        </table>
    </body>
</html>