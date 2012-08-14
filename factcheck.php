<?php
	require_once "config.php";
	require_once "html.php";
	require_once "db-func.php";
	require_once "utils.php";

	// Redirect to the login page, if not logged in
	$uid = isLoggedIn();
	
	// Start HTML
	head("factcheck");
		
	// Check for permissions
	if (!isFactChecker($uid)) {
		echo "You do not have permission for this page.";
		foot();
		exit(1);
	}
	
	displayPuzzleStats($uid);
	
	echo "<h1>Factchecking</h1>";

	?>
        <form action="form-submit.php" method="post">
                <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                Enter Puzzle ID to factcheck: <input type="text" name="pid" />
                <input type="submit" name="FactcheckPuzzle" value="Go" />
        </form>
	<?php

	echo '<br/>';
	echo '<h3>Unclaimed Puzzles:</h3>';
	$puzzles = getUnclaimedPuzzlesInFactChecking();
	displayQueue($uid, $puzzles, TRUE, FALSE, FALSE, FALSE, FALSE);

	echo '<br/>';
	echo '<h3>Already Claimed:</h3>';
	$puzzles = getClaimedPuzzlesInFactChecking();
	displayQueue($uid, $puzzles, TRUE, FALSE, FALSE, FALSE, FALSE);
	
	// End HTML
	foot();
?>
	
