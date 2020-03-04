<?php
require_once "dbHandler.php";
$source= $_POST['source'];

function updateProfileDetails(){
    $con=getDBConnection();
    $status=0;
    $location=$_POST['location'];
    $source=$_POST['source'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $tel=$_POST['tel'];
    $hashedPass=password_hash($_POST['password'], PASSWORD_BCRYPT);


        $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
        $path = 'uploads/'; // upload directory
        if(!empty($_FILES['file']))
        {
            $img = $_FILES['file']['name'];
            $tmp = $_FILES['file']['tmp_name'];
             // get uploaded file's extension
             $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            // check's valid format
            if(in_array($ext, $valid_extensions)) 
            { 
                $path = $path.strtolower($img); 
                if(move_uploaded_file($tmp,$path)) 
                {
                    $status=200;//file successfully uploaded and saved
                }
             }
             else{
                  $status=403;//forbidden file extension
             }
            //  PROFILE DETAILS WILL BW SAVED TO THE DB HERE
            $filepath=$img;
            $sql="UPDATE customers SET fname=?, lname=?, phone_number=?, email=?,location_id=?,password=?, profile_path=? WHERE phone_number=?";
            $stmt =$con->prepare($sql);
            $stmt->bind_param("ssssisss",$fname,$lname,$tel,$email,$location,$hashedPass,$path,$tel);
            echo $stmt->execute()?"Details Updated Successfully": "Error while updating ".mysqli_error($con);
        }
        else{
            $status=400;//no content in uploaded
            }
            echo $status;
}

function saveLuggageStorageDetails(){
    $luggageType=$_POST['ltype'];
    $name=$_POST['name'];
    $date_from=$_POST['datefrom'];
    $date_to=$_POST['dateto'];
    $location=$_POST['location'];
    $cost=getStorageCost($luggageType);
    $phone="0777777777";

    $sql="INSERT INTO luggagestorage(luggage_name, luggage_category_id, phone_number, store_from, store_to, cost) VALUES(?,?,?,?,?,?)";
    $stmt=$con->prepare($sql);
    $stmt->bind_param("sissss",$name,$luggageType,$phone,$date_from,$date_to,$cost);
    echo $stmt->execute()?"Successful":"Error ".mysqli_error($con);


}

function getStorageCost($luggageType){
    $cost="";
    $con=getDBConnection();
    $sql="SELECT cost_per_day FROM luggagestoragecost WHERE luggage_category_id='$luggageType' LIMIT 1";
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $cost=$row['cost_per_day'];
        }
    }
    return $cost;
}

function getDeliveryCost($luggageType){
    $cost="";
    $con=getDBConnection();
    $sql="SELECT cost_per_km_per_kg FROM luggagedeliverycost WHERE luggage_category_id='$luggageType' LIMIT 1";
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $cost=$row['cost_per_km_per_kg'];
        }
    }
    return $cost;
}
 switch ($source) {
     case 'editprofile':
         updateProfileDetails();
         break;
     
     default:
         
         break;
 }
?>