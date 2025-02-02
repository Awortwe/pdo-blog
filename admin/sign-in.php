<?php require_once('./includes/header.php'); ?>
    <div class="container">
        <h2 class="text-uppercase mt-5 sign-in" style="text-align:center">Sign In</h2>

        <form class="py-2 d-flex justify-content-center flex-column">
            <div class="form-group m-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter Username">
            </div>
            <div class="form-group m-3">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter Email Address">
            </div>
            <div class="form-group m-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter Password">
            </div>
            <button type="submit" class="btn btn-primary m-3 align-self-end">SIGN IN</button>
        </form>
    </div>
<?php require_once('./includes/footer.php'); ?>