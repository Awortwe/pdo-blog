<?php require_once('./includes/header.php'); ?>
<?php 
  if(isset($_COOKIE['_ua_'])){
    header("Location: index.php");
  }
?>
    <div class="container">
        <h2 class="text-uppercase mt-5 sign-in" style="text-align:center">Sign In</h2>

        <?php 
            if(isset($_POST['submit'])){
                $user_name = trim($_POST['user_name']);
                $user_email = trim($_POST['user_email']);
                $user_password = trim($_POST['user_password']);

                if(empty($user_name) || empty($user_email) || empty($user_password)){
                    echo "<div class='alert alert-danger'>Fields cannot be empty!!</div>";
                }else{
                    $sql = "SELECT * FROM users";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    while($user = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $name = $user['user_name'];
                        $email = $user['user_email'];
                        $password = $user['user_password']; 
                        
                        if($user_name == $name && $user_email == $email && $user_password == $password){
                            setcookie('_ua_', md5(1), time()+60 * 20, '','','', true);
                            header("Location: index.php");
                        }else{
                            echo "<div class='alert alert-danger'>Wrong Credentials</div>";
                        }

                   }
                }
            }
        ?>

        <form action="sign-in.php" method="post" class="py-2 d-flex justify-content-center flex-column">
            <div class="form-group m-3">
                <label for="username">Username</label>
                <input name="user_name" type="text" class="form-control" id="username" placeholder="Enter Username">
            </div>
            <div class="form-group m-3">
                <label for="email">Email address</label>
                <input name="user_email" type="email" class="form-control" id="email" placeholder="Enter Email Address">
            </div>
            <div class="form-group m-3">
                <label for="password">Password</label>
                <input name="user_password" type="password" class="form-control" id="password" placeholder="Enter Password">
            </div>
            <button name="submit" type="submit" class="btn btn-primary m-3 align-self-end">SIGN IN</button>
        </form>
    </div>
<?php require_once('./includes/footer.php'); ?>