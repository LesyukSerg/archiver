<?
	function deleteFilesAndDirs($dir){
		if($dirs = scandir($dir)){
			unset(
				$dirs[array_search('.',$dirs)],
				$dirs[array_search('..',$dirs)],
				$dirs[array_search('.git',$dirs)],
				$dirs[array_search('archive.log',$dirs)],
				$dirs[array_search('dellall.php',$dirs)]
			);
			
			if(current($dirs)){
				do{
					if (is_file($dir.'/'.current($dirs))){
						unlink($dir.'/'.current($dirs));
					}else{
						deleteFilesAndDirs($dir.'/'.current($dirs));
					}
				}while(next($dirs));
			}
		}
		rmdir($dir);
	}
	
	
	if($_GET['delete_all']){
		$pathname = getcwd();
		deleteFilesAndDirs($pathname);
	}
?>