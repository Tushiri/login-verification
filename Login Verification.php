<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
	<style>
		body {
			background-color: #f7f7f7;
		}
		.form-container {
			margin-top: 50px;
			background-color: #fff;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
		}
	</style>
</head>
<body>
<?php
session_start();

$max_attempts = 3;
	
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == 'user' && $password == 'password') {
        echo '<h1>Welcome ' . $username . '!</h1>';
        unset($_SESSION['failed_attempts']);
        exit();
    } else {
        if (isset($_SESSION['failed_attempts'])) {
            $_SESSION['failed_attempts']++;
        } else {
            $_SESSION['failed_attempts'] = 1;
        }
        if ($_SESSION['failed_attempts'] >= $max_attempts) {
            echo '<script>alert("Sorry, you have exceeded the maximum number of attempts. Please try again after 30 minutes.");</script>';
            echo '<script>document.getElementById("login_form").disabled = true;</script>';
        } else {
            echo '<script>alert("Incorrect username or password. You have ' . ($max_attempts - $_SESSION['failed_attempts']) . ' attempts remaining.");</script>';
        }
    }
}
?>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<form method="post" action="" class="form-container" id="login_form">
					<h2 class="text-center mb-4">Login Verification Form</h2>
					<div class="form-group">
						<label>Username:</label>
						<input type="text" name="username" class="form-control" placeholder="Enter your username" required>
					</div>
					<div class="form-group">
						<label>Password:</label>
						<input type="password" name="password" class="form-control" placeholder="Enter your password" required>
					</div>
                        <div class="d-grid gap-2">
							<br>
                            <button class="btn btn-primary" type="submit" value="Login">submit</button>
                        </div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
