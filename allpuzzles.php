<?php
	require_once "config.php";
	require_once "html.php";
	require_once "db-func.php";
	require_once "utils.php";

	// Redirect to the login page, if not logged in
	$uid = isLoggedIn();
	
	// Start HTML
	head("allpuzzles");
		
	// Check for lurker permissions
	if (!canSeeAllPuzzles($uid)) {
		echo "You do not have permission for this page.";
		foot();
		exit(1);
	}

	$filt = isValidPuzzleFilter();
	
	displayPuzzleStats($uid);
	
	$puzzles = getAllPuzzles();
	displayQueue($uid, $puzzles, TRUE, TRUE, TRUE, FALSE, FALSE, $filt);

	
	// End HTML
	foot();
?>
	
