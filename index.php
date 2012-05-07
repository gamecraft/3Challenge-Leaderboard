<?php 
header("Content-Type: text/html; charset=utf-8");
require_once("include_me.php");
$sql = "SELECT name, likes, pageUrl FROM ideas ORDER BY likes DESC";
$res = $database -> query ($sql);
$ideas = array();
$totalLikes = 0;
while ($row = $res -> fetch(PDO::FETCH_OBJ)) {
	$ideas[] = $row;
	$totalLikes += $row -> likes;
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>3Challenge 2012 Pre-Idea Scoreboard</title>
        <link rel="stylesheet" href="main.css" type="text/css" media="screen" />
        <script src="http://code.jquery.com/jquery-1.5.2.js" type="text/javascript" language="javascript" charset="utf-8"></script>
		   <script type="text/javascript" language="javascript">
            $(document).ready(function() {
                $("tr:odd").addClass("odd");
                $("tr:even").addClass("even");
				$("tr").hover(function(){
						$(this).addClass("rowHover");
				}, function() {
					$(this).removeClass("rowHover");
				});
				// color top six
				$("tr:lt(7)").addClass("topsix");
            });
        </script>
	</head>
	<body>
		 <table>
            <thead>
                <tr>
                    <th>Идеи: (<?php echo count($ideas); ?> общо)</th>
                    <th>Гласове: (<?php echo $totalLikes; ?> общо)</th>
                </tr>
            </thead>			            
			<tbody>
				<?php
					foreach($ideas as $idea) {
						echo "<tr>";
						echo "<td>";
						echo sprintf('<a href="%s" target="_blank">%s</a>', $idea->pageUrl, $idea -> name);
						echo "</td>";
						
						echo "<td>";
						echo $idea -> likes;
						echo "</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
		<div id="footer">
			Leaderboard by <a href="http://game-craft.com/?ref=3clb" target="_blank">GameCraft</a>
		</div>
		<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31459331-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	</body>
</html>