<?php
require_once "dbHandler.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LMS |Login</title>
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/bootstrap/dist/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/font-awesome.min.css"
    />
  </head>
  <body>
    <div class="row justify-content-center  my-5">
      <div class="col-md-5 border border-success rounded">
        <form
          class="my-5"
          autocomplete="off"
          id="login-form"
          method="POST"
        >
          <div class="text-center my-3">
            Login
          </div>
            <div class="text-center my-3">
            <span id="msg"></span>
          </div>

          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="form-group d-flex">
                <input
                  type="text"
                  name="phone"
                  id="phone"
                  placeholder="Phone"
                  class="form-control"
                />
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="form-group d-flex">
                <input
                  type="password"
                  name="password"
                  id="password"
                  placeholder="Password"
                  class="form-control"
                />
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-md-8 ">
              <div class="form-group d-flex">
                <button
                  id="submit"
                  class="btn btn-outline-success w-25"
                >
                  Login
                </button>
              </div>
            </div>
          </div>

          <div class="row justify-content-center my-4">
            <div class="col-md-8 ">
              <div id="register " class="d-flex">
                <span>
                  Don't Have Account? <a href="register.php">Register</a>
                </span>
                <span class="float-left">
                  <a href="index.html" class="ml-3">Go Back Home</a>
                </span>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
     <script src="./assets/jquery/dist/jquery.min.js"></script>
    <script src="./assets/js/login.js"></script>
  </body>
</html>
<!-- 


//   }
// }
// } -->

