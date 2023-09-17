<?php
session_start();

include "../include/database.php";

$_SESSION['error_msg']  = $_SESSION['success_msg'] = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $email = test_input($_POST['email']);
  $password = test_input($_POST['password']);


  $sql = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email';");

  $row = mysqli_fetch_array($sql);

  if ($email == $row['email'] && password_verify($password, $row['password'])) {
    $_SESSION['name'] = $row['name'];
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['success_msg'] = "<div class='alert alert-success'>Successfully login</div>";

    header("Location:../dashboard.php");
  } else {
    $_SESSION['error_msg'] = "<div class='alert alert-danger'>Email or password mismatch</div>";
  }

  // Check if there is an error in the session
  if (!empty($_SESSION['error_msg'])) {
    $errorMessage = $_SESSION['error_msg'];
    // Clear the error message from the session
    unset($_SESSION['error_msg']);
  }
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);

  return $data;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Title -->
  <title>Charpeg Restaurant Login</title>

  <!-- Favicon -->
  <!-- <link rel="shortcut icon" href="../favicon.ico"> -->

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet">

  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="../assets/css/vendor.min.css">

  <!-- CSS Front Template -->
  <link rel="stylesheet" href="../assets/css/theme.minc619.css?v=1.0">

  <link rel="preload" href="../assets/css/theme.min.css" data-hs-appearance="default" as="style">
  <link rel="preload" href="../assets/css/theme-dark.min.css" data-hs-appearance="dark" as="style">
  <script src="../js/script.js"></script>
  <!-- upper script -->
  <script src="../js/script.js"></script>
  <style data-hs-appearance-onload-styles>
    * {
      transition: unset !important;
    }

    body {
      opacity: 0;
    }
  </style>

</head>

<body>

  <script src="../assets/js/hs.theme-appearance.js"></script>

  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main" class="main">


    <!-- Content -->
    <div class="container py-5 py-sm-7">
      <a class="d-flex justify-content-center mb-5" href="index-2.html">
        <img class="zi-2" src="assets/svg/logos/logo.svg" alt="Logo of company" style="width: 8rem;">
      </a>

      <div class="mx-auto" style="max-width: 30rem;">
        <!-- Card -->
        <div class="card card-lg mb-5">
          <div class="card-body">
            <!-- Form -->
            <form action="" method="post">

              <!-- Adding the error and success messages  -->
              <center class="alert-msg"><span class="error"><?php echo isset($errorMessage) ? $errorMessage : ''; ?></span></center>

              <!-- Form -->
              <div class="mb-4">
                <label class="form-label" for="signinSrEmail">Email</label>
                <input type="email" class="form-control form-control-lg" name="email" id="signinSrEmail" tabindex="1" placeholder="email@address.com" aria-label="email@address.com" required value="<?php echo isset($email) ? $email : ''; ?>">

              </div>
              <!-- End Form -->

              <!-- Form -->
              <div class="mb-4">
                <label class="form-label w-100" for="signupSrPassword" tabindex="0">
                  <span class="d-flex justify-content-between align-items-center">
                    <span>Password</span>
                    <a class="form-label-link mb-0" href="#
                    forgot-password.php">Forgot Password?</a>
                  </span>
                </label>

                <div class="input-group input-group-merge" data-hs-validation-validate-class>
                  <input type="password" class="js-toggle-password form-control form-control-lg" name="password" id="signupSrPassword" placeholder="8+ characters required" aria-label="4+ characters required" required minlength="4" data-hs-toggle-password-options='{
                           "target": "#changePassTarget",
                           "defaultClass": "bi-eye-slash",
                           "showClass": "bi-eye",
                           "classChangeTarget": "#changePassIcon"
                         }'>
                  <a id="changePassTarget" class="input-group-append input-group-text" href="javascript:;">
                    <i id="changePassIcon" class="bi-eye"></i>
                  </a>
                </div>

              </div>
              <!-- End Form -->

              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Login in</button>
              </div>
            </form>
            <!-- End Form -->
          </div>
        </div>
        <!-- End Card -->

      </div>
    </div>
    <!-- End Content -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->



  <!-- JS Implementing Plugins -->
  <script src="../assets/js/vendor.min.js"></script>
  <!-- JS Front -->
  <script src="../assets/js/theme.min.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    (function() {
      window.onload = function() {

        // INITIALIZATION OF TOGGLE PASSWORD
        // =======================================================
        new HSTogglePassword('.js-toggle-password')
      }
    })()
  </script>

  <script>
    // Hide the success message after 3 seconds
    setTimeout(function() {
      var successMsg = document.querySelector('.alert-msg');
      successMsg.style.display = 'none';
    }, 2000);
  </script>
</body>

</html>