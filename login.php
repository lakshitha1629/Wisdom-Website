<?php

require 'system/Connection.php';
$conn = Connect();

$Username = $_POST['username'];
$pass = md5($_POST['password']);

if (!empty($Username) && !empty($pass)) {
    //$pass=md5($_POST['Password']); 
    $query = $conn->query("SELECT * FROM user_account WHERE user_name='" . $Username . "'");
    $numrows = mysqli_num_rows($query);
    if ($numrows != 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $dbUsername = $row['user_name'];
            $dbpassword = $row['password'];
            $dbpersonID = $row['user_id'];
            $dbactivated = $row['activated'];
            $dbcategory = $row['user_type'];
        }

 
        if ($Username == $dbUsername && $pass == $dbpassword && $dbactivated == '1' && !empty($dbcategory)) {

            session_start();

            $_SESSION['user_name'] = $Username;
            $_SESSION['user_id'] = $dbpersonID;
            $_SESSION['user_type'] = $dbcategory;
            $_SESSION['Useraa'] = 'a';
//            if ($dbcategory == '1') {

            $pure_string = $dbcategory . "_" . $Username . "_" . $dbpersonID;
            $encryption_key = "praneeth1";

            $val = openssl_encrypt($pure_string, "AES-128-ECB", $encryption_key);


            //$_SESSION['User'] = 'a';

            echo ("<script type='text/javascript'>  window.location = 'http://localhost/HANDME/index.php/Welcome/Profile?id=" . $val . "' </script>");

//                echo "ad";
//            } elseif ($dbcategory == '2') {
//                $_SESSION['User'] = 't';
//                echo ("<script type='text/javascript'> document.location = 'index.php'; </script>");
//            } elseif ($dbcategory == '3') {
//                $_SESSION['User'] = 's';
//                echo ("<script type='text/javascript'> document.location = 'index.php'; </script>");
//            }
        } elseif ($Username == $dbUsername && $pass == $dbpassword && $dbactivated == '0') {
            echo 'Account not activated!';
        } elseif ($Username == $dbUsername && $pass != $dbpassword) {
            echo 'Incorrect Password!';
        } else {
            echo 'Unknown Error ' . $dbUsername;
        }
    } else {
        echo 'Invalid username!';
    }
} else {
    echo 'Enter the user name and password.';
}

function encrypt($pure_string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
    return $encrypted_string;
}

?> 