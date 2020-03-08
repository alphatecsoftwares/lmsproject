<div class="container mt-3">
  <div class="row">
    <div class="col-sm-10">
      <div class="chatbody">
        <div class="panel panel-primary">
          <div class="panel-heading top-bar">
            <div class="col-md-8 col-xs-8">
              <h3 class="panel-title">
                <span class="fa fa-envelope mt-3"></span> Message Body
              </h3>
            </div>
          </div>
          <div class="panel-body msg_container_base">
            <div class="row msg_container base_receive">
              <div class="col-md-10 col-xs-10">
                <div class="messages msg_receive">
                  <p>
                    <?php
                        $_POST = json_decode(file_get_contents('php://input'), true);
                        $msg_id=$_POST['message_id'];
                        require_once "dbHandler.php";
                            $con=getDBConnection();
                            $sql2="UPDATE messages SET status=? WHERE message_id=?";
                            $status=1;
                            $st=$con->prepare($sql2);
                            $st->bind_param('is',$status,$msg_id);
                            $res=$st->execute();//toggle this message to read status
                            $sql="SELECT date_created, from_id, message FROM messages WHERE message_id=? ORDER BY date_created ASC";
                            $stmt=$con->prepare($sql); 
                            $stmt->bind_param('s',$msg_id);
                             $stmt->execute();
                              $result = $stmt->get_result();
                    if( mysqli_num_rows($result)){
                    while($row=mysqli_fetch_array($result)){ echo
                    $row['message']; } } ?>
                  </p>
                  <time datetime="2009-11-13T20:00">
                    <?php
                        $_POST = json_decode(file_get_contents('php://input'), true);
                         $msg_id=$_POST['message_id'];
                           require_once "dbHandler.php";
                        $con=getDBConnection();
                         $sql="SELECT date_created FROM messages WHERE message_id=?";
                        $stmt=$con->prepare($sql); $stmt->bind_param('s',
                    $msg_id); $stmt->execute(); $result = $stmt->get_result();
                    if( mysqli_num_rows($result)){
                    while($row=mysqli_fetch_array($result)){ echo
                    $row['date_created']; } } ?>
                  </time>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
