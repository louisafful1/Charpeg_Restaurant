



<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Title -->
  <title>Default Sidebar (Classic) | Front - Admin &amp; Dashboard Template</title>

  <!-- Favicon -->
  <!-- <link rel="shortcut icon" href="../favicon.ico"> -->

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet">

  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="../resource/assets/css/vendor.min.css">

  <!-- CSS Front Template -->
  <link rel="stylesheet" href="../resource/assets/css/theme.minc619.css?v=1.0">

  <link rel="preload" href="../resource/assets/css/theme.min.css" data-hs-appearance="default" as="style">
  <link rel="preload" href="../resource/assets/css/theme-dark.min.css" data-hs-appearance="dark" as="style">

  <!-- upper script -->
  <script src="../resource/js/script.js" ></script>
  <style data-hs-appearance-onload-styles>
    *
    {
      transition: unset !important;
    }

    body
    {
      opacity: 0;
    }
  </style>

</head>

<body>

<script src="../resource/assets/js/hs.theme-appearance.js"></script>

  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main" class="main">


    <!-- Content -->
    <div class="container py-5 py-sm-7">
      <a class="d-flex justify-content-center mb-5" href="index-2.html">
        <img class="zi-2" src="assets/svg/logos/logo.svg" alt="Image Description" style="width: 8rem;">
      </a>

      <div class="mx-auto" style="max-width: 30rem;">
        <!-- Card -->
        <div class="card card-lg mb-5">
          <div class="card-body">
            <!-- Form -->
            <form class="js-validate needs-validation" novalidate>
              <div class="text-center">
                <div class="mb-5">
                  <h1 class="display-5">Forgot password?</h1>
                  <p>Enter the email address you used when you joined and we'll send you instructions to reset your password.</p>
                </div>
              </div>

              <!-- Form -->
              <div class="mb-4">
                <label class="form-label" for="resetPasswordSrEmail" tabindex="0">Your email</label>

                <input type="email" class="form-control form-control-lg" name="email" id="resetPasswordSrEmail" tabindex="1" placeholder="Enter your email address" aria-label="Enter your email address" required>
                <span class="invalid-feedback">Please enter a valid email address.</span>
              </div>
              <!-- End Form -->

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>

                <div class="text-center">
                  <a class="btn btn-link" href="login.php">
                    <i class="bi-chevron-left"></i> Back to Sign in
                  </a>
                </div>
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
<script src="../resource/assets/js/vendor.min.js"></script>
<!-- JS Front -->
<script src="../resource/assets/js/theme.min.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    (function() {
      window.onload = function () {

        // INITIALIZATION OF TOGGLE PASSWORD
        // =======================================================
        new HSTogglePassword('.js-toggle-password')
      }
    })()
  </script>
</body>

</html>