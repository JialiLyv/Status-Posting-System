<?php
    $text = $_POST["search"];

    if (isset($_POST["text"])) {
        echo "$text";
    } else {
        echo "please input search text";
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
        $query = "
                SELECT * FROM $sql_tble WHERE status like '$text%';
                ";
        // executes the query and store result into the result pointer
        $result = mysqli_query($conn, $query);
        
        // checks if the execuion was successful
        if(!$result) {
            echo "<p>DB error: ", "</p>";
            echo "<p> $query", $query, "</p>";
        } else {
            // Display the retrieved records
            echo "<table border=\"1\">";
            echo "<tr>\n"
            ."<th scope=\"col\">status_code</th>\n"
            ."<th scope=\"col\">status</th>\n"
            ."<th scope=\"col\">share_to</th>\n"
            ."<th scope=\"col\">date</th>\n"
            ."<th scope=\"col\">permission_type</th>\n"    
            ."</tr>\n";
            // retrieve current record pointed by the result pointer
            // Note the = is used to assign the record value to variable $row, this is not an error
            // the ($row = mysqli_fetch_assoc($result)) operation results to false if no record was retrieved
            // _assoc is used instead of _row, so field name can be used
            while ($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>",$row["status_code"],"</td>";
                echo "<td>",$row["status"],"</td>";
                echo "<td>",$row["share_to"],"</td>";
                echo "<td>",$row["date"],"</td>";
                echo "<td>",$row["permission_type"],"</td>";
                echo "</tr>";
            }
            echo "</table>";
        // Frees up the memory, after using the result pointer
        mysqli_free_result($result);
    } // if successful query operation
        
    // close the database connection
    mysqli_close($conn);
} // if successful database connection
?>