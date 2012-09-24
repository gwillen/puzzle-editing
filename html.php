<?php
        require_once "config.php";
        require_once "utils.php";

        function head($selnav = "") {
        $hunt=mktime(12,00,00,1,18,2013);
        $now = time();
        $tth=$hunt-$now;
        $days=floor($tth/(60 * 60 * 24));
        $hrs=floor($tth/(60 * 60))-(24*$days);
        $mins=floor($tth/(60))-(24*60*$days)-(60*$hrs);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
        <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico" />
        
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/reset-min.css" />
        <link rel="stylesheet" type="text/css" href="css/base-min.css" />
        <link rel="stylesheet" type="text/css" href="css/fonts-min.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <?php if ($selnav == "people" || $selnav == "account") { ?> <link rel="stylesheet" type="text/css" href="css/profiles.css" /> <?php } ?>
        
        <title>Puzzletron</title>
        
        <script type='text/javascript' src='jquery-1.4.2.js'></script>
        <script type='text/javascript' src='jquery.tablesorter.min.js'></script>
        <script type="text/javascript" src='js.js'></script>
</head>
<body>
<div id="container">
        <div id="header" style="margin-top:15px;">
          <div id="titletext" style="vertical-align:middle; margin-bottom:10px;">
                                <div style="text-align:left;width:auto;float:left;vertical-align:top;">
                     <h1>Puzzletron: the Mystery Hunt writing server</h1>
                </div>
                <div style="text-align:right;width:auto;float:right;vertical-align:top;">
                     <h3 style="margin-top:0;"> <span class="red"><?php echo $days ?></span> days, <span class="red"><?php echo $hrs ?></span> hours and <span class="red"><?php echo $mins ?></span> minutes left until hunt.</h3>
                                </div>
                <div style="clear:both;"></div>
                   </div>
                  <div id="navbar" style="float:left;width:100%;background-color:#efefef;">
                <ul class="nav" style="float:left;">
                        <li class="nav"><a class="<?php echo ($selnav == "home") ? "selnav" : "nav" ?>" href="./">Home</a></li> <?php if(isset($_SESSION['uid'])) { ?>
                        <li class="nav"><a class="<?php echo ($selnav == "people") ? "selnav" : "nav" ?>" href="people">People</a></li>
                        <li class="nav"><a class="<?php echo ($selnav == "account") ? "selnav" : "nav" ?>" href="account">Your Account</a></li>
                        <?php }
                                  if(isset($_SESSION['uid']) && isServerAdmin($_SESSION['uid'])) {?> <li class="nav"><a class="<?php echo ($selnav == "admin") ? "selnav" : "nav" ?>" href="admin">Admin</a></li> <?php } ?>
                        <?php if(isset($_SESSION['uid']) && canChangeStatus($_SESSION['uid'])) {?> <li class="nav"><a class="<?php echo ($selnav == "editorlist") ?  "selnav" : "nav" ?>" href="editorlist">Editor List</a></li> <?php } ?>
                        <?php if(isset($_SESSION['uid'])) {?> <li class="nav"><a class="<?php echo ($selnav == "author") ? "selnav" : "nav" ?>" href="author">Author</a></li> <?php } ?>
                        <?php if(isset($_SESSION['uid']) && isEditor($_SESSION['uid'])) {?> <li class="nav"><a class="<?php echo ($selnav == "editor") ? "selnav" : "nav" ?>" href="editor">Editor</a></li> <?php } ?>
                        <?php if(isset($_SESSION['uid'])) {?> <li class="nav"><a class="<?php echo ($selnav == "spoiled") ? "selnav" : "nav" ?>" href="spoiled">Spoiled</a></li> <?php } ?>
                        <?php if(isset($_SESSION['uid'])) {?> <li class="nav"><a class="<?php echo ($selnav == "factcheck") ? "selnav" : "nav" ?>" href="factcheck">Fact Check</a></li> <?php } ?>
            <?php if(isset($_SESSION['uid']) && isFactChecker($_SESSION['uid'])) {?> <li class="nav"><a class="<?php echo ($selnav == "ffc") ? "selnav" : "nav" ?>" href="ffc">Final Fact Check</a></li> <?php } ?>
                        <?php if(isset($_SESSION['uid'])) {?> <li class="nav"><a class="<?php echo ($selnav == "testsolving") ? "selnav" : "nav" ?>" href="testsolving">Testsolving</a></li> <?php } ?>
                        <?php if(isset($_SESSION['uid']) && (isLurker($_SESSION['uid']) || isTestingAdmin($_SESSION['uid']))) {?> <li class="nav"><a class="<?php echo ($selnav == "testadmin") ? "selnav" : "nav" ?>" href="testadmin">Testing Admin</a></li> <?php } ?>
                        <?php if(isset($_SESSION['uid']) && !isBlind($_SESSION['uid'])) {?> <li class='nav'><a class="<?php echo ($selnav == "puzzlestats") ? "selnav" : "nav" ?>" href='puzzlestats'>Stats</a></li> <?php } ?>
                        <?php if(isset($_SESSION['uid']) && (isEditor($_SESSION['uid']) || isLurker($_SESSION['uid']))) {?> <li class="nav"><a class="<?php echo ($selnav == "answers") ? "selnav" : "nav" ?>" href="answers">Answers</a></li> <?php } ?>
                        <?php if(isset($_SESSION['uid']) && canSeeAllPuzzles($_SESSION['uid'])) {?> <li class="nav"><a class="<?php echo ($selnav == "allpuzzles") ? "selnav" : "nav" ?>" href="allpuzzles">All Puzzles</a></li> <?php } ?>
                </ul>
                        <div style="float:right;"><?php if (isset($_SESSION['uid'])) { ?><a class="nav" href="logout">Logout</a><?php } ?></div>
                </div>
                        <div style="clear:both;"></div>
        </div>
        <div id="body">
<?php                
        }
        
        function foot()
        {
?>        
        </div>
        <div id="footer">
                <hr />
                <p>This is the website for the hunt writing team. For technical assistance, please contact the <a href="mailto:tech@manicsages.org">Server Administrators</a>.  The original authors of this software are Kate Baker and Metaphysical Plant.  This software is available <a href="http://github.com/mysteryhunt/puzzle-editing/">on GitHub</a> under the Simplified BSD license.  The copyrights for the puzzles and comments contained herein are retained by the puzzle authors.</p>
        </div>
</div>                
</body>
</html>
        
<?php        
        }
        
        function printPerson($p)
        {
                $id = $p['uid'];
                $uname = $p['username'];
                $picture = $p['picture'];
                $fullname = $p['fullname'];
                $email = $p['email'];

                if (strncmp($uname, "test", 4) == 0) {
                        // Ignore test users.
                        return;
                }

                $pic = "<img src=\"nophoto.gif\" />";
                if ($picture != "") {        
                        $picsrc = "uploads/pictures/thumbs/$id.jpg";
                        if (file_exists($picsrc))
                                $pic = "<img src=\"".$picsrc."\" />";
                }
                                                
                $jobNames = getUserJobsAsList($id);
                ?>                
                <div class="<?php echo ($jobNames) ? "specprofilebox" : "profilebox"; ?>">
                        <div class="profileimg"><?php echo $pic ?></div>
                        <div class="profiletxt">
                                <span class="profilename"><?php echo "$fullname"; ?> (<?php echo "$uname"; ?>)</span>
                                <span class="profiletitle"><?php echo $jobNames; ?></span>
                                <span class="profilecontact"><a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></span>
<?php
                        $sql = "SELECT * FROM user_info_key";
                        $result = get_rows_null($sql);
                        foreach ($result as $r) {
                                $shortname = $r['shortname'];
                                $longname = $r['longname'];
                                $user_key_id = $r['id'];
                                $sql = sprintf("SELECT value FROM user_info_values WHERE person_id = '%s' AND user_info_key_id = '%s'",
                                               mysql_real_escape_string($id), mysql_real_escape_string($user_key_id));
                                $res = get_rows_null($sql);
                                if ($res[0]['value'] != "") {
?>
                                        <span class="profilesect"><?php echo "<b>$longname</b>: " . $res[0]['value']; ?></span>
<?php
                                }
                        }
?>
                        </div>
                        <div class="profilefooter"></div>
                </div>
<?php
        }        
        
        function displayQueue($uid, $puzzles, $showNotes, $showAnswerAndSummary, $showAuthorsAndEditors, $test, $showTesters, $filter = array())
        {
                if ($puzzles == NULL) {
                        echo "<h4>No puzzles in queue</h4>";
                        return;
                }
?>
                <table class="tablesorter">
                <thead>
                        <tr>
                                <th class="puzzidea">ID</th>
                                <th class="puzzidea">Transformer</th>
                                <th class="puzzidea">Title</th>
                                <th class="puzzidea">Puzzle Status</th>
                                <?php if ($showAnswerAndSummary) {echo '<th class="puzzidea">Summary</th>';} ?>
                                <?php if ($showNotes) {echo '<th class="puzzidea">Status Notes</th>';} ?>
                                <?php if ($showAnswerAndSummary) {echo '<th class="puzzidea">Answer</th>';} ?>
                                <?php if (!$test) { echo '<th class="puzzidea">Last Comment</th>';}?>
                                <?php if ($showAuthorsAndEditors) {echo '<th class="puzzidea">Authors</th>';} ?>
                                <?php if ($showAuthorsAndEditors) {echo '<th class="puzzidea">Editors</th>';} ?>
                                <?php if ($showTesters) {echo '<th class="puzzidea">Testers</th>';} ?>
                        </tr>
                </thead>
                <tbody>
<?php 
                $statuses = getPuzzleStatuses();
                foreach ($puzzles as $pid) {
                        $puzzleInfo = getPuzzleInfo($pid);

      // This is totally the wrong way to do this. The right way involves
      // writing SQL.
      if ($filter) {
        if ($filter[0] == "status" && $filter[1] != $puzzleInfo["pstatus"]) {
          continue;
        }
        if ($filter[0] == "author" && !isAuthorOnPuzzle($filter[1], $pid)) {
          continue;
        }
        if ($filter[0] == "editor" && !isEditorOnPuzzle($filter[1], $pid)) {
          continue;
        }
      }

                        $title = $puzzleInfo["title"];
                        if ($title == NULL)
                                $title = '(untitled)';

                        $transformer = puzzleTransformer($pid);
                        
                        $lastComment = getLastCommentDate($pid);
                        $lastVisit = getLastVisit($uid, $pid);
                        
                        if (($lastVisit == NULL || strtotime($lastVisit) < strtotime($lastComment)) || $test) 
                                echo '<tr class="puzz-new">';
                        else
                                echo '<tr class="puzz">';
                                
                        if ($test)
                                echo "<td class='puzzidea'><a href='test?pid=$pid'>$pid</a></td>";
                        else
                                echo "<td class='puzzidea'><a href='puzzle?pid=$pid'>$pid</a></td>";
?>
                                <td class='puzzidea'><?php echo $transformer; ?></td>
                                <td class='puzzidea'><?php echo $title; ?></td>
                                <td class='puzzidea'><?php echo $statuses[$puzzleInfo["pstatus"]]; ?></td>
                                <?php if ($showAnswerAndSummary) {echo "<td class='puzzidea'>" . $puzzleInfo["summary"] . "</td>";} ?>
                                <?php if ($showNotes) {echo "<td class='puzzidea'>" . $puzzleInfo["notes"] . "</td>";} ?>
                                <?php if ($showAnswerAndSummary) {echo "<td class='puzzidea'>" . getAnswersForPuzzleAsList($pid) . "</td>";} ?>
                                <?php if (!$test) {echo "<td class='puzzidea'>$lastComment</td>";} ?>
                                <?php if ($showAuthorsAndEditors) {echo "<td class='puzzidea'>" . getAuthorsAsList($pid) . "</td>";} ?>
                                <?php if ($showAuthorsAndEditors) {echo "<td class='puzzidea'>" . getEditorsAsList($pid) . "</td>";} ?>
                                <?php if ($showTesters) {echo "<td class='puzzidea'>" . getCurrentTestersAsList($pid) . "</td>";} ?>
                        </tr>
<?php
                }
?>
                </tbody>
                </table>
<?php
        }
        
// Make groups of checkboxes
// Takes an associative array and the name of the form element
function makeOptionElements($toDisplay, $name)
{
        $maxLength = 5;
        $maxCol = 10;
        
        // Figure out how many columns are necessary to maintain max length
        // Use maxCol to keep from having too many columns
        $numCol = min(ceil(count(array_keys($toDisplay))/$maxLength), $maxCol);
        
        $i = 1;
        echo '<table>';
        foreach ($toDisplay as $key => $value) {
                if ($key == NULL)
                        continue;
                
                // Start a new row, if necessary
                if (($i % $numCol) == 1)
                        echo '<tr>';
                
                // Add answer information
                echo '<td>';
                echo "<input type='checkbox' name='$name" . "[]' value='$key' />";
                echo '</td>';
                echo "<td>$value</td>";
                
                // End row, if number of columns reached
                if (($i % $numCol) == 0)
                        echo '</tr>';
                
                $i++;
        }
        
        // Close last row, if necessary
        if (($i % $numCol) != 1)
                echo '</tr>';
        echo '</table>';
}

function displayPuzzleStats($uid)
{
        $max_rows = 6;
        
        $totalNumberOfPuzzles = count(getAllPuzzles());
        $numberOfEditors = getNumberOfEditorsOnPuzzles();
        $moreThanThree = $totalNumberOfPuzzles - $numberOfEditors['0'] - $numberOfEditors['1'] - $numberOfEditors['2'] - $numberOfEditors['3'];
                                                        
        $userNumbers = getNumberOfPuzzlesForUser($uid);
        
        $editor = $userNumbers['editor'];
                
        $tester = $userNumbers['currentTester'];
        if ($userNumbers['doneTester'] > 0)
                $tester .= ' (+' . $userNumbers['doneTester'] . ' done)';

?>
                <table>
                        <tr>
                        <td class="puzz-stats">
                                <table>
                                        <tr>
                                                <th class="puzz-stats" colspan="2"><?php echo $totalNumberOfPuzzles; ?> Total Puzzles</th>
                                        </tr>
                                        <tr>
                                                <td class="puzz-stats">You Are Editor</td>
                                                <td class="puzz-stats"><?php echo $editor; ?></td>
                                        </tr>
                                        <tr>
                                                <td class="puzz-stats">You Are Author</td>
                                                <td class="puzz-stats"><?php echo $userNumbers['author']; ?></td>
                                        </tr>
                                        <tr>
                                                <td class="puzz-stats">You Are Spoiled</td>
                                                <td class="puzz-stats"><?php echo $userNumbers['spoiled']; ?></td>
                                        </tr>
                                        <tr>
                                                <td class="puzz-stats">You Are Tester</td>
                                                <td class="puzz-stats"><?php echo $tester; ?></td>
                                        </tr>
                                        <tr>
                                                <td class="puzz-stats">Available To Edit</td>
                                                <td class="puzz-stats"><?php echo $userNumbers['available']; ?></td>
                                        </tr>
                                </table>
                        </td>
                        <td class="ed-stats">
                                <table>
                                        <tr>
                                                <th class="ed-stats" colspan="2">Num of Editors</th>
                                        </tr>
                                        <tr>
                                                <td class="ed-stats">Zero</td>
                                                <td class="ed-stats"><?php echo $numberOfEditors['0']; ?></td>
                                        </tr>
                                        <tr>
                                                <td class="ed-stats">One</td>
                                                <td class="ed-stats"><?php echo $numberOfEditors['1']; ?></td>
                                        </tr>
                                        <tr>
                                                <td class="ed-stats">Two</td>
                                                <td class="ed-stats"><?php echo $numberOfEditors['2']; ?></td>
                                        </tr>
                                        <tr>
                                                <td class="ed-stats">Three</td>
                                                <td class="ed-stats"><?php echo $numberOfEditors['3']; ?></td>
                                        </tr>
                                        <tr>
                                                <td class="ed-stats">&gt;Three</td>
                                                <td class="ed-stats"><?php echo $moreThanThree; ?></td>
                                        </tr>
                                </table>
                        </td>
<?php 

                $puzzleStatuses = getPuzzleStatuses();
                $pstatusCol = ceil(count($puzzleStatuses) / $max_rows) * 2;
                
                $statuses = NULL;
                $statusCounts = getPuzzleStatusCounts();
                foreach ($puzzleStatuses as $sid => $name) {
                        $count = (array_key_exists($sid, $statusCounts) ? $statusCounts[$sid] : 0);
                        $status = NULL;
                        $status['id'] = $sid;
                        $status['name'] = $name;
                        $status['count'] = $count;
                        $statuses[] = $status;
                }
?>
                        <td class="p-stats">
                                <table>
                                        <tr>
                                                <th class="p-stats" colspan="<?php echo $pstatusCol; ?>">Puzzle Status</th>
                                        </tr>
<?php 
                for ($row = 0; $row < $max_rows; $row++) {
                        for ($col = 0; $col < ($pstatusCol / 2); $col++) {
                                $n = $row + ($col * $max_rows);
                        
                                if ($col==0)
                                        echo '
                                                <tr>';
                        
                                if ($n >= count($puzzleStatuses)) {
                                        echo '
                                                <td></td>';
                                        echo '
                                                <td></td>';
                                } else {
                                        $num = $statuses[$n];
                                        $name = $num['name'];
                                        $count = $num['count'];
                                
                                        echo '
                                                <td class="p-stats">' . $name . '</td>';
                                        echo '
                                                <td class="p-stats">' . $count . '</td>';
                                }
                                
                                if ($col == ($pstatusCol/2 - 1)) {
                                        echo '
                                                </tr>';
                                }
                        }
                }
?>
                                </table>
                        </td>                        
                        </tr>
                </table>
<?php
        }
?>
