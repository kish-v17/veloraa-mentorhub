<div class="dropdown-menu dropdown-menu-end p-4 rounded-3 border-0 shadow-lg" aria-labelledby="dropdownMenu3">    <h4 class="fw-700 font-xss mb-4">Notification</h4>
    <?php
    session_start();
    require('../database/db.php');
    $mentor_id = $_SESSION['user_id']; // Get mentee ID from session
    
    // Check for existing calls for the mentee
    $stmt = $dbh->prepare(query: "SELECT room_id, mentor_id, created_at FROM calls_tbl WHERE mentor_id = ?");
    $stmt->execute([$mentor_id]);
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