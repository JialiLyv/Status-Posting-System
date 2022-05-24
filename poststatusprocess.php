<?php
    $statusCode = $_POST["statuscode"];
    $status = $_POST["status"];
    $share = $_POST["share_to"];
    $date = $_POST["date"];
    $permissionType = $_POST["permission_type"];

    if (isset($_POST["statuscode"]) && isset($_POST["status"])) {
        echo "$statusCode, $status, $share, $date, $permissionType";
    } else {
        echo "please input status code and status";
    }

    $sql_host="cmslamp14.aut.ac.nz";
    $sql_user="rfp0761";
    $sql_pass="Jiali521";
    $sql_db="rfp0761";
    $sql_tble="status";

    echo "<p> connecting to db... <p>";

    $conn = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);

    if (!$conn) {
        echo "<p>Database connection failure" . mysqli_error($conn) . "</p>";
    } else{
        echo "<p>Connected to DB</p>";

        $createQuery = "
                CREATE TABLE IF NOT EXISTS $sql_tble (
                     status_code VARCHAR(5) PRIMARY KEY,
                     status VARCHAR(100),
                     share_to INT(1),
                     date DATE,
                     permission_type INT(1)
                 );
                ";

        // executes the query and store result into the result pointer
        $createResult = mysqli_query($conn, $createQuery);
        
        // checks if the execuion was successful
        if(!$createResult) {
            echo "<p>DB creatation error: ", "</p>";
            echo "<p> $query", $createQuery, "</p>";
        } else {
            $insertQuery = "
                INSERT INTO $sql_tble (status_code, status, share_to, date, permission_type)
                VALUES                ('$statusCode', '$status', $share, STR_TO_DATE('$date', '$dd/%mm/%YY'), $permissionType);
                ";
            $insertResult = mysqli_query($conn, $insertQuery);

            if(!$insertResult) {
                echo "<p>DB insertion error: ", "</p>";
                echo "<p> $query", $insertQuery, "</p>";
            } else {
                echo "<p>Congratulations! Status inserted", "</p>";
                mysqli_free_result($insertResult);
            }
        // Frees up the memory, after using the result pointer
        mysqli_free_result($createResult);
    } // if successful query operation
        
    // close the database connection
    mysqli_close($conn);
} // if successful database connection
?>