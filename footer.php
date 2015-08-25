
</div>
<?php require "common/preLoadWidgets.php"; ?><div style="text-align: center; clear:both; margin-top: 20px;">
<a href="/index.php">home</a> | 
<a href="/contactus.php">contact us </a>
<?php $cms = new cms("cms"); 
$pages = $cms->getStaticPage();
if(is_array($pages))
	{
	foreach($pages as $page)
		{
		echo " | <a href='/cms.php?filename=".$page['filename']."'>".$page['menuname']."</a>";
		}
	}
?>
</div>
<br />
</body>
</html>
