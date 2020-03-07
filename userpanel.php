<?php
require_once "dbHandler.php";
session_start();
if(!isset($_SESSION['user_id'])){
  header("Location: http://localhost/lmsproject/login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LMS | Users Panel</title>
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
            $stmt=$con->prepare($sql);
                $stmt->bind_param('s', $_SESSION['user_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                // $user = $result->fetch_object();
                if(mysqli_num_rows($result)>0){
                  while($row=mysqli_fetch_array($result)){
                    echo '<div class="text-light">'.$row['email'].'</div>';
                    echo '<div class="text-light">'.$row['fname'].' '.$row['lname'].'</div>';
                    echo '<div class="text-light">'.$row['phone_number'].'</div>';
                  }
                }
            }
          ?>
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
        <div class="">
          <button id="account" class="w-100 nav-btn text-white text-left">
            <i class="fas fa-envelope mx-4"></i>
            Account
          </button>
        </div>
        <div>
          <button
            id="request-luggage-storage"
            class="w-100 nav-btn text-white text-left"
          >
            <i class="fas fa-luggage-cart mx-4"></i>
            Book Luggage Storage
          </button>
        </div>
        <div>
          <button
            id="request-package-delivery"
            class="w-100 nav-btn text-white text-left"
          >
            <i class="fas fa-truck mx-4"></i>
            Request Luggage Delivery
          </button>
        </div>
        <div>
          <button
            id="check-luggage-status"
            class="w-100 nav-btn text-white text-left"
          >
            <i class="fas fa-project-diagram mx-4"></i>
            Check Luggage Transit Status
          </button>
        </div>
        <div class="">
          <button id="notifications" class="w-100 nav-btn text-white text-left">
            <i class="fas fa-envelope mx-4"></i>
            Notifications
            <span id="numofnotifications" class="badge badge-info">0</span>
          </button>
        </div>

        <div>
          <button id="logout" class="w-100 nav-btn text-white text-left">
            <i class="fas fa-toggle-off mx-4"></i>
            Log Out
          </button>
        </div>
      </div>
      <div class="col-md-9 content-pane text-center mt-4">
        <h4>
          Welcome {Name Here} To LMS Portal. The premier luggage management
          sytem
        </h4>
        <div id="content-pane"></div>
      </div>
    </div>
    <script src="./assets/jquery/dist/jquery.min.js"></script>
    <script src="./assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./assets/js/userpanel.js"></script>
  </body>
</html>
