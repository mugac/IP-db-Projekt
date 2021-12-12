<?php
    function ErrorCheck($stmt, $id){
        if ($id == null) {
            http_response_code(404);
            echo "<title>ERROR 404</title>";
            echo "<h1>Error 404 Not Found</h1>";
            echo "Stánka nenalezena";
            return false;
        }
        if (!$id) {
            http_response_code(400);
            echo "<title>ERROR 400</title>";
            echo "<h1>Error 400 Bad Request</h1>";
            echo "Špatný požadavek";
            return false;
        }
        if($stmt->rowCount()===0)
        {
            http_response_code(404);
            echo "<title>ERROR 404</title>";
            echo "<h1>Error 404 Not Found</h1>";
            echo "Stánka nenalezena";
            return false;
        }
        return true;
    }

?>