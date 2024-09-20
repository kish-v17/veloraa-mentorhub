<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.php"); 
        // exit(); 
    }

    $current_page = basename($_SERVER['PHP_SELF']);
    require '../database/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Veloraa MentorHub </title>

    <link rel="stylesheet" href="../css/themify-icons.css">
    <link rel="stylesheet" href="../css/feather.css">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="10x16" href="../images/logo.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/emoji.css">

    <link rel="stylesheet" href="../css/lightbox.css">
    <link rel="stylesheet" href="../css/video-player.css">
    <link rel="stylesheet" href="../css/bootstrap-datetimepicker.css">
</head>

<body class="color-theme-blue mont-font">

    <!-- <div class="preloader"></div> -->


    <div class="main-wrapper">

        <!-- navigation top-->
        <div class="nav-header bg-white shadow-xs border-0">
            <div class="nav-top">
                <a href="index.php"><img src="../images/logo.png" style="height:40px" /><span class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">Veloraa</span> </a>
                <a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <a href="default-video.php" class="mob-menu me-2"><i class="feather-video text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <a href="#" class="me-2 menu-search-icon mob-menu"><i class="feather-search text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <button class="nav-menu me-0 ms-2"></button>
            </div>

            <form action="#" class="float-left header-search">
                <div class="form-group mb-0 icon-input">
                    <i class="feather-search font-sm text-grey-400"></i>
                    <input type="text" placeholder="Start typing to search.." class="bg-grey border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xssss fw-500 rounded-xl w350 theme-dark-bg">
                </div>
            </form>

            <a href="index.php" class="p-2 text-center ms-3 menu-icon center-menu-icon <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                <i class="feather-home font-lg bg-greylight btn-round-lg theme-dark-bg <?php echo ($current_page == 'index.php') ? 'text-current' : 'text-grey-500'; ?>"></i>
            </a>

            <a href="default-storie.php" class="p-2 text-center ms-0 menu-icon center-menu-icon <?php echo ($current_page == 'default-storie.php') ? 'active' : ''; ?>">
                <i class="feather-zap font-lg bg-greylight btn-round-lg theme-dark-bg <?php echo ($current_page == 'default-storie.php') ? 'text-current' : 'text-grey-500'; ?>"></i>
            </a>

            <a href="default-video.php" class="p-2 text-center ms-0 menu-icon center-menu-icon <?php echo ($current_page == 'default-video.php') ? 'active' : ''; ?>">
                <i class="feather-video font-lg bg-greylight btn-round-lg theme-dark-bg <?php echo ($current_page == 'default-video.php') ? 'text-current' : 'text-grey-500'; ?>"></i>
            </a>

            <a href="default-group.php" class="p-2 text-center ms-0 menu-icon center-menu-icon <?php echo ($current_page == 'default-group.php') ? 'active' : ''; ?>">
                <i class="feather-user font-lg bg-greylight btn-round-lg theme-dark-bg <?php echo ($current_page == 'default-group.php') ? 'text-current' : 'text-grey-500'; ?>"></i>
            </a>

            <a href="shop-2.php" class="p-2 text-center ms-0 menu-icon center-menu-icon <?php echo ($current_page == 'shop-2.php') ? 'active' : ''; ?>">
                <i class="feather-shopping-bag font-lg bg-greylight btn-round-lg theme-dark-bg <?php echo ($current_page == 'shop-2.php') ? 'text-current' : 'text-grey-500'; ?>"></i>
            </a>



            <a href="#" class="p-2 text-center ms-auto menu-icon" id="dropdownMenu3" data-bs-toggle="dropdown" aria-expanded="false"><span class="dot-count bg-warning"></span><i class="feather-bell font-xl text-current"></i></a>
            <div class="dropdown-menu dropdown-menu-end p-4 rounded-3 border-0 shadow-lg" aria-labelledby="dropdownMenu3">
    <h4 class="fw-700 font-xss mb-4">Notification</h4>
    
    <?php
    session_start();
    $mentee_id = $_SESSION['user_id']; // Get mentee ID from session

    // Database connection
    $conn = new PDO('mysql:host=localhost;dbname=veloraa_db', 'root', ''); // Update with your credentials

    // Check for existing calls for the mentee
    $stmt = $conn->prepare("SELECT room_id, mentor_id, created_at FROM calls_tbl WHERE mentee_id = ?");
    $stmt->execute([$mentee_id]);
    $existing_calls = $stmt->fetchAll();

    if ($existing_calls) {
        foreach ($existing_calls as $call) {
            $room_id = htmlspecialchars($call['room_id']);
            $mentor_id = htmlspecialchars($call['mentor_id']);
            $created_at = htmlspecialchars($call['created_at']);
            $time_diff = time() - strtotime($created_at);
            $time_display = $time_diff < 60 ? "$time_diff sec" : round($time_diff / 60) . " min"; // Simple time display

            echo "<div class='card bg-transparent-card w-100 border-0 ps-5 mb-3'>";
            echo "<img src='images/user-{$mentor_id}.png' alt='user' class='w40 position-absolute left-0'>"; // Replace with actual image source logic if needed
            echo "<h5 class='font-xsss text-grey-900 mb-1 mt-0 fw-700 d-block'>Mentor ID: $mentor_id <span class='text-grey-400 font-xsssss fw-600 float-right mt-1'>$time_display</span></h5>";
            echo "<h6 class='text-grey-500 fw-500 font-xssss lh-4'>You have an ongoing call. <a href='join_call.php?room_id=$room_id'>Join Call</a></h6>";
            echo "</div>";
        }
    } else {
        echo "<div class='text-grey-500 fw-500 font-xssss lh-4'>You have no ongoing calls with any mentors.</div>";
    }
    ?>
</div>
            
            <a href="#" class="p-2 text-center ms-3 menu-icon chat-active-btn"><i class="feather-message-square font-xl text-current"></i></a>
            <div class="p-2 text-center ms-3 position-relative dropdown-menu-icon menu-icon cursor-pointer">
                <i class="feather-settings animation-spin d-inline-block font-xl text-current"></i>
                <div class="dropdown-menu-settings switchcolor-wrap">
                    <h4 class="fw-700 font-sm mb-4">Settings</h4>
                    <h6 class="font-xssss text-grey-500 fw-700 mb-3 d-block">Choose Color Theme</h6>
                    <ul>
                        <li>
                            <label class="item-radio item-content">
                                <input type="radio" name="color-radio" value="red" checked=""><i class="ti-check"></i>
                                <span class="circle-color bg-red" style="background-color: #ff3b30;"></span>
                            </label>
                        </li>
                        <li>
                            <label class="item-radio item-content">
                                <input type="radio" name="color-radio" value="green"><i class="ti-check"></i>
                                <span class="circle-color bg-green" style="background-color: #4cd964;"></span>
                            </label>
                        </li>
                        <li>
                            <label class="item-radio item-content">
                                <input type="radio" name="color-radio" value="blue" checked=""><i class="ti-check"></i>
                                <span class="circle-color bg-blue" style="background-color: #132977;"></span>
                            </label>
                        </li>
                        <li>
                            <label class="item-radio item-content">
                                <input type="radio" name="color-radio" value="pink"><i class="ti-check"></i>
                                <span class="circle-color bg-pink" style="background-color: #ff2d55;"></span>
                            </label>
                        </li>
                        <li>
                            <label class="item-radio item-content">
                                <input type="radio" name="color-radio" value="yellow"><i class="ti-check"></i>
                                <span class="circle-color bg-yellow" style="background-color: #ffcc00;"></span>
                            </label>
                        </li>
                        <li>
                            <label class="item-radio item-content">
                                <input type="radio" name="color-radio" value="orange"><i class="ti-check"></i>
                                <span class="circle-color bg-orange" style="background-color: #ff9500;"></span>
                            </label>
                        </li>
                        <li>
                            <label class="item-radio item-content">
                                <input type="radio" name="color-radio" value="gray"><i class="ti-check"></i>
                                <span class="circle-color bg-gray" style="background-color: #8e8e93;"></span>
                            </label>
                        </li>

                        <li>
                            <label class="item-radio item-content">
                                <input type="radio" name="color-radio" value="brown"><i class="ti-check"></i>
                                <span class="circle-color bg-brown" style="background-color: #D2691E;"></span>
                            </label>
                        </li>
                        <li>
                            <label class="item-radio item-content">
                                <input type="radio" name="color-radio" value="darkgreen"><i class="ti-check"></i>
                                <span class="circle-color bg-darkgreen" style="background-color: #228B22;"></span>
                            </label>
                        </li>
                        <li>
                            <label class="item-radio item-content">
                                <input type="radio" name="color-radio" value="deeppink"><i class="ti-check"></i>
                                <span class="circle-color bg-deeppink" style="background-color: #FFC0CB;"></span>
                            </label>
                        </li>
                        <li>
                            <label class="item-radio item-content">
                                <input type="radio" name="color-radio" value="cadetblue"><i class="ti-check"></i>
                                <span class="circle-color bg-cadetblue" style="background-color: #5f9ea0;"></span>
                            </label>
                        </li>
                        <li>
                            <label class="item-radio item-content">
                                <input type="radio" name="color-radio" value="darkorchid"><i class="ti-check"></i>
                                <span class="circle-color bg-darkorchid" style="background-color: #9932cc;"></span>
                            </label>
                        </li>
                    </ul>

                    <div class="card bg-transparent-card border-0 d-block mt-3">
                        <h4 class="d-inline font-xssss mont-font fw-700">Header Background</h4>
                        <div class="d-inline float-right mt-1">
                            <label class="toggle toggle-menu-color"><input type="checkbox"><span class="toggle-icon"></span></label>
                        </div>
                    </div>
                    <div class="card bg-transparent-card border-0 d-block mt-3">
                        <h4 class="d-inline font-xssss mont-font fw-700">Menu Position</h4>
                        <div class="d-inline float-right mt-1">
                            <label class="toggle toggle-menu"><input type="checkbox"><span class="toggle-icon"></span></label>
                        </div>
                    </div>
                    <div class="card bg-transparent-card border-0 d-block mt-3">
                        <h4 class="d-inline font-xssss mont-font fw-700">Dark Mode</h4>
                        <div class="d-inline float-right mt-1">
                            <label class="toggle toggle-dark"><input type="checkbox"><span class="toggle-icon"></span></label>
                        </div>
                    </div>

                </div>
            </div>


            <a href="default-settings.php" class="p-0 ms-3 menu-icon"><img src="../images/profile-4.png" alt="user" class="w40 mt--1"></a>

        </div>
        <!-- navigation top -->

        <!-- navigation left -->
        <nav class="navigation scroll-bar">
            <div class="container ps-0 pe-0">
                <div class="nav-content">
                    <div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1 mb-2 mt-2">
                        <div class="nav-caption fw-600 font-xssss text-grey-500"><span>New </span>Feeds</div>
                        <ul class="mb-1 top-content">
                            <li class="logo d-none d-xl-block d-lg-block"></li>
                            <li><a href="index.php" class="nav-content-bttn open-font"><i class="feather-tv btn-round-md bg-blue-gradiant me-3"></i><span>Newsfeed</span></a></li>
                            <li><a href="default-badge.php" class="nav-content-bttn open-font"><i class="feather-award btn-round-md bg-red-gradiant me-3"></i><span>Badges</span></a></li>
                            <li><a href="default-storie.php" class="nav-content-bttn open-font"><i class="feather-globe btn-round-md bg-gold-gradiant me-3"></i><span>Explore Stories</span></a></li>
                            <li><a href="default-group.php" class="nav-content-bttn open-font"><i class="feather-zap btn-round-md bg-mini-gradiant me-3"></i><span>Popular Groups</span></a></li>
                            <li><a href="user-page.php" class="nav-content-bttn open-font"><i class="feather-user btn-round-md bg-primary-gradiant me-3"></i><span>Author Profile </span></a></li>
                        </ul>
                    </div>

                    <div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1 mb-2">
                        <div class="nav-caption fw-600 font-xssss text-grey-500"><span>More </span>Pages</div>
                        <ul class="mb-3">
                            <li><a href="default-email-box.php" class="nav-content-bttn open-font"><i class="font-xl text-current feather-inbox me-3"></i><span>Email Box</span><span class="circle-count bg-warning mt-1">584</span></a></li>
                            <li><a href="default-hotel.php" class="nav-content-bttn open-font"><i class="font-xl text-current feather-home me-3"></i><span>Near Hotel</span></a></li>
                            <li><a href="default-event.php" class="nav-content-bttn open-font"><i class="font-xl text-current feather-map-pin me-3"></i><span>Latest Event</span></a></li>
                            <li><a href="default-live-stream.php" class="nav-content-bttn open-font"><i class="font-xl text-current feather-youtube me-3"></i><span>Live Stream</span></a></li>
                        </ul>
                    </div>
                    <div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1">
                        <div class="nav-caption fw-600 font-xssss text-grey-500"><span></span> Account</div>
                        <ul class="mb-1">
                            <li class="logo d-none d-xl-block d-lg-block"></li>
                            <li><a href="default-settings.php" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i class="font-sm feather-settings me-3 text-grey-500"></i><span>Settings</span></a></li>
                            <li><a href="default-analytics.php" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i class="font-sm feather-pie-chart me-3 text-grey-500"></i><span>Analytics</span></a></li>
                            <li><a href="default-message.php" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i class="font-sm feather-message-square me-3 text-grey-500"></i><span>Chat</span><span class="circle-count bg-warning mt-0">23</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- navigation left -->