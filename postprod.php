<?php
        require_once "config.php";
        require_once "html.php";
        require_once "db-func.php";
        require_once "utils.php";

        // Redirect to the login page, if not logged in
        $uid = isLoggedIn();

        // Start HTML
        head("postprod");
?>
        <h3>Puzzles in Postprod</h3>

<?php
        $puzzles = getPuzzlesInPostprod($uid);
        displayQueue($uid, $puzzles, TRUE, FALSE, TRUE, FALSE, FALSE);

        // End the HTML
        foot();
?>
