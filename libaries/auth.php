<?php
    function isLogin($role)
    {
        session_start();
        if(isset($_SESSION['valid']) && $_SESSION['valid']=true)
        {
            if($_SESSION['role']==$role)
            {
                return true;
            }
        }
        return false;
    }
    function checkUser($emai,$pwd)
    {
        include('../database/db_connection.php');
        $emai = trim($emai);
        $result = "SELECT * FROM `tbl_user` WHERE lower(`email`) = lower('$emai') and `password` = '$pwd';";
        $runresult = mysqli_query($conn,$result);
        $numrow = mysqli_num_rows($runresult);
        if($numrow == 1)
        {
            $row = mysqli_fetch_array($runresult);
            session_start();
            $_SESSION['valid'] = true;
            $_SESSION['username'] = $row['fistName']." ".$row['lastName'];
            $_SESSION['img'] = $row['image'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['userID'] = $row['id'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['mail'] = $row['email'];
            $_SESSION['status'] = $row['status'];
            
            return true;
        }
        return false;
    }
    function logOut()
    {
        session_start();
        session_destroy();
    }
?>