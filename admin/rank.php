<?php
if (isset($_GET['stock']))
{
if (mysql_query("DELETE FROM `".$db."`.`stocks` WHERE `stocks`.`name` = '".$_GET['stock']."'")) echo "Successfully Removed";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xml:lang="en-gb" xmlns="http://www.w3.org/1999/xhtml" lang="en-gb"><head>


  <title>SMS | ADMIN</title>
  <script type="text/javascript" src="js/core.js"></script>
  <script type="text/javascript" src="js/mootools-core.js"></script>
  <script type="text/javascript" src="js/mootools-more.js"></script>
  <script type="text/javascript">
	window.addEvent('domready', function(){ new Accordion($$('div#panel-sliders.pane-sliders .panel h3.jpane-toggler'), $$('div#panel-sliders.pane-sliders .panel div.jpane-slider'), {onActive: function(toggler, i) {toggler.addClass('jpane-toggler-down');toggler.removeClass('jpane-toggler');Cookie.write('jpanesliders_panel-sliders',$$('div#panel-sliders.pane-sliders .panel h3').indexOf(toggler));},onBackground: function(toggler, i) {toggler.addClass('jpane-toggler');toggler.removeClass('jpane-toggler-down');if($$('div#panel-sliders.pane-sliders .panel h3').length==$$('div#panel-sliders.pane-sliders .panel h3.jpane-toggler').length) Cookie.write('jpanesliders_panel-sliders',-1);},duration: 300,opacity: false,alwaysHide: true}); });
  </script>


<link rel="stylesheet" href="css/system.css" type="text/css">
<link href="css/template.css" rel="stylesheet" type="text/css">


	<link rel="stylesheet" type="text/css" href="css/rounded.css">




</head><body id="minwidth-body">
	<div id="border-top" class="h_blue">
		<div>
			<div>
				<span class="logo"><a href="#">&nbsp;</a></span>
				<span class="title"><a href="http://localhost/16/administrator/index.php">SU-RMS</a></span>
			</div>
		</div>
	</div>
	<div id="header-box">
		<div id="module-status">
			<span class="loggedin-users">&nbsp;</span><span class="backloggedin-users">&nbsp;</span><span class="no-unread-messages"><a href="#">&nbsp;</a></span><span class="viewsite"><a href="#" target="_blank">&nbsp;</a></span>
			<span class="logout"><a href="index.php?option=logout">Log out</a></span>		</div>
<?php
include("menu.php");
			$username = $_SESSION['username'];
			$id = $_SESSION['id'];
?>
		<div class="clr"></div>
	</div>
	<div id="content-box">
		<div class="border">
			<div class="padding">
				<div id="element-box">
					
					<div class="t">
						<div class="t">
							<div class="t"></div>
						</div>
					</div>
					<div class="m">
					<div class="adminform">
						<div class="cpanel-right" style = "width:100%">
							
<div id="panel-sliders" class="pane-sliders"><div class="panel"><h3 class="jpane-toggler title" id="cpanel-panel-popular">Welcome <?php echo $id; ?></h3><div style="padding-top: 0px; border-top: medium none; padding-bottom: 0px; border-bottom: medium none; overflow: hidden; height: 0px;" class="jpane-slider content"><table class="adminlist">
	<thead>
		<tr>
			<th>
				<strong>Rank</strong>
			</th>
			<th>
				<strong>Username</strong>
			</th>
			<th>
				<strong>Current Total Worth (Inhand + Stock)</strong>
			</th>
			<th>
				<strong>Round Figure</strong>
			</th>
		</tr>
	</thead>
	<tbody>
	
	<tr>



	
	<?php
			$rank=1;
			$details = mysql_query("SELECT (table1.inhandbalance+table2.stockworth) AS worth, table2.username AS username FROM (SELECT (100000-t2.buytotal+t1.selltotal) AS inhandbalance, t2.username AS username from (SELECT sum(`sell`.`rate`*`sell`.`amount`) AS selltotal, `sell`.`username` AS username FROM `sell` WHERE `sell`.`success`='1' GROUP BY `sell`.`username`) AS t1, (SELECT sum(`buy`.`rate`*`buy`.`amount`) AS buytotal, `buy`.`username` AS username FROM `buy` GROUP BY `buy`.`username`) AS t2 WHERE t1.username=t2.username) AS table1, (SELECT (t4.cbuy-t3.csell) AS stockworth, t3.username AS username FROM (SELECT sum(`stocks`.`last_data`*`sell`.`amount`) AS csell, `sell`.`username` AS username FROM `stocks`,`sell` WHERE  `sell`.`success`='1' AND `sell`.`stock`=`stocks`.`name` GROUP BY `sell`.`username`) as t3, (SELECT  sum(`stocks`.`last_data`*`buy`.`amount`) AS cbuy, `buy`.`username` AS username FROM `stocks`,`buy` WHERE  `buy`.`success`='1' AND `buy`.`stock`=`stocks`.`name` GROUP BY `buy`.`username`) AS t4 WHERE t3.username=t4.username) AS table2 
WHERE table2.username=table1.username ORDER BY worth DESC");
			while ($detail = mysql_fetch_array($details))
			{
					echo "<tr><td class='center'>";
					echo $rank;
					echo "</td>";
					
					echo "<td class='center'>".$detail['username']."</td>";
					echo "<td class='center'>".$detail['worth']."</td>";
					echo "<td class='center'>".round($detail['worth'], 2)."</td></tr>";
					$rank++;
					
			}
			
	?>
	
	
	



			</tbody>
</table>
</div></div>


						</div>
					</div>
						<div class="clr"></div>
					</div>
					<div class="b">
						<div class="b">
							<div class="b"></div>
						</div>
					</div>
				</div>
				<div class="clr"></div>
			</div>
		</div>
	</div>
	<div id="border-bottom"><div><div></div></div></div>
		
	<div id="footer">
		<p class="copyright">
			<b>ACM, BITS Pilani</b> Stock Market Simulation</a>.			<span class="version"><i>V (beta0.0.1)</i></span>
		</p>
	</div>
</body></html>
