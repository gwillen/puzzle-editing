<?php
        require_once "config.php";
        require_once "html.php";
        require_once "db-func.php";
        require_once "utils.php";

        // Redirect to the login page, if not logged in
        $uid = isLoggedIn();

        // Start HTML
        head("puzzlestats");

        if (isBlind($uid)) {
                echo '<h3>This page may contain spoilers</h3>';
                foot();
        }

        displayPuzzleStats($uid);

        foot();
?>
