<?php

##############################################################
### TABLES CREATION UTILITY FILE    ##########################
##############################################################
require_once 'dbHandler.php';

function createDB(){
    echo "Getting server Connection";
    $con=getServerConnection();
    $sql="CREATE DATABASE IF NOT EXISTS lms";
    echo $con->query($sql)? "Database lms created": "Database could not be created ".mysqli_error($con)."";
    
}
try {
    if(isset($_POST['submit']))
    createDB();//check if lms db exists if not create it
    createTables();
} catch (Exception $ex) {
    echo "Error ".$ex;
}

function createTables(){
     $con=getDBConnection();
if ( $con->query( "DESCRIBE `locations`" ) ) {
     echo "Table exists"; 
}
else{
      $sql1="CREATE TABLE locations(
            location_id INT AUTO_INCREMENT NOT NULL,
            location_name VARCHAR(40) NOT NULL,
            PRIMARY KEY(location_id)

        )";
        echo $con->query($sql1)?"Table locations created" :"Error Creating table ".mysqli_error($con)."";
        } 

    
      
    


           // sql to check if luggagecategories table exists
 if ( $con->query( "DESCRIBE `luggagecategories`" ) ) {
     echo "Table exists"; 
}
    else{
    
        $sql1="CREATE TABLE luggagecategories(
            category_id INT AUTO_INCREMENT NOT NULL,
            category_name VARCHAR(40) NOT NULL,
            PRIMARY KEY(category_id)

        )";
        echo $con->query($sql1)?"Table luggagecategories created" :"Error Creating table ".mysqli_error($con."");
    }




         // sql to check if luggagecategories table exists
   if ( $con->query( "DESCRIBE `stafftypes`" ) ) {
     echo "Table exists"; 
}
    else{
    
        $sql1="CREATE TABLE stafftypes(
            staff_type_id INT AUTO_INCREMENT NOT NULL,
            staff_type_name VARCHAR(40) NOT NULL,
            PRIMARY KEY(staff_type_id)

        )";
        if( $con->query($sql1)){
            $sql="INSERT INTO stafftypes(staff_type_id,staff_type_name) VALUES(?,?)";
            $stmt=$con->prepare($sql);
            $id=1;
            $name="admin";
            $stmt->bind_param("ss",$id,$name);
            echo $stmt->execute()? "Default user type created...":"Error ".mysqli_error($con);
        }
    }


    // sql to check if customers table exists
    if ( $con->query( "DESCRIBE `customers`" ) ) {
     echo "Table exists"; 
}
    else{
    
        $sql1="CREATE TABLE customers(
            fname VARCHAR(40) NOT NULL,
            lname VARCHAR(40) NOT NULL,
            phone_number VARCHAR(10) NOT NULL,
            email VARCHAR(50) NOT NULL,
            profile_path VARCHAR(100) NOT NULL,
            amount FLOAT NOT NULL DEFAULT 0,
            location_id INT NOT NULL,
            password VARCHAR(300) NOT NULL,
            PRIMARY KEY(phone_number),
            FOREIGN KEY(location_id) REFERENCES locations(location_id) ON DELETE CASCADE

        )";
        echo $con->query($sql1)?"Table customers created" :"Error Creating customer table ".mysqli_error($con)."";
    }

       // sql to check if staff table exists
     if ( $con->query( "DESCRIBE `staff`" ) ) {
     echo "Table exists"; 
}
    else{
    
        $sql1="CREATE TABLE staff(
            fname VARCHAR(40) NOT NULL,
            lname VARCHAR(40) NOT NULL,
            phone_number VARCHAR(10),
            email VARCHAR(50) NOT NULL,
            staff_type_id INT NOT NULL,
            password VARCHAR(300) NOT NULL,
            PRIMARY KEY(phone_number),
            FOREIGN KEY(staff_type_id) REFERENCES stafftypes(staff_type_id)

        )";
        if($con->query($sql1)){
            echo 'Table staff created';
            $adminDefaultPass = password_hash("admin", PASSWORD_BCRYPT);
            $sql="INSERT INTO staff(fname,lname,phone_number,email,staff_type_id,password) VALUES(?,?,?,?,?,?)";
            $stmt=$con->prepare($sql);
            $fname="admin";
            $lname="admin";
            $phone="";
            $email="admin@admin";
            $stafftype=1;
            $stmt->bind_param("ssssis",$fname,$lname,$phone,$email,$stafftype,$adminDefaultPass);
            echo  $stmt->execute()?"DEFAULT ADMIN CREATED... 🎓":mysqli_error($con)."";
        }else{
            echo "Error creating staff ".mysqli_error($con);
        }
    }
    // check if luggagedelivery table exists
     if ( $con->query( "DESCRIBE `luggagedelivery`" ) ) {
     echo "Table exists"; 
}
    else{
        $sql="CREATE TABLE luggagedelivery(
            luggage_id INT AUTO_INCREMENT,
            luggage_name VARCHAR(20) NOT NULL,
            sender_phone_number VARCHAR(10) NOT NULL,
            recipient_phone_number VARCHAR(10) NOT NULL,
            origin_id INT NOT NULL,
            destination_id INT NOT NULL,
            luggage_category_id INT NOT NULL,
            payment_id FLOAT NOT NULL,
            transaction_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY(luggage_id),
            FOREIGN KEY (destination_id) REFERENCES locations(location_id) ON DELETE CASCADE,
            FOREIGN KEY (origin_id) REFERENCES locations(location_id) ON DELETE CASCADE,
            FOREIGN KEY (sender_phone_number) REFERENCES customers(phone_number) ON DELETE CASCADE,
            FOREIGN KEY (recipient_phone_number) REFERENCES customers(phone_number) ON DELETE CASCADE,
            FOREIGN KEY (luggage_category_id) REFERENCES luggagecategories(category_id) ON DELETE CASCADE
        )";
        echo $con->query($sql)? "Table luggagedelivery created":"Error ".mysqli_error($con)."";
    }

    // check if luggagestorage table
      if ( $con->query( "DESCRIBE `luggagestorage`" ) ) {
     echo "Table exists"; 
}
    else{
        $sql="CREATE TABLE luggagestorage(
            luggage_id INT AUTO_INCREMENT,
            luggage_name VARCHAR(20) NOT NULL,
            luggage_category_id INT NOT NULL,
            phone_number VARCHAR(10) NOT NULL,
            store_from TIMESTAMP NOT NULL,
            store_to TIMESTAMP NOT NULL,
            payment_id FLOAT NOT NULL,
            location_id INT NOT NULL,
            PRIMARY KEY(luggage_id),
            FOREIGN KEY (phone_number) REFERENCES customers(phone_number) ON DELETE CASCADE,
            FOREIGN KEY (luggage_category_id) REFERENCES luggagecategories(category_id) ON DELETE CASCADE,
            FOREIGN KEY (location_id) REFERENCES locations(location_id) ON DELETE CASCADE

        )";
        echo $con->query($sql)? "Table luggagedelivery created":"Error ".mysqli_error($con)."";
    }
     
    

     // check if messages table
        if ( $con->query( "DESCRIBE `messages`" ) ) {
     echo "Table exists"; 
}
    else{
        $sql="CREATE TABLE messages(
            message_id INT AUTO_INCREMENT NOT NULL,
            from_id VARCHAR(10) NOT NULL,
            to_id VARCHAR(10) NOT NULL,
            message VARCHAR(2000) NOT NULL,
            date_created timestamp DEFAULT CURRENT_TIMESTAMP,
            status BOOLEAN DEFAULT 0,
            PRIMARY KEY(message_id),
            FOREIGN KEY (from_id) REFERENCES customers(phone_number) ON DELETE CASCADE,
            FOREIGN KEY (to_id) REFERENCES customers(phone_number) ON DELETE CASCADE
        )";
        echo $con->query($sql)? "Table messages created":"Error ".mysqli_error($con)."";
    }


     // check if distances table exist
          if ( $con->query( "DESCRIBE `distances`" ) ) {
     echo "Table exists"; 
}
    else{
        $sql="CREATE TABLE distances(
            distance_id INT AUTO_INCREMENT,
            location_from_id INT NOT NULL,
            location_to_id INT NOT NULL,
            distance DOUBLE NOT NULL,
            PRIMARY KEY(distance_id),
            FOREIGN KEY (location_from_id) REFERENCES locations(location_id) ON DELETE CASCADE,
            FOREIGN KEY (location_to_id) REFERENCES locations(location_id) ON DELETE CASCADE
        )";
        echo $con->query($sql)? "Table distances created":"Error ".mysqli_error($con)."";
    }


     // check if luggagestoragecost table exist
          if ( $con->query( "DESCRIBE `luggagestoragecost`" ) ) {
     echo "Table exists"; 
}
    else{
        $sql="CREATE TABLE luggagestoragecost(
            luggage_storage_cost_id INT AUTO_INCREMENT,
            luggage_category_id INT NOT NULL,
            cost_per_day FLOAT NOT NULL,
            cost_per_hour FLOAT NOT NULL,
            min_cost FLOAT NOT NULL,
            PRIMARY KEY(luggage_storage_cost_id ),
            FOREIGN KEY (luggage_category_id) REFERENCES luggagecategories(category_id) ON DELETE CASCADE
        )";
        echo $con->query($sql)? "Table distances created":"Error ".mysqli_error($con)."";
    }


     // check if luggagestoragecost table exist
            if ( $con->query( "DESCRIBE `luggagedeliverycost`" ) ) {
     echo "Table exists"; 
}
    else{
        $sql="CREATE TABLE luggagedeliverycost(
            luggage_delivery_cost_id INT AUTO_INCREMENT,
            luggage_category_id INT NOT NULL,
            cost_per_km_per_kg FLOAT NOT NULL,
            min_cost FLOAT NOT NULL,
            PRIMARY KEY(luggage_delivery_cost_id),
            FOREIGN KEY (luggage_category_id) REFERENCES luggagecategories(category_id) ON DELETE CASCADE
        )";
        echo $con->query($sql)? "Table luggagedeliverycost created":"Error ".mysqli_error($con)."";
    }

    


}
?>