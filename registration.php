<?php
    include 'connection.php';
    
    if(isset($_POST['rSignup']))
    {
        if(empty($_POST['rName'])
            || empty($_POST['rEmail'])
            || empty($_POST['rPassword'])
            || empty($_POST['rcPassword']))
        {
            $joy = '<div class="alert alert-warning
                    mt-2" role="alert">All Fields Are Required
                    </div>';
        }
        else
        {    
            $rname = $_POST['rName'];
            $remail = $_POST['rEmail'];
            $rpassword = md5($jo=$_POST['rPassword']);
            $rcpassword = md5($jj=$_POST['rcPassword']);
            
            #echo $rname;
            #echo $remail;
            #echo $rpassword;
            #echo $j;
            #echo $rname, $remail, $rpassword, $j;
            #echo $rname," ",$remail," ",
            #     $rpassword," ",$j;
            #echo $rname , "<br>";
            #echo $remail , "<br>";
            #echo $rpassword , "<br>";
            #echo $j , "<br>";
            #echo $rname,"<br>",$remail,
            #     "<br>",$rpassword,"<br>",$j,"<br>";
            #for($i=0;$i<strlen($jo);$i++)
            #{
            #    echo $jo[$i];
            #}
            #echo $jo;
            #echo "<br>";
            #echo strlen($jo);
            #echo "<br>";

            $sql = "SELECT requester_email FROM sign_up
                    WHERE requester_email='".$remail."'";
            
            $j = strlen($jo);
            
            if(mysqli_query($conn,$sql)->num_rows!=0)
            {
                $joy = '<div class="alert alert-warning
                        mt-2 role="alert">Email id is already registered</div>';
            }
            else if($j<8)
            {
                $joy = '<div class="alert alert-warning
                        mt-2 role="alert">The length of
                        password can not be less than
                        8</div>';
            }
            else if($j>=8)
            {
                $count=0;
                $count2=0;
                $count3=0;
                $count4=0;
                for($i=0;$i<strlen($jo);$i++)
                {
                    if($jo[$i]>='A' && $jo[$i]<='Z')
                    {
                        $count++;
                    }
                    if($jo[$i]>='a' && $jo[$i]<='z')
                    {
                        $count2++;
                    }
                    if($jo[$i]>='0' && $jo[$i]<='9')
                    {
                        $count3++;
                    }
                    if($jo[$i]=='!' || $jo[$i]=='@'
                        || $jo[$i]=='#' || $jo[$i]=='$'
                        || $jo[$i]=='%' || $jo[$i]=='^'
                        || $jo[$i]=='*' || $jo[$i]=='('
                        || $jo[$i]==')' || $jo[$i]=='_'
                        || $jo[$i]=='+' || $jo[$i]=='{'
                        || $jo[$i]=='}' || $jo[$i]=='['
                        || $jo[$i]==']' || $jo[$i]==';'
                        || $jo[$i]==':' || $jo[$i]=='\\'
                        || $jo[$i]=='|' || $jo[$i]==','
                        || $jo[$i]=='<' || $jo[$i]=='.'
                        || $jo[$i]=='>' || $jo[$i]=='/'
                        || $jo[$i]=='?')
                    {
                        $count4++;
                    }
                }
                if($count!=0 && $count2!=0
                    && $count3!=0 && $count4!=0)
                {
                    if($jo==$jj)
                    {
                        goto end;
                    }
                    else
                    {
                        $joy = '<div class="alert alert-warning
                        mt-2 role="alert">The cofirm password does
                        not match with the the previous
                        password</div>';
                    }
                }
                else
                {     
                    $joy = '<div class="alert alert-warning
                    mt-2 role="alert">The password must have
                    atleast a uppercase and a lowercase letter
                    and a digit and a numerical sign</div>';
                }
            }
            else
            {
                end:
                $str = "INSERT INTO sign_up(requester_name,
                                            requester_email,
                                            requester_password)
                        VALUES('".$rname."','".$remail."',
                                '".$rpassword."')";
        
                #echo $str;
                if(mysqli_query($conn,$str)) // or we can use $conn->query($str)
                {
                    $joy = '<div class="alert alert-success
                            mt-2 role="alert">
                            "Account Successfully Created"</div>';
                }
            }
        }
    }
?>

<div class="jumbotron container-fluid pt-5" id="registration">
    <h2 class="text-center">Create an Account</h2>
    <div class="row mt-4 mb-4">
        <div class="col-md-6 offset-md-3">
            <form action="" class="shadow-lg p-4" method="POST">
                <div class="form-group">
                    <i class="fas fa-user"></i> <label for="name"
                    class="font-weight-bold pl-2">Name</label><input
                    type="text" class="form-control" placeholder="Name"
                    name="rName">
                </div>
                <div class="form-group">
                    <i class="fas fa-user"></i> <label for="email"
                    class="font-weight-bold pl-2">Email</label><input
                    type="email" class="form-control" placeholder="Email"
                    name="rEmail">
                    <small class="form-text">We will never share your email with anyone</small>
                </div>
                <div class="form-group">
                    <i class="fas fa-key"></i> <label for="pass"
                    class="font-weight-bold pl-2">New Password</label><input
                    type="password" class="form-control" placeholder="Password"
                    name="rPassword">
                </div>
                <div class="form-group">
                    <i class="fas fa-key"></i> <label for="pass"
                    class="font-weight-bold pl-2">Confirm Password</label><input
                    type="password" class="form-control" placeholder="Confirm Password"
                    name="rcPassword">
                </div>
                <button type="submit" class="btn btn-danger mt-5 btn-block
                shadow-sm font-weight-bold" name="rSignup">Sign Up</button>
                <em style="font-size: 12px;">Note - By clicking Sigh Up, you agree to our terms,
                data policy and cookie policy<br></em>
                <?php
                    if(!empty($joy))
                    {
                        echo $joy;
                    }
                ?>
            </form>
        </div>
    </div>
</div>