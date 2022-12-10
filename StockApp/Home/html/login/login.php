<!--  -->

<?php
//This script will handle login
session_start();

// check if the user is already logged in
// if(isset($_SESSION['username']))
// {
    // header("location: ../../../LoginPage/dashboard/dashboard.html");
    // exit;
// }
require_once "config.php";

$username = $password = "";
$errup = "";

$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: ../../../LoginPage/dashboard/dashboard.html");
                            
                        }
                        else
                        {
                            $errup = "<b>Username Or Password is Incorrent..!</b><br><br>";
        
                        }
                    }

                }
                else
                {
                    $errup = "<b>Username Or Password is Inorrent..!</b><br><br>";

                }
                

    }
}    


}


?>
<!--  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
 

    <!-- Authentication -->

    <section>
       

        <div class="imgBx">
            <img src="stockbg.jpg" alt="" srcset="">
        </div>
        <div class="formcontainer">
            <div class="formBx">
                <h2>Login</h2>
                
                <a href="../index.html"><i class="fa fa-2x fa-home"></i></a>
               
                <form action="" method= "POST">
                <?php
                  echo $errup;
                 
                ?>
              
                 <div class="inputBx">
                     <span>Username</span>
                     <input type="text" name="username" placeholder="Enter username">
                 </div>
                 <div class="inputBx">
                    <span>Password</span>
                    <input type="password" name="password" placeholder="Enter password">
                </div>
                <div class="remember">
                    <label><input type="checkbox"> Remember me</label>
                </div>
                <div class="inputBx">
                   
                    <input type="submit" value="Sign In" name="">
                </div>
                <div class="inputBx">
                   
                    <p>Don't have an acount ? <a href="signup.php">Sign Up</a></p>
                </div>
               
               
               
                
                
                

                </form>
                <div class="folloicon">
                    <a href="" class="socialmedia"> <i class="fa fa-2x fa-instagram"></i></a>
                    <a href="" class="socialmedia"><i class="fa fa-2x fa-facebook"></i></a>
                    
                    <a href="" class="socialmedia"><i class="fa fa-2x fa-twitter"></i></a>
                </div>
               
            </div>

        </div>

    </section>
    
</body>
</html>