<?php
include 'header.php';

$userId = $_GET['mentorId']; // Query string
$currentUserId = $_SESSION['user_id'];//session 

// Prepare the SQL statement to fetch user data
$stmt = $dbh->prepare("
    SELECT U_Fnm, U_Phn, U_City, U_State, U_Country, U_About, U_GitHub, U_LinkedIn, U_Skill, U_Profile
    FROM user_tbl
    WHERE U_Id = :userId
");

// Bind parameters
$stmt->bindParam(':userId', $userId);

// Execute the query
$stmt->execute();

// Fetch the user data
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

if ($userData) {
    $fullname = $userData['U_Fnm'];
    $phone = $userData['U_Phn'];
    $city = $userData['U_City'];
    $state = $userData['U_State'];
    $country = $userData['U_Country'];
    $about = $userData['U_About'];
    $githubId = $userData['U_GitHub'];
    $linkedinId = $userData['U_LinkedIn'];
    $skills = $userData['U_Skill'];
    $profilePhoto = $userData['U_Profile'];

    // Check if the current user is already following the mentor
    $followCheckStmt = $dbh->prepare("SELECT COUNT(*) FROM follow_tbl WHERE F_MentorId = :mentorId AND F_FollowedById = :followerId");
    $followCheckStmt->bindParam(':mentorId', $userId);
    $followCheckStmt->bindParam(':followerId', $currentUserId);
    $followCheckStmt->execute();
    $isFollowing = $followCheckStmt->fetchColumn() > 0;

    // Handle follow/unfollow action
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($isFollowing) {
            // Unfollow
            $unfollowStmt = $dbh->prepare("DELETE FROM follow_tbl WHERE F_MentorId = :mentorId AND F_FollowedById = :followerId");
            $unfollowStmt->bindParam(':mentorId', $userId);
            $unfollowStmt->bindParam(':followerId', $currentUserId);
            $unfollowStmt->execute();
            echo "You have unfollowed this mentor."; // You can handle this message in the frontend
        } else {
            // Follow
            $followStmt = $dbh->prepare("INSERT INTO follow_tbl (F_MentorId, F_FollowedById) VALUES (:mentorId, :followerId)");
            $followStmt->bindParam(':mentorId', $userId);
            $followStmt->bindParam(':followerId', $currentUserId);
            $followStmt->execute();
            echo "You are now following this mentor."; // You can handle this message in the frontend
        }
    }
} else {
    echo "<div class='alert alert-danger'>No user data found.</div>";
}
?>
<!-- main content -->
<div class="main-content right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3 mt-3 overflow-hidden">
                        <div class="card-body position-relative h240 bg-image-cover bg-image-center"
                            style="background-image: url(../images/bb-9.jpg);"></div>
                        <div class="card-body d-block pt-4 text-center position-relative">
                            <figure class="avatar mt--6 position-relative w75 z-index-1 w100 z-index-1 ms-auto me-auto">
                                <img src="../images/pt-1.jpg" alt="image" class="p-1 bg-white rounded-xl w-100">
                            </figure>

                            <h4 class="font-xs ls-1 fw-700 text-grey-900"><?php echo $fullname ?> <span
                                    class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">@surfiyazakir22</span>
                            </h4>
                            <div class="d-flex align-items-center pt-0 position-absolute left-15 top-10 mt-4 ms-2">
                                <h4 class="font-xsssss text-center d-none d-lg-block text-grey-500 fw-600 ms-2 me-2"><b
                                        class="text-grey-900 mb-1 font-sm fw-700 d-inline-block ls-3 text-dark">456 </b>
                                    Posts</h4>
                                <h4 class="font-xsssss text-center d-none d-lg-block text-grey-500 fw-600 ms-2 me-2"><b
                                        class="text-grey-900 mb-1 font-sm fw-700 d-inline-block ls-3 text-dark">2.1k
                                    </b> Followers</h4>
                                <h4 class="font-xsssss text-center d-none d-lg-block text-grey-500 fw-600 ms-2 me-2"><b
                                        class="text-grey-900 mb-1 font-sm fw-700 d-inline-block ls-3 text-dark">32k </b>
                                    Follow</h4>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-center position-absolute right-15 top-10 mt-2 me-2">
                                <!-- follow btn form -->
                                <form id="followForm" action="" method="POST">
                                    <input type="hidden" name="mentorId"
                                        value="<?php echo htmlspecialchars($userId); ?>">
                                    <button type="submit" id="followButton"
                                        class="d-none d-lg-block bg-success p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3"
                                        style="border:none">
                                        <?php echo $isFollowing ? 'Following' : 'Follow'; ?>
                                    </button>
                                </form>
                                <a href="#"
                                    class="d-none d-lg-block bg-greylight btn-round-lg ms-2 rounded-3 text-grey-700"><i
                                        class="feather-mail font-md"></i></a>
                                <a href="#" id="dropdownMenu8"
                                    class="d-none d-lg-block btn-round-lg ms-2 rounded-3 text-grey-700 bg-greylight"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="ti-more font-md"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg"
                                    aria-labelledby="dropdownMenu8">
                                    <div class="card-body p-0 d-flex">
                                        <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                                        <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-0">Save Link <span
                                                class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Add this to
                                                your saved items</span></h4>
                                    </div>
                                    <div class="card-body p-0 d-flex mt-2">
                                        <i class="feather-alert-circle text-grey-500 me-3 font-lg"></i>
                                        <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-0">Hide Post <span
                                                class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your
                                                saved items</span></h4>
                                    </div>
                                    <div class="card-body p-0 d-flex mt-2">
                                        <i class="feather-alert-octagon text-grey-500 me-3 font-lg"></i>
                                        <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-0">Hide all from Group <span
                                                class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your
                                                saved items</span></h4>
                                    </div>
                                    <div class="card-body p-0 d-flex mt-2">
                                        <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                                        <h4 class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-0">Unfollow Group <span
                                                class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your
                                                saved items</span></h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body d-block w-100 shadow-none mb-0 p-0 border-top-xs">
                            <ul class="nav nav-tabs h55 d-flex product-info-tab border-bottom-0 ps-4" id="pills-tab"
                                role="tablist">
                                <li class="active list-inline-item me-5"><a
                                        class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block active"
                                        href="#navtabs1" data-toggle="tab">About</a></li>
                                <li class="list-inline-item me-5"><a
                                        class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                        href="#navtabs2" data-toggle="tab">Membership</a></li>
                                <li class="list-inline-item me-5"><a
                                        class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                        href="#navtabs3" data-toggle="tab">Discussion</a></li>
                                <li class="list-inline-item me-5"><a
                                        class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                        href="#navtabs4" data-toggle="tab">Video</a></li>
                                <li class="list-inline-item me-5"><a
                                        class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                        href="#navtabs3" data-toggle="tab">Group</a></li>
                                <li class="list-inline-item me-5"><a
                                        class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                        href="#navtabs1" data-toggle="tab">Events</a></li>
                                <li class="list-inline-item me-5"><a
                                        class="fw-700 me-sm-5 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                        href="#navtabs7" data-toggle="tab">Media</a></li>
                                <li class="list-inline-item ms-auto mt-3 me-4"><a href="#" class=""><i
                                            class="ti-more-alt text-grey-500 font-xs"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- main content -->

<!-- right chat -->
<div class="right-chat nav-wrap mt-2 right-scroll-bar">
    <div class="middle-sidebar-right-content bg-white shadow-xss rounded-xxl">

        <div class="section full pe-3 ps-4 pt-4 position-relative feed-body">
            <h4 class="font-xsssss text-grey-500 text-uppercase fw-700 ls-3">CONTACTS</h4>
            <ul class="list-group list-group-flush">
                <li
                    class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                    <figure class="avatar float-left mb-0 me-2">
                        <img src="images/user-8.png" alt="image" class="w35">
                    </figure>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Hurin Seary</a>
                    </h3>
                    <span class="badge badge-primary text-white badge-pill fw-500 mt-0">2</span>
                </li>
                <li
                    class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                    <figure class="avatar float-left mb-0 me-2">
                        <img src="images/user-7.png" alt="image" class="w35">
                    </figure>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Victor
                            Exrixon</a>
                    </h3>
                    <span class="bg-success ms-auto btn-round-xss"></span>
                </li>
                <li
                    class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                    <figure class="avatar float-left mb-0 me-2">
                        <img src="images/user-6.png" alt="image" class="w35">
                    </figure>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Surfiya
                            Zakir</a>
                    </h3>
                    <span class="bg-warning ms-auto btn-round-xss"></span>
                </li>
                <li
                    class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                    <figure class="avatar float-left mb-0 me-2">
                        <img src="images/user-5.png" alt="image" class="w35">
                    </figure>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Goria Coast</a>
                    </h3>
                    <span class="bg-success ms-auto btn-round-xss"></span>
                </li>
                <li
                    class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                    <figure class="avatar float-left mb-0 me-2">
                        <img src="images/user-4.png" alt="image" class="w35">
                    </figure>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Hurin Seary</a>
                    </h3>
                    <span class="badge mt-0 text-grey-500 badge-pill pe-0 font-xsssss">4:09 pm</span>
                </li>
                <li
                    class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                    <figure class="avatar float-left mb-0 me-2">
                        <img src="images/user-3.png" alt="image" class="w35">
                    </figure>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">David Goria</a>
                    </h3>
                    <span class="badge mt-0 text-grey-500 badge-pill pe-0 font-xsssss">2 days</span>
                </li>
                <li
                    class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                    <figure class="avatar float-left mb-0 me-2">
                        <img src="images/user-2.png" alt="image" class="w35">
                    </figure>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Seary Victor</a>
                    </h3>
                    <span class="bg-success ms-auto btn-round-xss"></span>
                </li>
                <li
                    class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                    <figure class="avatar float-left mb-0 me-2">
                        <img src="images/user-12.png" alt="image" class="w35">
                    </figure>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Ana Seary</a>
                    </h3>
                    <span class="bg-success ms-auto btn-round-xss"></span>
                </li>

            </ul>
        </div>
        <div class="section full pe-3 ps-4 pt-4 pb-4 position-relative feed-body">
            <h4 class="font-xsssss text-grey-500 text-uppercase fw-700 ls-3">GROUPS</h4>
            <ul class="list-group list-group-flush">
                <li
                    class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">

                    <span class="btn-round-sm bg-primary-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Studio
                            Express</a>
                    </h3>
                    <span class="badge mt-0 text-grey-500 badge-pill pe-0 font-xsssss">2 min</span>
                </li>
                <li
                    class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">

                    <span class="btn-round-sm bg-gold-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Armany
                            Design</a>
                    </h3>
                    <span class="bg-warning ms-auto btn-round-xss"></span>
                </li>
                <li
                    class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">

                    <span class="btn-round-sm bg-mini-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">De fabous</a>
                    </h3>
                    <span class="bg-success ms-auto btn-round-xss"></span>
                </li>
            </ul>
        </div>
        <div class="section full pe-3 ps-4 pt-0 pb-4 position-relative feed-body">
            <h4 class="font-xsssss text-grey-500 text-uppercase fw-700 ls-3">Pages</h4>
            <ul class="list-group list-group-flush">
                <li
                    class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">

                    <span class="btn-round-sm bg-primary-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Armany Seary</a>
                    </h3>
                    <span class="bg-success ms-auto btn-round-xss"></span>
                </li>
                <li
                    class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">

                    <span class="btn-round-sm bg-gold-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Entropio Inc</a>
                    </h3>
                    <span class="bg-success ms-auto btn-round-xss"></span>
                </li>

            </ul>
        </div>

    </div>
</div>


<!-- right chat -->

<div class="app-footer border-0 shadow-lg bg-primary-gradiant">
    <a href="default.php" class="nav-content-bttn nav-center"><i class="feather-home"></i></a>
    <a href="default-video.php" class="nav-content-bttn"><i class="feather-package"></i></a>
    <a href="default-live-stream.php" class="nav-content-bttn" data-tab="chats"><i class="feather-layout"></i></a>
    <a href="shop-2.php" class="nav-content-bttn"><i class="feather-layers"></i></a>
    <a href="default-settings.php" class="nav-content-bttn"><img src="images/female-profile.png" alt="user"
            class="w30 shadow-xss"></a>
</div>

<div class="app-header-search">
    <form class="search-form">
        <div class="form-group searchbox mb-0 border-0 p-1">
            <input type="text" class="form-control border-0" placeholder="Search...">
            <i class="input-icon">
                <ion-icon name="search-outline" role="img" class="md hydrated" aria-label="search outline"></ion-icon>
            </i>
            <a href="#" class="ms-1 mt-1 d-inline-block close searchbox-close">
                <i class="ti-close font-xs"></i>
            </a>
        </div>
    </form>
</div>

</div>

<div class="modal bottom side fade" id="Modalstries" tabindex="-1" role="dialog" style=" overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 bg-transparent">
            <button type="button" class="close mt-0 position-absolute top--30 right--10" data-dismiss="modal"
                aria-label="Close"><i class="ti-close text-white font-xssss"></i></button>
            <div class="modal-body p-0">
                <div class="card w-100 border-0 rounded-3 overflow-hidden bg-gradiant-bottom bg-gradiant-top">
                    <div class="owl-carousel owl-theme dot-style3 story-slider owl-dot-nav nav-none">
                        <div class="item"><img src="images/story-5.jpg" alt="image"></div>
                        <div class="item"><img src="images/story-6.jpg" alt="image"></div>
                        <div class="item"><img src="images/story-7.jpg" alt="image"></div>
                        <div class="item"><img src="images/story-8.jpg" alt="image"></div>

                    </div>
                </div>
                <div class="form-group mt-3 mb-0 p-3 position-absolute bottom-0 z-index-1 w-100">
                    <input type="text"
                        class="style2-input w-100 bg-transparent border-light-md p-3 pe-5 font-xssss fw-500 text-white"
                        value="Write Comments">
                    <span class="feather-send text-white font-md text-white position-absolute"
                        style="bottom: 35px;right:30px;"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal-popup-chat">
    <div class="modal-popup-wrap bg-white p-0 shadow-lg rounded-3">
        <div class="modal-popup-header w-100 border-bottom">
            <div class="card p-3 d-block border-0 d-block">
                <figure class="avatar mb-0 float-left me-2">
                    <img src="images/user-12.png" alt="image" class="w35 me-1">
                </figure>
                <h5 class="fw-700 text-primary font-xssss mt-1 mb-1">Hendrix Stamp</h5>
                <h4 class="text-grey-500 font-xsssss mt-0 mb-0"><span
                        class="d-inline-block bg-success btn-round-xss m-0"></span> Available</h4>
                <a href="#" class="font-xssss position-absolute right-0 top-0 mt-3 me-4"><i
                        class="ti-close text-grey-900 mt-2 d-inline-block"></i></a>
            </div>
        </div>
        <div class="modal-popup-body w-100 p-3 h-auto">
            <div class="message">
                <div class="message-content font-xssss lh-24 fw-500">Hi, how can I help you?</div>
            </div>
            <div class="date-break font-xsssss lh-24 fw-500 text-grey-500 mt-2 mb-2">Mon 10:20am</div>
            <div class="message self text-right mt-2">
                <div class="message-content font-xssss lh-24 fw-500">I want those files for you. I want you to send 1
                    PDF and 1 image file.</div>
            </div>
            <div class="snippet pt-3 ps-4 pb-2 pe-3 mt-2 bg-grey rounded-xl float-right" data-title=".dot-typing">
                <div class="stage">
                    <div class="dot-typing"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-popup-footer w-100 border-top">
            <div class="card p-3 d-block border-0 d-block">
                <div class="form-group icon-right-input style1-input mb-0"><input type="text"
                        placeholder="Start typing.."
                        class="form-control rounded-xl bg-greylight border-0 font-xssss fw-500 ps-3"><i
                        class="feather-send text-grey-500 font-md"></i></div>
            </div>
        </div>
    </div>
</div>

<script src="js/plugin.js"></script>
<script src="js/lightbox.js"></script>
<script src="js/scripts.js"></script>
<script>
    document.getElementById('followForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this);
        var followButton = document.getElementById('followButton');

        fetch(this.action, {
            method: 'POST',
            body: formData,
        }).then(response => response.text())
            .then(data => {
                if (followButton.innerHTML === 'Follow') {
                    followButton.innerHTML = 'Following'; // Change button text to 'Following'
                } else {
                    followButton.innerHTML = 'Follow'; // Change button text back to 'Follow'
                }
                console.log(data); // Optional: handle success/failure messages
            }).catch(error => {
                console.error('Error:', error);
            });
    });
</script>

</body>

</html>