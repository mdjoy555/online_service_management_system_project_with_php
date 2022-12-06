<?php
    include 'connection.php';

    if(isset($_POST['submit']))
    {
        if(empty($_POST['name'])
            || empty($_POST['subject'])
            || empty($_POST['email'])
            || empty($_POST['message']))
        {
            $joyy = '<div class="alert alert-warning
            mt-2" role="alert">All Fields Are Required
            </div>';
        }
        else
        {
            $cname = $_POST['name'];
            $csubject = $_POST['subject'];
            $cemail = $_POST['email'];
            $cmessage = $_POST['message'];
            
            #echo $cname;
            #echo "<br>";
            #echo $csubject;
            #echo "<br>";
            #echo $cemail;
            #echo "<br>";
            #echo $cmessage;
            #echo "<br>";

            $sql = "SELECT requester_email FROM sign_up
                    WHERE requester_email='".$cemail."'";
            
            if(mysqli_query($conn,$sql)->num_rows!=0)
            {
                $str = "INSERT INTO contact(c_name,
                        c_subject,c_email,c_description)
                        VALUES('".$cname."','".$csubject."',
                        '".$cemail."','".$cmessage."')";
                
                if(mysqli_query($conn,$str))
                {
                    $id = mysqli_insert_id($conn);
                    $joyy = '<div class="alert alert-success
                            mt-2 role="alert">Successfully
                            Sent<br>Your contact request id
                            is '.$id.'</div>';
                }
            }
            else
            {
                $joyy = '<div class="alert alert-danger
                        mt-2 role="alert">You have to
                        sign up first to contact with
                        us</div>';
            }
        }
    }
?>

<div class="jumbotron container-fluid" id="Contact">
    <h2 class="text-center mt-5">Contact Us</h2>
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-4">
            <form action="" method="POST">
                <input type="text" class="form-control"
                name="name" placeholder="Name"><br>
                <input type="text" class="form-control"
                name="subject" placeholder="Subject"><br>
                <input type="email" class="form-control"
                name="email" placeholder="Email"><br>
                <textarea class="form-control" name="message"
                placeholder="How can we help you?"
                style="height: 150px;"></textarea><br>
                <input type="submit" class="btn btn-primary" value="send"
                name="submit"><br><br>
                <?php
                    if(!empty($joyy))
                    {
                        echo $joyy;
                    }
                ?>
            </form>
        </div>
    </div>
</div>