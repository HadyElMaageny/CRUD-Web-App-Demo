<?php

use Core\Response;

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    die();
}

//dd($_SERVER['REQUEST_URI']);
function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] == $value;
}

function abort($code = 404)
{
    http_response_code($code);
    require base_path("views/{$code}.view.php");
    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path('views/' . $path);
}

function login($user)
{
    $_SESSION['user'] = [
        'id' => $user['id'],
        'email'=> $user['email'],
        'role_id'=> $user['role_id']
    ];

    session_regenerate_id(true);

}

function logout()
{
    $_SESSION = [];

    session_destroy();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}

function getFromDB($currentPage, $filters, $limit, $sortColumn = 'id', $sortDirection = 'asc')
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost", "root", "1234", "myapp");

// Drop the procedure if it exists
    $mysqli->query("DROP PROCEDURE IF EXISTS p");

// Create the stored procedure
    $mysqli->query("
CREATE DEFINER=`root`@`localhost` PROCEDURE `p`(
    IN p_id INT,
    IN p_name VARCHAR(100),
    IN p_gender ENUM('Male', 'Female', 'Other'),
    IN p_department VARCHAR(100),
    IN p_limit INT,
    IN p_offset INT,
    IN p_sortColumn VARCHAR(50),
    IN p_sortDirection VARCHAR(4)
)
BEGIN
    -- Step 1: Build the base query for filtering (without LIMIT and ORDER BY)
    SET @base_query = 'FROM employees WHERE 1=1';
    
    -- Dynamically add filters based on the parameters
    IF p_id IS NOT NULL THEN
        SET @base_query = CONCAT(@base_query, ' AND id LIKE \'%', p_id, '%\'');
    END IF;
    
    IF p_name IS NOT NULL THEN
        SET @base_query = CONCAT(@base_query, ' AND name LIKE \'%', p_name, '%\'');
    END IF;
    
    IF p_gender IS NOT NULL THEN
        SET @base_query = CONCAT(@base_query, ' AND gender LIKE \'%', p_gender, '%\'');
    END IF;
    
    IF p_department IS NOT NULL THEN
        SET @base_query = CONCAT(@base_query, ' AND department LIKE \'%', p_department, '%\'');
    END IF;

    -- Step 2: Get the total count of records before pagination
    SET @count_query = CONCAT('SELECT COUNT(*) ', @base_query);
    PREPARE stmt_count FROM @count_query;
    EXECUTE stmt_count;
    DEALLOCATE PREPARE stmt_count;

    -- Step 3: Fetch the actual filtered records with pagination
    SET @sql_query = CONCAT(
        'SELECT * FROM (',
        'SELECT * ', @base_query, ' LIMIT ', p_limit, ' OFFSET ', p_offset, 
        ') AS limited_result ORDER BY ', p_sortColumn, ' ', p_sortDirection
    );
    PREPARE stmt_data FROM @sql_query;
    EXECUTE stmt_data;
    DEALLOCATE PREPARE stmt_data;
END
");

    $offset = $currentPage * $limit;

    $id = isset($filters['id']) ? $filters['id'] : null;
    $name = isset($filters['name']) ? $filters['name'] : null;
    $gender = isset($filters['gender']) ? $filters['gender'] : null;
    $department = isset($filters['department']) ? $filters['department'] : null;

    $stmt = $mysqli->prepare("CALL p(?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssisss", $id, $name, $gender, $department, $limit, $offset, $sortColumn, $sortDirection);
    $stmt->execute();

    $result = $stmt->get_result();
    $count  = $result->fetch_row()[0];
    $result->free();
    if ($stmt->next_result())
    {
        $result = $stmt->get_result();
        $data  = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
    }

    $stmt->close();
    $mysqli->close();

    return [
        'count' => $count,
        'data' => $data
    ];


}