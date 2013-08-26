<?php

include 'db_conect.php';
 
if(isset($_POST['email'], $_POST['p'], $_POST['first_name'], $_POST['last_name'], $_POST['nickname'], $_POST['type'])) 
{
    $password = $_POST['p'];
    // Create a random salt
    $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
    // Create salted password (Careful not to over season)
    $password = hash('sha512', $password.$random_salt);
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $nickname = $_POST['nickname'];
    $type = $_POST['type'];

    if ($insert_stmt = $mysqli->prepare("INSERT INTO hackers (first_name, last_name, nickname, email, password, salt, type) VALUES (?, ?, ?, ?, ?, ?, ?)"))
    {    
       $insert_stmt->bind_param('sssssss', $first_name, $last_name, $nickname, $email, $password, $random_salt, $type); 
       // Execute the prepared query.
       $insert_stmt->execute();

       echo 'Success: You have been ... something!';
    }
} 
else 
{ 
    // Login failed
    header('Location: ../MotherBrain/register.php?error=1');
}

?>
