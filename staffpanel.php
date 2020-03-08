<?php
require_once "dbHandler.php";
session_start();
if(!isset($_SESSION['user_id'])||$_SESSION['user_type']!=2){//if user is not logged in,redirect to login

  header("Location: http://localhost/lmsproject/stafflogin.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LMS | Staff Panel</title>
    <link
      rel="stylesheet"
      href="./assets/bootstrap/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="./assets/main.css" />
  </head>
  <body>
    <div class="row">
      <div class="col-md-3">
        <div class="profile-seg text-center">
          <img
            class="profile-img rounded-circle my-2"
            src="./assets/images/user.png"
            alt="user"
          />
          <?php
          if(isset($_SESSION['user_id'])){
            $con=getDBConnection();
            $sql="SELECT fname, lname, phone_number, email FROM customers WHERE phone_number=? LIMIT 1";
            $stmt=$con->prepare($sql); $stmt->bind_param('s',
          $_SESSION['user_id']); $stmt->execute(); $result =
          $stmt->get_result(); // $user = $result->fetch_object();
          if(mysqli_num_rows($result)>0){
          while($row=mysqli_fetch_array($result)){ echo '
          <div class="text-light">'.$row['email'].'</div>
          '; echo '
          <div class="text-light">'.$row['fname'].' '.$row['lname'].'</div>
          '; echo '
          <div class="text-light">'.$row['phone_number'].'</div>
          '; } } } ?>
        </div>
        <div>
          <button id="home" class="w-100 nav-btn text-white text-left">
            <i class="fas fa-home mx-4"></i>
            Home
          </button>
        </div>
        <div>
          <button id="edit-profile" class="w-100 nav-btn text-white text-left">
            <i class="fas fa-edit mx-4"></i>
            Edit Profile
          </button>
        </div>
        <div>
          <button id="send-message" class="w-100 nav-btn text-white text-left">
            <i class="fas fa-plus mx-4"></i>
            Send message
          </button>
        </div>
        <div>
          <button id="add-category" class="w-100 nav-btn text-white text-left">
            <i class="fas fa-plus mx-4"></i>
            Add Luggage Category
          </button>
        </div>
        <div>
          <button id="add-location" class="w-100 nav-btn text-white text-left">
            <i class="fas fa-plus-circle mx-4"></i>
            Add Location
          </button>
        </div>
        <div>
          <div>
            <button
              id="edit-ls-cost"
              class="w-100 nav-btn text-white text-left"
            >
              <i class="fas fa-plus-circle mx-4"></i>
              Edit Luggage Storage Cost
            </button>
          </div>
          <div>
            <button
              id="edit-ld-cost"
              class="w-100 nav-btn text-white text-left"
            >
              <i class="fas fa-plus-circle mx-4"></i>
              Edit Luggage Delivery Cost
            </button>
          </div>
          <div>
            <button
              id="credit-account"
              class="w-100 nav-btn text-white text-left"
            >
              <i class="fa fa-money-check-alt mx-4"></i>
              Credit Account
            </button>
          </div>
          <div>
            <button
              id="cancel-delivery"
              class="w-100 nav-btn text-white text-left"
            >
              <i class="fas fa-times mx-4"></i>
              Cancel Delivery
            </button>
          </div>

          <div>
            <button
              id="notifications"
              class="w-100 nav-btn text-white text-left"
            >
              <i class="fas fa-envelope mx-4"></i>
              Notifications
            </button>
          </div>
          <div>
            <button id="logout" class="w-100 nav-btn text-white text-left">
              <i class="fas fa-sign-out-alt mx-4"></i>
              Log Out
            </button>
          </div>
        </div>
      </div>
      <div class="col-md-9 content-pane text-center mt-4">
        <h4>
          Welcome to LMS, Staff Panel
        </h4>
        <div id="content-pane"></div>
      </div>
    </div>
    <script src="./assets/jquery/dist/jquery.min.js"></script>
    <script src="./assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./assets/js/staffpanel.js"></script>
  </body>
</html>
