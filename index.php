<?php

        require_once "config.php";
        require_once "html.php";
        require_once "db-func.php";
        require_once "utils.php";

        // Redirect to the login page, if not logged in
        $uid = isLoggedIn();

        // Start HTML
        head("home");

        $hunt=mktime(12,17,00,1,14,2011);
        $now = time();
        $tth=$hunt-$now;
        $days=floor($tth/(60 * 60 * 24));
        $hrs=floor($tth/(60 * 60))-(24*$days);
        $mins=floor($tth/(60))-(24*60*$days)-(60*$hrs);

  echo '<h2><font color="red">NEW:</font> Manic Sages social hours, <font
  color="red">Wednesday and Thursday @ 10 PM US Eastern time</font>.
  Join us in the chatbox below (or on irc.manicsages.org #hunt2013)!</h2>';
  echo '<br>';
  echo '<iframe width=570 height=340 border=0 frameborder=none
  src="http://widget.mibbit.com/?server=irc.manicsages.org&channel=%23hunt2013&nick='
  . getUserUsername($uid) . '_%3F%3F%3F%3F&autoConnect=true"></iframe>';

        echo "<h2>Latest Updates:</h2>\n";

        // Display index page
        // Put messages to the team here (separate for blind and non-blind solvers?)
?>
<div class="team-updates">
<b>Wednesday, February 2:</b><br/>
Welcome to the hunt editing server!<br>
</div>
<h3 style="padding-bottom:0.5em;"><a href="updates.php">Past Updates</a></h3>
<?        // End HTML
        foot();
?>
