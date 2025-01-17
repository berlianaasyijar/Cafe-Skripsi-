<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register Cafe</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <span class="d-none d-lg-block">Cafe 99</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                      @csrf

                      <div class="col-12">
                          <label for="yourName" class="form-label">Name</label>
                          <input type="text" name="name" class="form-control" id="yourName" required>
                          <div class="invalid-feedback">Please enter your name.</div>
                      </div>

                      <div class="col-12">
                          <label for="yourUsername" class="form-label">Username</label>
                          <input type="text" name="username" class="form-control" id="yourUsername" required>
                          <div class="invalid-feedback">Please enter your username.</div>
                      </div>

                      <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                  </div>

                  <div class="col-12">
                      <label for="yourPasswordConfirmation" class="form-label">Confirm Password</label>
                      <input type="password" name="password_confirmation" class="form-control" id="yourPasswordConfirmation" required>
                      <div class="invalid-feedback">Please confirm your password!</div>
                      <small id="passwordMismatchError" class="text-danger d-none">Passwords do not match!</small>
                  </div>

                      <!-- <div class="col-12">
                          <label for="role" class="form-label">Role</label>
                          <select name="role" class="form-control" id="role" required>
                              <option value="admin">Admin</option>
                              <option value="user">User</option>
                          </select>
                          <div class="invalid-feedback">Please select your role.</div>
                      </div> -->

                      <div class="col-12">
                          <label for="email" class="form-label">Email</label>
                          <input type="email" name="email" class="form-control" id="email" required>
                          <div class="invalid-feedback">Please enter your email address.</div>
                      </div>
                      <div class="col-12">
                        <label for="foto" class="col-sm-2 col-form-label">Upload Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="foto" id="foto" class="form-control">
                        </div>
                      </div>
                      <div class="col-12">
                          <label for="no_hp" class="form-label">Phone Number</label>
                          <input type="text" name="no_hp" class="form-control" id="no_hp" required>
                          <div class="invalid-feedback">Please enter your phone number.</div>
                      </div>

                      <div class="col-12 mt-3">
                      <button class="btn btn-primary w-100" id="registerButton" type="submit" disabled>Register</button>
                  </div>
                  <div class="col-12">
                          <p class="small mb-0">As a Admin? <a href="{{ route('login') }}">Log in as an Admin</a></p>
                      </div>
                  </form>


                </div>
              </div>

              <div class="credits">
                Designed by Berliana Asyijar</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <script>
    // Get the DOM elements
    const passwordInput = document.getElementById('yourPassword');
    const confirmPasswordInput = document.getElementById('yourPasswordConfirmation');
    const registerButton = document.getElementById('registerButton');
    const mismatchError = document.getElementById('passwordMismatchError');

    // Function to validate passwords
    function validatePasswords() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (password === confirmPassword && password !== '') {
            registerButton.disabled = false;
            mismatchError.classList.add('d-none');
        } else {
            registerButton.disabled = true;
            mismatchError.classList.remove('d-none');
        }
    }

    // Add event listeners
    passwordInput.addEventListener('input', validatePasswords);
    confirmPasswordInput.addEventListener('input', validatePasswords);
</script>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>