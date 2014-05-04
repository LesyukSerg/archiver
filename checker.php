<?
	if(!$_GET['dwnld']){
		$pathname = getcwd();
		$dirs = scandir($pathname);
		
		$check = "/\d+/";
		$last = 0;
		foreach($dirs as $file){
			preg_match($check, $file, $vers);
			
			if($vers[0] > $last){
				$last = $vers[0];
			}
		}

		if($_GET['curr'] < $last){
			echo "Остання версія <a title='Завантажити' href='http://lesyuk-serg.w.pw/archiver/checker.php?dwnld=".$last."'>".$last."</a>";
		} else {
			echo $last;
		}
	} else {
		header('Content-type: application/php');
		$file = "archiver_".$_GET['dwnld'].".php";
		header('Content-Disposition: attachment; filename="'.$file.'"');
		readfile($file);
	}
?>