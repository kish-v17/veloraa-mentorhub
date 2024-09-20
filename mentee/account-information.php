<?php
include 'header.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $about = $_POST['about'];
    $githubId = $_POST['githubId'];
    $linkedinId = $_POST['linkedinId'];
    $skills = isset($_POST['skill']) ? implode(', ', $_POST['skill']) : '';
    $profilePhoto = $_FILES['file']['name'];

    $userId = $_SESSION['user_id'];

    // File upload path
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        $stmt = $pdo->prepare("
            UPDATE user_tbl
            SET U_Fnm = :fullname, U_Phn = :phone, U_City = :city, U_State = :state, U_Country = :country,
                U_About = :about, U_GitHub = :githubId, U_LinkedIn = :linkedinId, U_Skill = :skills,
                U_Profile = :profilePhoto
            WHERE id = :userId
        ");

        // Bind parameters
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':about', $about);
        $stmt->bindParam(':githubId', $githubId);
        $stmt->bindParam(':linkedinId', $linkedinId);
        $stmt->bindParam(':skills', $skills);
        $stmt->bindParam(':profilePhoto', $profilePhoto);
        $stmt->bindParam(':userId', $userId);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Profile updated successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating profile.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error uploading file.</div>";
    }
}
?>
<!-- main content -->
<div class="main-content bg-lightblue theme-dark-bg right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <div class="middle-wrap">
                <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">
                    <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
                        <a href="default-settings.php" class="d-inline-block mt-2"><i class="ti-arrow-left font-sm text-white"></i></a>
                        <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Account Details</h4>
                    </div>

                    <?php
                    require '../database/db.php'; // Ensure you include your database connection
                    // error_reporting(0);
                    if (isset($_SESSION['user_id'])) {
                        $userId = $_SESSION['user_id'];

                        // Fetch user data
                        $stmt = $dbh->prepare("
                            SELECT U_Fnm, U_Phn, U_City, U_State, U_Country, U_About, U_GitHub, U_LinkedIn, U_Skill, U_Profile
                            FROM user_tbl
                            WHERE U_Id = :userId
                        ");

                        $stmt->bindParam(':userId', $userId);
                        $stmt->execute();
                        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($userData) {
                            // Store user data in variables
                            $fullname = $userData['U_Fnm'];
                            $email = $userData['U_Email'];
                            $phone = $userData['U_Phn'];
                            $city = $userData['U_City'];
                            $state = $userData['U_State'];
                            $country = $userData['U_Country'];
                            $about = $userData['U_About'];
                            $githubId = $userData['U_GitHub'];
                            $linkedinId = $userData['U_LinkedIn'];
                            $skills = $userData['U_Skill'];
                            $profilePhoto = $userData['U_Profile'];
                        } else {
                            echo "<div class='alert alert-danger'>No user data found.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>User is not logged in.</div>";
                    }
                    ?>

                    <div class="card-body p-lg-5 p-4 w-100 border-0">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 text-center">
                                <figure class="avatar ms-auto me-auto mb-0 mt-2 w100">
                                    <img src="<?php echo htmlspecialchars($profilePhoto); ?>" alt="image" class="shadow-sm rounded-3 w-100">
                                </figure>
                                <h2 class="fw-700 font-sm text-grey-900 mt-3"><?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
                                <h4 class="text-grey-500 fw-500 mb-3 font-xsss mb-4"><?php echo htmlspecialchars($city); ?></h4>
                            </div>
                        </div>

                        <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Full Name</label>
                                        <input type="text" class="form-control" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Email</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">City</label>
                                        <input type="text" class="form-control" name="city" value="<?php echo htmlspecialchars($city); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">State</label>
                                        <input type="text" class="form-control" name="state" value="<?php echo htmlspecialchars($state); ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Country</label>
                                        <input type="text" class="form-control" name="country" value="<?php echo htmlspecialchars($country); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label class="mont-font fw-600 font-xsss">About</label>
                                    <textarea class="form-control mb-0 p-3 h100 lh-16" rows="5" name="about" placeholder="Write about yourself..." required><?php echo htmlspecialchars($about); ?></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Github Id</label>
                                        <input type="text" class="form-control" name="githubId" value="<?php echo htmlspecialchars($githubId); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">LinkedIn Id</label>
                                        <input type="text" class="form-control" name="linkedinId" value="<?php echo htmlspecialchars($linkedinId); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Skills</label>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#skillsModal">
                                            Select Skills
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Skills Modal -->
                            <div class="modal fade" id="skillsModal" tabindex="-1" aria-labelledby="skillsModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="skillsModalLabel">Select Skills</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" id="skillsSearch" class="form-control mb-3" placeholder="Search for skills...">
                                            <div id="skillsList">
                                                <label class="form-check">
                                                    <input type="checkbox" name="skill[]" value="c" <?php echo in_array('c', explode(',', $skills)) ? 'checked' : ''; ?>> C
                                                </label>
                                                <label class="form-check">
                                                    <input type="checkbox" name="skill[]" value="cpp" <?php echo in_array('cpp', explode(',', $skills)) ? 'checked' : ''; ?>> C++
                                                </label>
                                                <label class="form-check">
                                                    <input type="checkbox" name="skill[]" value="java" <?php echo in_array('java', explode(',', $skills)) ? 'checked' : ''; ?>> Java
                                                </label>
                                                <label class="form-check">
                                                    <input type="checkbox" name="skill[]" value="asp.net" <?php echo in_array('asp.net', explode(',', $skills)) ? 'checked' : ''; ?>> ASP.net
                                                </label>
                                                <label class="form-check">
                                                    <input type="checkbox" name="skill[]" value="php" <?php echo in_array('php', explode(',', $skills)) ? 'checked' : ''; ?>> PHP
                                                </label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="saveSkills()">Save Skills</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <div class="card mt-3 border-0">
                                    <div class="card-body d-flex justify-content-between align-items-end p-0">
                                        <div class="form-group mb-0 w-100">
                                            <input type="file" name="file" id="file" class="input-file">
                                            <label for="file" name="profile" class="rounded-3 text-center bg-white btn-tertiary js-labelFile p-4 w-100 border-dashed">
                                                <i class="ti-cloud-down large-icon me-3 d-block"></i>
                                                <span class="js-fileName">Drag and drop or click to select profile photo</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button type="submit" class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="card w-100 border-0 p-2"></div> -->
            </div>
        </div>

    </div>
</div>
<!-- main content -->

<!-- right chat -->
<div class="right-chat nav-wrap mt-2 right-scroll-bar">
    <div class="middle-sidebar-right-content bg-white shadow-xss rounded-xxl">

        <!-- loader wrapper -->
        <div class="preloader-wrap p-3">
            <div class="box shimmer">
                <div class="lines">
                    <div class="line s_shimmer"></div>
                    <div class="line s_shimmer"></div>
                    <div class="line s_shimmer"></div>
                    <div class="line s_shimmer"></div>
                </div>
            </div>
            <div class="box shimmer mb-3">
                <div class="lines">
                    <div class="line s_shimmer"></div>
                    <div class="line s_shimmer"></div>
                    <div class="line s_shimmer"></div>
                    <div class="line s_shimmer"></div>
                </div>
            </div>
            <div class="box shimmer">
                <div class="lines">
                    <div class="line s_shimmer"></div>
                    <div class="line s_shimmer"></div>
                    <div class="line s_shimmer"></div>
                    <div class="line s_shimmer"></div>
                </div>
            </div>
        </div>
        <!-- loader wrapper -->

        <div class="section full pe-3 ps-4 pt-4 position-relative feed-body">
            <h4 class="font-xsssss text-grey-500 text-uppercase fw-700 ls-3">CONTACTS</h4>
            <ul class="list-group list-group-flush">
                <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                    <figure class="avatar float-left mb-0 me-2">
                        <img src="images/user-8.png" alt="image" class="w35">
                    </figure>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Hurin Seary</a>
                    </h3>
                    <span class="badge badge-primary text-white badge-pill fw-500 mt-0">2</span>
                </li>
                <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                    <figure class="avatar float-left mb-0 me-2">
                        <img src="images/user-7.png" alt="image" class="w35">
                    </figure>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Victor Exrixon</a>
                    </h3>
                    <span class="bg-success ms-auto btn-round-xss"></span>
                </li>
                <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                    <figure class="avatar float-left mb-0 me-2">
                        <img src="images/user-6.png" alt="image" class="w35">
                    </figure>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Surfiya Zakir</a>
                    </h3>
                    <span class="bg-warning ms-auto btn-round-xss"></span>
                </li>
                <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                    <figure class="avatar float-left mb-0 me-2">
                        <img src="images/user-5.png" alt="image" class="w35">
                    </figure>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Goria Coast</a>
                    </h3>
                    <span class="bg-success ms-auto btn-round-xss"></span>
                </li>
                <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                    <figure class="avatar float-left mb-0 me-2">
                        <img src="images/user-4.png" alt="image" class="w35">
                    </figure>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Hurin Seary</a>
                    </h3>
                    <span class="badge mt-0 text-grey-500 badge-pill pe-0 font-xsssss">4:09 pm</span>
                </li>
                <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                    <figure class="avatar float-left mb-0 me-2">
                        <img src="images/user-3.png" alt="image" class="w35">
                    </figure>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">David Goria</a>
                    </h3>
                    <span class="badge mt-0 text-grey-500 badge-pill pe-0 font-xsssss">2 days</span>
                </li>
                <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                    <figure class="avatar float-left mb-0 me-2">
                        <img src="images/user-2.png" alt="image" class="w35">
                    </figure>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Seary Victor</a>
                    </h3>
                    <span class="bg-success ms-auto btn-round-xss"></span>
                </li>
                <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
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
                <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">

                    <span class="btn-round-sm bg-primary-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Studio Express</a>
                    </h3>
                    <span class="badge mt-0 text-grey-500 badge-pill pe-0 font-xsssss">2 min</span>
                </li>
                <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">

                    <span class="btn-round-sm bg-gold-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Armany Design</a>
                    </h3>
                    <span class="bg-warning ms-auto btn-round-xss"></span>
                </li>
                <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">

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
                <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">

                    <span class="btn-round-sm bg-primary-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                    <h3 class="fw-700 mb-0 mt-0">
                        <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Armany Seary</a>
                    </h3>
                    <span class="bg-success ms-auto btn-round-xss"></span>
                </li>
                <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">

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
    <a href="default-settings.php" class="nav-content-bttn"><img src="images/female-profile.png" alt="user" class="w30 shadow-xss"></a>
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

<script src="js/plugin.js"></script>
<script src="js/scripts.js"></script>

</body>

</html>