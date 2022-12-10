 <?php

require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST")
{

    // Check if username is empty
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Username cannot be blank";
    }
    else
    {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                    
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT );

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: StockApp/charts/BTC/index.html");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}




// require_once "config.php";
// $username = $password = $confirm_password = "";
// $username_err = $password_err = $confirm_password_err = "";

// if($_SERVER['REQUEST_METHOD'] == "POST"){
//     // check if username is empty
//     if(empty(trim($_POST["username"]))){
//         $username_err = "Username Cannot be blank";
//     }
//     else{
//         $sql = "SELECT id FROM users WHERE username = ?";
//         $stmt = mysqli_prepare($conn, $sql);
//         if($stmt){
//             mysqli_stmt_bind_param($stmt , "s", $param_username);
//             // set the value of param username
//             $param_username = trim($_POST['username']);

//             // try to execute this statement
//             if(mysqli_stmt_execute($stmt)){
//                 mysqli_stmt_store_result($stmt);
//                 if(mysqli_stmt_num_rows($stmt) == 1)
//                 {
//                     $username_err = "This username is already taken";
//                 }
//                 else{
//                     $username = trim($_POST['username']);

//                 }

//             }
//             else{
//                 echo "Something went worng";
//             }



//         }




//     }
//     mysqli_stmt_close($stmt);


//   /// check password

//    if(empty(trim($_POST['password']))){
//     $password_err = "Password cannot be taken";

//     }
//     elseif(strlen(trim($_POST['password'])) < 5){
//     $password_err = "Password cannot be less than 5 characters";
//    }else{
//     $password = trim($_POST['password']);
//    }
//    /// check for confirm password
//     if(trim($_POST['confirm_password']) != (trim($_POST['password'])){
//     $password_err = "Password should match"

//   }

//    // if there were no error ,go ahead insert data in to database

//      (empty($username_err) && empty($password_err) && empty($confirm_password_err))
//          {
//                  $sql = "INSERT INTO users (username, password) VALUES (?, ?)"
//                  $stmt = mysqli_prepare($conn , $sql);
//                    if($stmt)
//                    {
//                         mysqli_stmt_bind_param($stmt,"ss",$param_username,$param_password);
//                         // set this parameter
//                         $param_username = $username;
//                         $param_password = password_hash($password , PASSWORD_DEFAULT);
//                         // try to execute the query
//                         if(mysqli_stmt_execute($stmt))
//                             {
//                                 header("location: login.php");
//                             }
//                             else
//                             {
//                                 echo "Something went wrong .... cannot redirect";
//                             }

//                     }
//                  mysqli_stmt_close($stmt);

//          }
//     mysqli_close($conn);

// }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src="https://www.gstatic.com/firebasejs/9.1.3/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.1.3/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.1.3/firebase-database.js"></script> -->
    <!-- <script src="login.js"></script> -->



</head>
<body>
 



    <section>
       

        <div class="imgBx">
            <img src="stockbg.jpg" alt="" srcset="">
        </div>
        <div class="formcontainer">
            <div class="formBx">
                <h2>SignUp</h2>
                <a href="index.php"><i class="fa fa-2x fa-home"></i></a>
               
                <form action="" method="post" >
                <div class="inputBx">
                        <span>username</span>
                        <input type="text" name="username" required>
                </div>
                <?php 
                echo $username_err;
                ?>
                <div class="inputBx">
                    <span>Mobile Number</span>
                    <input type="text" name="" required>
                 </div>
                 <div class="inputBx">
                     <span>Email</span>
                     <input type="email" id="email" name="" required>
                 </div>
                 <div class="inputBx">
                    <span>Password</span>
                    <input type="password" id="password"  name="password" required>
                </div>
                <div class="inputBx">
                    <span>Confirm Password</span>
                    <input type="password" name="confirm_password" required>
                </div>
                <div class="inputBx">
                   
                    <input type="submit"  onclick="signup()" id="signup"   value="SignIn" name="">
                </div>
                <div class="inputBx">
                   
                    <p>Don't have an acount ? <a href="/login.php">Sign In</a></p>
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


    <!-- <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.1.3/firebase-app.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries
      
        // Your web app's Firebase configuration
        const firebaseConfig = {
          apiKey: "AIzaSyA2OuEYOx7Oc19_n4e8mQoYU1E5ee3yo_Q",
          authDomain: "login-736dc.firebaseapp.com",
          databaseURL: "https://login-736dc-default-rtdb.firebaseio.com",
          projectId: "login-736dc",
          storageBucket: "login-736dc.appspot.com",
          messagingSenderId: "691819323065",
          appId: "1:691819323065:web:7f7f596e60eb9591144568"
        };
      
        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const auth = firebase.auth();

        function signup()
         {
                   var email = document.getElementById("email");
                   var password = document.getElementById("password");
                   const promise = auth.CreateUserWithEmailAndPassword(email.value,password.value);
                   promise.catch(e=> alert(e.message));
                   alert("signed in")
        }

      </script> -->
</body>
</html>