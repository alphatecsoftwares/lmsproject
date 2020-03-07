<?php
session_start();
require_once "dbHandler.php";
$source=$_POST['source'];
function updateProfileDetails(){
    $con=getDBConnection();
    $user=$_SESSION["user_id"];
    $response=array();
    $location=$_POST['location'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $hashedPass=password_hash($_POST['password'], PASSWORD_BCRYPT);

            $sql="UPDATE customers SET fname=?, lname=?, email=?,location_id=?,password=? WHERE phone_number=?";
            $stmt =$con->prepare($sql);
            $stmt->bind_param("sssiss",$fname,$lname,$email,$location,$hashedPass,$user);
            $stmt->execute()?array_push($response,"200"):array_push($response,"500".mysqli_error($con));
            echo json_encode($response);
    // $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
    // $path = 'uploads/'; // upload directory
        // if(!empty($_FILES['file']))
        // {
        //     echo $_FILES['file'];
        //     $img = $_FILES['file']['name'];
        //     $tmp = $_FILES['file']['tmp_name'];
             // get uploaded file's extension
            //  $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            // check's valid format
            // if(in_array($ext, $valid_extensions)) 
            // { 
            //     $path = $path.strtolower($img); 
            //     if(move_uploaded_file($tmp,$path)) 
            //     {
            //         $status=200;//file successfully uploaded and saved
            //     }
            //  }
            //  else{
            //       $status=403;//forbidden file extension
            //  }
            //  PROFILE DETAILS WILL BW SAVED TO THE DB HERE
       
}

function saveLuggageStorageDetails(){
    $con=getDBConnection();
    $days=$_POST['days'];
    $luggageType=$_POST['ltype'];
    $name=$_POST['name'];
    $date_from=$_POST['datefrom'];
    $date_to=$_POST['dateto'];
    $location=$_POST['location'];
    $cost=getStorageCost($luggageType,$days);
    $phone=$_SESSION['user_id'];

    $sql="INSERT INTO luggagestorage(luggage_name, luggage_category_id, phone_number, store_from, store_to, cost,location_id) VALUES(?,?,?,?,?,?)";
    $stmt=$con->prepare($sql);
    $stmt->bind_param("sisssss",$name,$luggageType,$phone,$date_from,$date_to,$cost,$location);
    echo $stmt->execute()?"Successful":"Error ".mysqli_error($con);


}

function getStorageCost($luggageType,$days){
    $cost="";
    $con=getDBConnection();
    $sql="SELECT cost_per_day FROM luggagestoragecost WHERE luggage_category_id='$luggageType' LIMIT 1";
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $cost=$row['cost_per_day'];
        }
    }
    return $cost*$days;
}

// function returnStorageCost(){
//     $res=array();
//     $con=getDBConnection();
//     $sql2="SELECT distance FROM lms.distances WHERE ";
//     $sql="SELECT cost_per_day FROM lms.luggagestoragecost WHERE luggage_category_id='$luggageType' LIMIT 1";
//     $result=$con->query($sql);
//     if(mysqli_num_rows($result)>0){
//         while($row=mysqli_fetch_array($result)){
//             array_push($res,$row['cost_per_day']);
//         }
//     }
//     echo json_encode($res);
// }

function getDeliveryCost(){
    $luggageType=$_POST['ltype'];
    $location_from=$_POST['origin'];
     $location_to=$_POST['dest'];
    $cost=0;
    $total_cost=0;
    $con=getDBConnection();
    $sql="SELECT cost_per_km_per_kg FROM luggagedeliverycost WHERE luggage_category_id='$luggageType' LIMIT 1";
    $sql2="SELECT distance FROM distances WHERE location_from_id='$location_from' AND location_to_id='$location_to' OR location_from_id='$location_to' AND location_to_id='$location_from' LIMIT 1";
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $cost=$row['cost_per_km_per_kg'];
            $res=$con->query($sql2);
            if(mysqli_num_rows($res)>0){
              while($row=mysqli_fetch_array($res)){
                  $distance=$row['distance'];
                  $total_cost=$distance*$cost;
              }
        }
    }
}
    echo json_encode($total_cost);
}

function saveLuggageDeliveryDetails(){
    $con=getDBConnection();
    $origin=(int)$_POST["origin"];
    $name=$_POST["name"];
    $destination=(int)$_POST["destination"];
    $cost=(double)$_POST["cost"];
    $ltype=(int)$_POST["ltype"];
    $source=$_POST["source"];
    $tel=$_POST["tel"];
    $sender=$_SESSION['user_id'];
    $response=array();

    $sql="INSERT INTO luggagedelivery(luggage_name, sender_phone_number,
     recipient_phone_number, origin_id,destination_id, luggage_category_id, cost
    ) VALUES('$name','$sender','$tel','$origin','$destination','$ltype','$cost')";
//    echo  $stmt=$con->prepare($sql)?"":"error ".mysqli_error($con);
//     echo $stmt->bind_param("sssiiid",$name,$sender,$tel,$origin,$destination,$ltype,$cost);
    $con->query($sql)?array_push($response,200):array_push($response,500);
    echo json_encode($response);
}
function returnStorageCost(){
    $days=$_POST['days'];
    $ltype=$_POST['ltype'];
    echo json_encode(getStorageCost($ltype,$days));
}

function login(){
        $con=getDBConnection();
        $response=null;
        $user=mysqli_real_escape_string($con,$_POST['user']);
        $pass=mysqli_real_escape_string($con,$_POST['pass']);
        $dbPass="";

        $sql="SELECT password,phone_number FROM customers WHERE phone_number='$user' LIMIT 1";
        $result=$con->query($sql);
        if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $dbPass=$row['password']; 
        }
        if(password_verify($pass,$dbPass)){
            $response=200;
            $_SESSION['user_id']=$user;
        }else{
            $response=404;
            }
        }
        else{
        $response=300;
            
        }
    echo json_encode($response);
}

function register(){
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$location=$_POST['location'];
$tel=$_POST['tel'];
$hPassword="";
$passwaord=$_POST['password'];
$cpasswaord=$_POST['cpassword'];
$response=null;

if(checkUserExists($tel)){
$response=300;
}else{
if($passwaord===$cpasswaord){
$hPassword=password_hash($passwaord,PASSWORD_BCRYPT);
}

$con=getDBConnection();
$sql="INSERT INTO customers(fname, lname, phone_number, email,location_id, password) VALUES(?,?,?,?,?,?)";
$stmt=$con->prepare($sql);
$stmt->prepare($sql);
$stmt->bind_param("ssssis",$fname,$lname,$tel,$email,$location,$hPassword);
if($stmt->execute()){
  session_destroy();
  session_start();
  $_SESSION['user_id']=$tel;
  $response=200;
}else{
  $response=400;
}
}
echo json_encode($response);
}
function checkUserExists($user){
    $userExists=false;
    $con=getDBConnection();
    $sql="SELECT phone_number FROM customers WHERE phone_number=?";
    $stmt=$con->prepare($sql);
    $stmt->bind_param('s', $user);
    $stmt->execute();
    $result = $stmt->get_result();
    // $user = $result->fetch_object();
    if(mysqli_num_rows($result)>0){
        $userExists=true;
    }
    return $userExists;

}
 switch ($source) {
     case 'editprofile':
         updateProfileDetails();
         break;
    case 'requestluggagestorage':
         saveLuggageStorageDetails();
         break;
    case 'get-delivery-cost':
         getDeliveryCost();
         break;
    case 'requestluggagedelivery':
         saveLuggageDeliveryDetails();
         break;
    case 'get-storage-cost':
         returnStorageCost();
         break;
    case 'login-form':
         login();
         break;
    case 'register-form':
         register();
         break;
     
     default:
         
         break;
 }
?>