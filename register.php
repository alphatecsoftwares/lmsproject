<?php
require_once "dbHandler.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LMS | Register</title>
    <link
      rel="stylesheet"
      href="./assets/bootstrap/dist/css/bootstrap.min.css"
    />
  </head>
  <body>
    <div class="row justify-content-center my-5">
      <div class="col-md-6 border border-success rounded">
        <form autocomplete="off" id="register-form" method="POST">
          <div class="text-center my-3">
            <strong>Create Account</strong>
          </div>
          <div class="text-center my-3">
            <span class="msg">Create Account</span>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-9">
              <span id="msg"></span>
            </div>
          </div>
          <div class="row justify-content-center ">
            <div class="col-md-9 ">
              <div class="form-group d-flex">
                <input
                  type="text"
                  name="fname"
                  id="fname"
                  placeholder="First Name"
                  class="form-control mr-2"
                  required
                />
                <input
                  type="text"
                  name="lname"
                  id="lname"
                  placeholder="Last Name"
                  class="form-control mr-2"
                  required
                />
              </div>
            </div>
          </div>
          <div class="row justify-content-center ">
            <div class="col-md-9 ">
              <div class="form-group d-flex">
                <input
                  type="email"
                  name="email"
                  id="email"
                  placeholder="Email"
                  class="form-control mr-2"
                  required
                />
                <input
                  type="tel"
                  name="tel"
                  id="tel"
                  placeholder="07xxxxxxxxx"
                  class="form-control mr-2"
                  pattern="[0-9]{10}"
                  required
                />
              </div>
            </div>
          </div>

             <div class="row justify-content-center ">
            <div class="col-md-9 ">
              <div class="form-group d-flex">
                <input
                  type="password"
                  name="password"
                  id="password"
                  placeholder="Password"
                  class="form-control mr-2"
                  required
                />
                <input
                  type="password"
                  name="cpassword"
                  id="cpassword"
                  placeholder="Confirm Password"
                  class="form-control mr-2"
                  required
                />
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-md-9 ">
              <div class="form-group d-flex">
                <select
                  name="location"
                  id="location"
                  class="form-control mr-2"
                  required
                >
                  <option value="">Location</option>
             <?php
                  $con=getDBConnection();
                  $sql='SELECT * FROM lms.locations';
                  $result=$con->query($sql);
                    if(mysqli_num_rows($result)>0){//luggage categories exists ?
               while($row=mysqli_fetch_array($result)){//iterate thru' 'em and display the categories
                   echo '<option value='.$row['location_id'].'>'.$row['location_name'].'</option>';
               }
              }
        ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-md-9 ">
              <div class="form-group d-flex">
                <button type="reset" class="btn btn-outline-warning mx-4">
                  Clear All Fields
                </button>
                <button
                  type="submit"
                  name="submit"
                  id="changeprofile"
                  class="btn btn-outline-success"
                >
                  Register
                </button>
              </div>
            </div>
          </div>

          <div class="row justify-content-center mb-5">
            <div class="col-md-9 d-flex">
              <span>Already Have Account? <a href="login.php">Login</a></span>
              <span class="float-left"
                ><a href="index.html" class="ml-5">Go Back Home</a></span
              >
            </div>
          </div>
        </form>
      </div>
    </div>
      <script src="./assets/jquery/dist/jquery.min.js"></script>
      <script src="./assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/register.js"></script>
  </body>
</html>
<?php
if(isset($_POST['submit'])){

}

?>