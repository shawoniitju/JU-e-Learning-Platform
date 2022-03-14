<?php
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_e_learning");
include("functions.php");
$dow = check_login($con);
$uid = $dow['u_id'];
$id = $dow['id_type'];
$dp = $dow['dp'];
$name = $dow['fname'] . " " . $dow['lname'];

$cid = $_COOKIE['c_id'];
$sql = "select * from posts where c_id='$cid'";
$result = mysqli_query($con, $sql);
$sql_tea = "select * from course natural join user where c_id='$cid' ";
$result_tea = mysqli_query($con, $sql_tea);
$row_tea = mysqli_fetch_assoc($result_tea);
$class_sql = "select * from course where c_id='$cid'";
$class_execute_query = mysqli_query($con, $class_sql);
$class_data = mysqli_fetch_assoc($class_execute_query);
$query11 = "select video from records where m_id='{$_GET['m_id']}'";
$result11 = mysqli_query($con, $query11);

if ($result11 && mysqli_num_rows($result11) > 0) {
  while ($vid = mysqli_fetch_assoc($result11)) {
    $video = $vid['video'];
  }
}
$cl=$_GET['m_id'];
if(isset($_POST['del'])){
    $q1="delete from records where m_id='$cl'";
    mysqli_query($con, $q1);
    $q1="delete from study_material where m_id='$cl'";
    mysqli_query($con, $q1);
    header("Location: videos.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Videos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="icon" href="./dbfiles/icob.svg">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/cstyle.css">
  <link rel="stylesheet" href="css/hudai.css">

</head>

<body>

  <!-- Vertical navbar -->
  <div class="vertical-nav bg-white" id="sidebar">
    <div class="py-3 px-3 mb-4 bg-light">
      <div class="media d-flex align-items-center">
        <img loading="lazy" src="<?php if (isset($dp)) echo $dp; ?>" alt="" style="object-fit:cover;border-radius:50%;width:100px;height:100px;" class="mr-3 rounded-circle img-thumbnail shadow-sm">
        <div class="media-body">
          <h6 class="m-0"><?php echo $name; ?></h6>
          <!-- <p class="font-weight-normal text-muted mb-0">Web developer</p> -->
        </div>
      </div>
    </div>

    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0"> Class Recourses</p>

    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <a href="slides.php" class="nav-link text-dark">
          <i class="fa fa-slideshare mr-3 text-primary fa-fw"></i>
          Slides
        </a>
      </li>
      <li class="nav-item">
        <a href="books.php" class="nav-link text-dark">
          <i class="fa fa-book mr-3 text-primary fa-fw"></i>
          Books
        </a>
      </li>
      <li class="nav-item">
        <a href="videos.php" class="nav-link text-dark bg-light">
          <i class="fa fa-file-video-o mr-3 text-primary fa-fw"></i>
          Videos
        </a>
      </li>
    </ul>
    <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Tasks</p>

    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <a href="<?php if ($id == "Teacher") {
                    echo "exam_tea.php";
                  } else {
                    echo "exam_stu.php";
                  } ?>" class="nav-link text-dark">
          <i class="fa fa-bookmark mr-3 text-primary fa-fw"></i>
          Exam/Assignment
        </a>
      </li>
      <li class="nav-item">
        <a href="progress_tea.php" class="nav-link text-dark">
          <i class="fa fa-spinner mr-3 text-primary fa-fw"></i>
          Course Progress
        </a>
      </li>
    </ul>
    <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">User Dashboard</p>

    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <a href="<?php if ($id == "Teacher") {
                    echo "user_dashboard_t.php";
                  } else {
                    echo "user_dashboard.php";
                  } ?>" class="nav-link text-dark">
          <i class="fa fa-home mr-3 text-primary fa-fw"></i>
          home
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php if ($id == "Teacher") {
                    echo "classlayoutfinal_tea.php?c_id=$cid";
                  } else {
                    echo "classlayoutfinal_stu.php?c_id=$cid";
                  } ?>" class="nav-link text-dark">
          <i class="fa fa-slideshare mr-3 text-primary fa-fw"></i>
          classroom
        </a>
      </li>
      <li class="nav-item">
        <a href="logout.php" class="nav-link text-dark">
          <i class="fa fa-sign-out mr-3 text-primary fa-fw"></i>
          logout
        </a>
      </li>
    </ul>
  </div>
  <!-- End vertical navbar -->

  <!-- Page content holder -->
  <div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">class menu</small></button>

    <!-- Demo content -->
    <h3 class="display-4 text-dark"><?php echo $class_data['cname']; ?></h3>

    <!-- <button id="buttton_id"><a class="button"  href="#popup1">Let me Pop up</a></button> -->
    <hr>

    <div class="col-lg-12">


      <div class="container">
        <div class="pdf">
          <video src="<?php if (isset($video)) echo $video; ?>" width="900" height="500" controls>
            Your browser does not support the <video> element.
            </video>
        </div>
        <form method="post" style="display: <?php if ($id == "Teacher") {
                    echo "block";
                  } else echo "none";?>">
            <input class="btn btn-primary" type="submit" value="Delete this video" name="del"></input>
        </form>
      </div>



    </div>
    <!-- End demo content -->








    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>

</html>