<?php 

require_once '../controllers/AuthController.php';

$auth = new AuthController($db);

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    if($password == $passwordConfirm){
        $auth->register($username, $password);

        echo "<script>alert('Registrasi berhasil, silahkan login!');</script>";
        echo "<script>window.location.href = 'login.php';</script>";
    }
    
}

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - SB Admin</title>
        <link href="../public/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="text" name="username" placeholder="name@example.com" oninput="checkUsername(this.value)" />
                                                <label for="inputEmail">Username</label>
                                            </div>
                                            <p id="messageUsername" style="color: red"></p>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Create a password"/>
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" name="passwordConfirm" oninput="checkPasswordConfirm(this.value)"/>
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                        <small id="passwordError" class="text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <button class="btn btn-primary w-100" name="register" type="submit">Register</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script>
            const usernames = <?php echo json_encode($auth->getAllUsernames()); ?>;

            const inputUsername = document.getElementById('inputEmail');
            const messageUsername = document.getElementById('messageUsername');

            function checkUsername(input) {
                if (input === '') {
                    messageUsername.innerHTML = '';
                    return;
                }
                if (usernames.includes(input)) {
                    messageUsername.innerHTML = 'Username telah digunakan';
                } else {
                    messageUsername.innerHTML = '';
                }
            }

            // Tambahkan listener untuk mengecek username saat pengguna mengetik
            inputUsername.addEventListener('input', function () {
                checkUsername(inputUsername.value);
            });

            const inputPassword = document.getElementById('inputPassword');
            const inputPasswordConfirm = document.getElementById('inputPasswordConfirm');
            const passwordError = document.getElementById('passwordError');

            function checkPasswordConfirm(input) {
                if (input === '') {
                    passwordError.textContent = ''; // Hapus pesan jika kosong
                    inputPasswordConfirm.setCustomValidity('');
                    return;
                }
                if (inputPassword.value !== input) {
                    passwordError.textContent = 'Password tidak cocok';
                    inputPasswordConfirm.setCustomValidity('Password tidak cocok');
                } else {
                    passwordError.textContent = '';
                    inputPasswordConfirm.setCustomValidity('');
                }
            }

        </script>

    </body>
</html>
