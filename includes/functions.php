<?php

function get_the_teachers($args)
{
    return $args;
}

function get_the_classes()
{
    global $db_conn;
    $output = array();
    $query = mysqli_query($db_conn, 'SELECT * FROM classes');

    while ($row = mysqli_fetch_object($query)) {
        $output[] = $row;
    }

    return $output;
}


function get_post(array $args = [])
{
    global $db_conn;
    if(!empty($args))
    {
        $condition = "WHERE 0 ";
        foreach($args as $k => $v)
        {
            $v = (string)$v;
            $condition_ar[] = "$k = '$v'";
        }
        if ($condition_ar > 0) {
            $condition = "WHERE " . implode(" AND ", $condition_ar);
        }
    };

    
    $sql = "SELECT * FROM posts $condition";
    $query = mysqli_query($db_conn,$sql);
    return mysqli_fetch_object($query);
}

function get_posts(array $args = [],string $type = 'object')
{
    global $db_conn;
    $condition = "WHERE 0 ";
    if(!empty($args))
    {
        foreach($args as $k => $v)
        {
            $v = (string)$v;
            $condition_ar[] = "$k = '$v'";
        }
        if ($condition_ar > 0) {
            $condition = "WHERE " . implode(" AND ", $condition_ar);
        }
    };

    
    $sql = "SELECT * FROM posts $condition";
    $query = mysqli_query($db_conn,$sql);
    return data_output($query , $type);
}

function get_metadata($item_id,$meta_key='',$type ='object')
{
    global $db_conn;
    $query = mysqli_query($db_conn,"SELECT * FROM metadata WHERE item_id = $item_id");
    if(!empty($meta_key))
    {
        $query = mysqli_query($db_conn,"SELECT * FROM metadata WHERE item_id = $item_id AND meta_key = '$meta_key'");
    }
    return data_output($query , $type);
}


function data_output($query , $type ='object')
{
    $output = array();
    if($type == 'object')
    {
        while ($result = mysqli_fetch_object($query)) {
            $output[] = $result;
        }
    }
    else
    {
        while ($result = mysqli_fetch_assoc($query)) {
            $output[] = $result;
        }
    }
    return $output;
}


function get_user_data($user_id, $type = 'object')
{
    global $db_conn;

    // Sanitize user ID to prevent SQL injection
    $user_id = mysqli_real_escape_string($db_conn, $user_id);

    // Query to fetch user data
    $query = mysqli_query($db_conn, "SELECT * FROM accounts WHERE id = '$user_id'");

    // Check if the query was successful
    if (!$query) {
        die("Query failed: " . mysqli_error($db_conn));
    }

    // Process query results
    $data = data_output($query, $type);
    return !empty($data) ? $data[0] : null;
}



function get_post_title($post_id='')
{

}


function get_users($args = array(),$type ='object')
{
    global $db_conn;
    $condition = "";
    if(!empty($args))
    {
        foreach($args as $k => $v)
        {
            $v = (string)$v;
            $condition_ar[] = "$k = '$v'";
        }
        if ($condition_ar > 0) {
            $condition = "WHERE " . implode(" AND ", $condition_ar);
        }
        
    }
    $query = mysqli_query($db_conn,"SELECT * FROM accounts $condition");
    return data_output($query , $type);
}


function get_user_metadata($user_id) {
    global $db_conn;

    $usermeta = array();

    // Query to fetch user metadata
    $query = mysqli_query($db_conn, "SELECT meta_key, meta_value FROM usermeta WHERE user_id = '$user_id'");

    // Check if the query was successful
    if (!$query) {
        die("Query failed: " . mysqli_error($db_conn));
    }

    // Process query results
    while ($row = mysqli_fetch_assoc($query)) {
        $meta_key = $row['meta_key'];
        $meta_value = $row['meta_value'];

        // Add metadata to the usermeta array
        $usermeta[$meta_key] = $meta_value;
    }

    return $usermeta;
}


function get_usermeta($user_id, $meta_key, $single = true)
{
    global $db_conn;

    // Sanitize inputs
    $user_id = mysqli_real_escape_string($db_conn, $user_id);
    $meta_key = mysqli_real_escape_string($db_conn, $meta_key);

    // Query to fetch user metadata
    $query = mysqli_query($db_conn, "SELECT meta_value FROM usermeta WHERE user_id = '$user_id' AND meta_key = '$meta_key'");

    // Check if the query was successful
    if (!$query) {
        die("Query failed: " . mysqli_error($db_conn));
    }

    // Process query results
    if ($single) {
        $result = mysqli_fetch_object($query);
        return $result ? $result->meta_value : null;
    } else {
        $meta_values = array();
        while ($row = mysqli_fetch_object($query)) {
            $meta_values[] = $row->meta_value;
        }
        return $meta_values;
    }
}

function fetchStudentQueries() {
    global $db_conn;
    $queries = array();

    // Query to fetch student queries
    $sql = "SELECT * FROM student_queries";
    $result = mysqli_query($db_conn, $sql);

    // Fetch data and store in array
    while ($row = mysqli_fetch_assoc($result)) {
        $queries[] = $row;
    }

    return $queries;
}

// Function to fetch conversation thread
function fetchConversation($queryId) {
    global $db_conn;
    $conversation = array();

    // Query to fetch conversation thread
    $sql = "SELECT * FROM messages WHERE query_id = $queryId";
    $result = mysqli_query($db_conn, $sql);

    // Fetch data and store in array
    while ($row = mysqli_fetch_assoc($result)) {
        $conversation[] = $row;
    }

    return $conversation;
}

// Function to send message
function sendMessage($adminId, $studentId, $message) {
    global $db_conn;

    // Escape special characters
    $message = mysqli_real_escape_string($db_conn, $message);

    // Query to insert message into database
    $sql = "INSERT INTO messages (sender_id, receiver_id, message, timestamp) 
            VALUES ($adminId, $studentId, '$message', NOW())";
    mysqli_query($db_conn, $sql);
}




?>