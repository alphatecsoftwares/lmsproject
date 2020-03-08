<?php
require_once "dbHandler.php";
session_start();
if(!isset($_SESSION['user_id'])||$_SESSION['user_type']!=1){//if user is not logged in,redirect to login

  header("Location: http://localhost/lmsproject/stafflogin.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LMS | Admin Panel</title>
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
            $sql="SELECT fname, lname, phone_number, email FROM staff WHERE phone_number=? LIMIT 1";
            $stmt=$con->prepare($sql); $stmt->bind_param('s',$_SESSION['user_id']);
             $stmt->execute(); $result =
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
            Edit Your Profile
          </button>
        </div>
        <div>
          <button id="add-staff" class="w-100 nav-btn text-white text-left">
            <i class="fas fa-user-plus mx-4"></i>
            Add New Staff
          </button>
        </div>
        <div>
          <button id="remove-staff" class="w-100 nav-btn text-white text-left">
            <i class="fas fa-trash mx-4"></i>
            Remove Staff
          </button>
        </div>
   
        <div>
          <button
            id="delivery-reports"
            class="w-100 nav-btn text-white text-left"
          >
            <i class="fas fa-list mx-4"></i>
            Delevery Reports
          </button>
        </div>
        <div>
          <button
            id="booking-reports"
            class="w-100 nav-btn text-white text-left"
          >
            <i class="fas fa-sliders-h mx-4"></i>
            Booking Reports
          </button>
        </div>
        <div>
          <button id="notifications" class="w-100 nav-btn text-white text-left">
            <i class="fas fa-sliders-h mx-4"></i>
            Notifications
          </button>
        </div>
        <div>
          <button id="logout" class="w-100 nav-btn text-white text-left">
            <i class="fas fa-toggle-off mx-4"></i>
            Log Out
          </button>
        </div>
      </div>
      <div class="col-md-9 content-pane text-center mt-4" id="content-pane">
        <h4>
          Welcome to LMS, Here you find luggage logistics solutions for all
          types of luggages
        </h4>
      </div>
    </div>
    <script src="./assets/jquery/dist/jquery.min.js"></script>
    <script src="./assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./assets/js/adminpanel.js"></script>
  </body>
</html>
