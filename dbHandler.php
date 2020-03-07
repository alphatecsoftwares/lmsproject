<?php

function getDBConnection(){
    $SERVER_NAME="127.0.0.1";
    $USERRNAME="root";
    $PASS="";
    $DB_NAME="lms";
    $con=null;
    // create connection to the database
    if(!$con){
    $con=new mysqli($SERVER_NAME,$USERRNAME,$PASS,$DB_NAME);
    }
    return $con;
}

function getServerConnection(){
     $SERVER_NAME="127.0.0.1";
    $USERRNAME="root";
    $PASS="";
    // create connection to the server
    $con=new mysqli($SERVER_NAME,$USERRNAME,$PASS);
    return $con;
}
function executeSQLQuery($q){
    $result=getDBConnection()->query($q);
    return $result;
}

?>
