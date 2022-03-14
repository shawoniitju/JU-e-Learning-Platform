<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_e_learning");
    include("functions.php");
    $dow = check_login($con);
    $uid = $dow['u_id'];
    $sql = "select * from user natural join teacher natural join dept where u_id= '$uid' limit 1 ";
    $resl = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($resl);
    $fname = $row['fname'];
    $lname = $row['lname'];
   // $password = md5($row['password']);
    $email = $row['email'];
    $phone = $row['phone'];
    $dname = $row['dept_name'];
    $thana = $row['thana'];
    $district = $row['district'];
    $dp = $row['dp'];
    $house = $row['house_no'];
    $bg = $row['bg'];
    $idphoto = $row['id_image'];
    $rinterest = $row['rinterest'];
    $designition = $row['designition'];

    if (isset($_POST['upload'])) {
          $str = bin2hex(random_bytes(15));
        if (!empty($_FILES["dp"]["name"])) {
            $dpphoto = $_FILES["dp"]["name"];
            $extension = strtolower(substr(strrchr($dpphoto, '.'), 1));
            $newfilename = $uid . "_dp" .$str."." . $extension;
            $dp = "dbfiles/" . $newfilename;
            $tempname = $_FILES["dp"]["tmp_name"];
            move_uploaded_file($tempname, $dp);
        }

        if (!empty($_FILES["idphoto"]["name"])) {
            $iphoto = $_FILES["idphoto"]["name"];
            $tempnamee = $_FILES["idphoto"]["tmp_name"];
            $extensionn = strtolower(substr(strrchr($iphoto, '.'), 1));
            $newfilenamee = $uid . "_idphoto" .$str. "." . $extensionn;
            $idphoto = "dbfiles/" . $newfilenamee;
            move_uploaded_file($tempnamee, $idphoto);
        }

        if (!empty($_POST['fname']))
            $fname = $_POST['fname'];
        if (!empty($_POST['lname']))
            $lname = $_POST['lname'];
        if (!empty($_POST['email']))
            $email = $_POST['email'];
        if (!empty($_POST['password']))
            $password = md5($_POST['password']);
        if (!empty($_POST['phone']))
            $phone = $_POST['phone'];
        if (!empty($_POST['house']))
            $house = $_POST['house'];
        if (!empty($_POST['thana']))
            $thana = $_POST['thana'];
        if (!empty($_POST['district']))
            $district = $_POST['district'];
        if (!empty($_POST['bg']))
            $bg = $_POST['bg'];


        if (!empty($_POST['rinterest']))
            $rinterest = $_POST['rinterest'];
        if (!empty($_POST['designition']))
            $designition = $_POST['designition'];


        $query = "update  teacher set designition='$designition', rinterest='$rinterest' where u_id='$uid'";
        mysqli_query($con, $query);
        $sql = "update user set fname='$fname', lname='$lname',email='$email',password='$password',phone='$phone',house_no='$house',thana='$thana',district='$district',bg='$bg',dp='$dp',id_image='$idphoto' where u_id='$uid'";
        mysqli_query($con, $sql);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    if(isset($_POST['ffname']))
    {
        $q="update  user set fname='' where u_id='$uid'";
        mysqli_query($con, $q);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    if(isset($_POST['llname']))
    {
        $q="update  user set lname='' where u_id='$uid'";
        mysqli_query($con, $q);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    if(isset($_POST['pphone']))
    {
        $q="update  user set phone='' where u_id='$uid'";
        mysqli_query($con, $q);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    if(isset($_POST['hhouse']))
    {
        $q="update  user set house_no='' where u_id='$uid'";
        mysqli_query($con, $q);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    if(isset($_POST['tthana']))
    {
        $q="update  user set thana='' where u_id='$uid'";
        mysqli_query($con, $q);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    if(isset($_POST['ddistrict']))
    {
        $q="update  user set district='' where u_id='$uid'";
        mysqli_query($con, $q);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    if(isset($_POST['rrin']))
    {
        $q="update  teacher set rinterest='' where u_id='$uid'";
        mysqli_query($con, $q);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    
    if(isset($_POST['bbg']))
    {
        $q="update  user set bg='' where u_id='$uid'";
        mysqli_query($con, $q);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    if(isset($_POST['ddesignition']))
    {
        $q="update  teacher set designition='' where u_id='$uid'";
        mysqli_query($con, $q);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    
    if(isset($_POST['ddp']))
    {
        $q="update  user set dp='' where u_id='$uid'";
        mysqli_query($con, $q);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    if(isset($_POST['iidphoto']))
    {
        $q="update  user set id_image='' where u_id='$uid'";
        mysqli_query($con, $q);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    if(isset($_POST['ddd']))
    {
        $q="delete from books where m_id in (select m_id from study_material where u_id='$uid');";
        mysqli_query($con, $q);
        $q="delete from records where m_id in (select m_id from study_material where u_id='$uid');";
        mysqli_query($con, $q);
        $q="delete from slides where m_id in (select m_id from study_material where u_id='$uid');";
        mysqli_query($con, $q);
        $q="delete from study_material where u_id='$uid';";
        mysqli_query($con, $q);
        $q="delete from posts where c_id in (select c_id from course where u_id='$uid');";
        mysqli_query($con, $q);
         $q="delete from takes_part where e_id in (select e_id from exam natural join course where u_id='$uid');";
        mysqli_query($con, $q);
        $q="delete from exam where c_id in (select c_id from course where u_id='$uid');";
        mysqli_query($con, $q);
        $q="delete from enroll where c_id in (select c_id from course where u_id='$uid');";
        mysqli_query($con, $q);
        
        
        $q="delete from course where u_id='$uid';";
        mysqli_query($con, $q);
        
        $q="delete from teacher where u_id='$uid';";
        mysqli_query($con, $q);
        $q="delete from user where u_id='$uid';";
        mysqli_query($con, $q);
        echo "<script>location.href = 'login.php';</script>";
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="icon" href="./dbfiles/icob.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- <link rel="stylesheet" href="css/ret.css"> -->
    <link rel="stylesheet" href="css/update.css">
</head>

<body>
    <header>
        <div class="container">
            <nav id="main-nav" class="flex items-center justify-between">
                <div class="left flex  items-center">
                    <div class="branding">
                        <a href="user_dashboard_t.php"><img style="width:60px;height:60px;object-fit:cover;border-radius:50%;border:3px solid var(--pure);" src="<?php if(isset($dp)) echo $dp; ?>" alt=""></a>
                    </div>
                    <div>
                        <a href="update_tea.php">edit profile</a>
                        <a href="class_tea.php">class room</a>
                        <div class="dropdown">
            <button class="dropbtn">DELETE ITEM</button>
            <div class="dropdown-content">
                <form action="" method="post" enctype="multipart/form-data"> 
              <input type="submit" value="FIRST NAME" name="ffname"></input>
              <input type="submit" value="LAST NAME" name="llname"></input>
              <input type="submit" value="PHONE NO." name="pphone"></input>
              <input type="submit" value="HOUSE NO." name="hhouse"></input>
              
              <input type="submit" value="THANA" name="tthana"></input>
               <input type="submit" value="BLOOD GROUP" name="bbg"></input>
              <input type="submit" value="DISTRICT" name="ddistrict"></input>
              <input type="submit" value="DESIGNITION" name="ddesignition"></input>
              <input type="submit" value="RESEARCH INTEREST" name="rrin"></input>
              
              <input type="submit" value="PROFILE PHOTO" name="ddp"></input>
              <input type="submit" value="ID PHOTO" name="iidphoto"></input>
               <input type="submit" value="DELETE YOUR PROFILE" name="ddd"></input>
              </form>
            </div>
          </div>
                        <div class="dropdown">
                            <button class="dropbtn">SEARCH</button>
                            <div class="dropdown-content">
                                <a href="search_student.php">Search Any Student</a>
                                <a href="search_teacher.php">Search Any Teacher</a>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="right">
                    <button class="btn btn-primary" onclick="location.href='logout.php';">
                        <div class="social">
                            <div class="a"><img src="./dbfiles/logo.svg" alt=""></div>
                            <h3 style="color:white;">Logout...</h3>
                        </div>
                    </button>
                </div>
            </nav>
        </div>
    </header>
<div class="bodyy">
<div class="containerr">
        <div class="title">
            Update Your Profile
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="user-details">
                <div class="input-box">
                    <span class="details"> Name</span>
                    <div class="name">
                        <input class="n" type="text" id="fname" name="fname" placeholder="<?php if (isset($fname)) echo $fname; ?>">
                        <input type="text" id="lname" name="lname" placeholder="<?php if (isset($lname)) echo $lname; ?>">
                    </div>
                </div>

                <div class="input-box">
                    <span class="details"> Email</span>
                    <input type="email" id="email" name='email' placeholder="<?php if (isset($email)) echo $email; ?>"></input>
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <div class="input-box">
                    <span class="details"> Password</span>
                    <input type="password" id="pd" name='password' placeholder="Enter your password"></input>
                </div>

                <div class="input-box">
                    <span class="details"> Confirm Password</span>
                    <input type="password" id="cpd" name='cpassword' placeholder="Confirm Password"></input><br>
                    <b id="demo" style="color:red;margin-top:-2rem;font-size:14px;"></b>
                </div>
                <div class="input-box">
                    <span class="details"> Phone Number</span>
                    <input type="text" id="phone" name='phone' placeholder="<?php if (isset($phone)) echo $phone; ?>"></input>
                </div>

                <div class="input-box">
                    <span class="details"> House No.</span>
                    <input type="text" id="house" name='house' placeholder="<?php if (isset($house)) echo $house; ?>"></input>
                </div>

                <div class="input-box">
                    <span class="details"> Thana</span>
                    <input type="text" id="thana" name='thana' placeholder="<?php if (isset($thana)) echo $thana; ?>"></input>
                </div>
                <div class="input-box">
                    <span class="details"> District</span>
                    <input type="text" id="district" name='district' placeholder="<?php if (isset($district)) echo $district; ?>"></input>
                </div>

                <div class="input-box">
                    <span class="details">Blood Group</span>
                    <input type="text" id="bg" name='bg' placeholder="<?php if (isset($bg)) echo $bg; ?>"></input>
                </div>
                <div class="input-box">
                    <span class="details">Designition</span>
                    <input type="text" id="designition" name='designition' placeholder="<?php if (isset($designition)) echo $designition; ?>"></input>
                </div>
                <div class="input-box" style="margin-right:15rem;">
                    <span class="details">Research Interest</span>
                    <input type="text" id="rinterest" name='rinterest' placeholder="<?php if (isset($rinterest)) echo $rinterest; ?>"></input>
                </div>

                <div class="input-box">
                    <span class="details"> Update your profile photo</span>
                    <input class="upload" id="dp" type="file" name="dp">
                </div>
                <div class="input-box">
                    <span class="details"> Update your ID Card's photo</span>
                    <input class="upload" id="idphoto" type="file" name="idphoto">
                </div>
                <img src="<?php if (isset($dp)) echo $dp; ?>" alt="Your Profile Picture" style="object-fit: cover;margin:2rem 0rem;margin-left:5rem;" height="300" width="300">
                <img src="<?php if (isset($idphoto)) echo $idphoto; ?>" alt="Your ID Card" style="object-fit: cover;margin:2rem 0;margin-right: 5rem;" height="300" width="300">
            </div>
            <div class="button up">
                <input style="width:100%;" type="submit" value="Update" name="upload">
            </div>
        </form>
    </div>
</div>
    <script>
        $('#cpd').on('keyup', function() {
            if ($('#pd').val() == $('#cpd').val()) {
                $('#demo').html('Matching').css('color', 'green');
            } else
                $('#demo').html('Not Matching').css('color', 'red');
        });
        $('#fname, #lname, #bg,#email,#pd, #phone, #house, #thana, #district, #designition, #rinterest, #dp, #idphoto').on('keyup', function() {
            $('#demo').html('').css('color', 'red');
        });
    </script>
</body>

</html>