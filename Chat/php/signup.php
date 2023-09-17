<?php
    session_start();
    include_once "config.php";
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    if(!empty($username)){
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE username = '{$username}'");
            if(mysqli_num_rows($sql) > 0){
                echo "$username - This username already exist!";
            }else{
                $ran_id = rand(time(), 100000000);
                                $status = "Active now";
                                $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, username, status)
                                VALUES ({$ran_id}, '{$username}', '{$status}')");
                                if($insert_query){
                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE username = '{$username}'");
                                    if(mysqli_num_rows($select_sql2) > 0){
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        $_SESSION['unique_id'] = $result['unique_id'];
                                        echo "success";
                                    }else{
                                        echo "This username address not Exist!";
                                    }
                                }else{
                                    echo "Something went wrong. Please try again!";
                                }
            }
    }else{
        echo "All input fields are required!";
    }
?>
