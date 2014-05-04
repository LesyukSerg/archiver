<? set_time_limit(0); ?>
<!DOCTYPE html>
<html>
	<head>
		<META http-equiv="content-type" content="text/html; charset=utf-8" />
		<META NAME="Author" CONTENT="Lesyuk Sergiy">
		<title>Archiver</title>
	</head>
<?	
	# папка в которой будет размещен архив
	$archive_dir = dirname(__FILE__);
	
	$dirs = scandir($archive_dir);
	$count = 0;
	$archive_dir = $archive_dir."/";
	
	# Рекурсивная функция просмотра и архивации вложеных файлов и папок
	function addFolderToZip($dir, &$zipArchive, $zipdir = '', &$cnt){
		if (is_dir($dir)) {
			echo "<b><span title='".$dir."'> * </span></b>";
			if ($dh = opendir($dir)) {
				# Добавляем пустую директорию
				if(!empty($zipdir)) $zipArchive->addEmptyDir($zipdir);
			  
				#  цикл по всем файлам
				while (($file = readdir($dh)) !== false) {
			  
					# если это папка запускаем функцию опять
					if(is_dir($dir . $file)){
						# пропуск директорий '.' и '..'
						if( ($file !== ".") && $file !== ".." && !in_array($file, explode("|",$_GET['exept'])) ){
							addFolderToZip($dir . $file . "/", $zipArchive, $zipdir . $file . "/", $cnt);
						}
					}else{
						# Добавляем файлы в архив
						if(!strstr($file,"zip") && $file !==__FILE__){
							$cnt++;
							if($cnt > $_GET['max']){
								break;
							}
							
							if($cnt > $_GET['min'] && filesize($dir.$file) < $_GET['max_size']*1048576 ){
								$zipArchive->addFile($dir . $file, $zipdir . $file);
								echo "<span title='".$dir.$file."'> . </span>";
								// echo (1000000+$cnt)." - ".$dir.$file." OK <br />";
							}
						}
					}
				}
			}
		}
	}
?>
	<body>
		<div id="wpapper">
			<h1>Архиватор сайта</h1>
			<div id="form_block">
				<form enctype="multipart/form-data" action="<?=$_SERVER['REQUEST_URI']?>" method="GET">
					<fieldset>
						<legend title="">Выберите директорию для архивирования:</legend>
						<input type="radio" name="dir" value="" /> Все файлы и папки<br />
<?
						foreach($dirs as $dir){
							if (is_dir($archive_dir.$dir) && $dir != "." && $dir != "..") {
?>
								<input type="radio" name="dir" value="<?=$dir?>" /> <?=$dir?><br />
<?
							}
						}
?>
						<fieldset>
							<legend title="">Или впишите путь к вложеной папке:</legend>
							<input type="text" name="dir_write" value="" size="100"/> <br />
						</fieldset>
					</fieldset>
					
					<fieldset>
						<legend title="" >Какие папки следует исключить: вводить через "|"</legend>
						<input type="text" name="exept" value="" size="100" />
					</fieldset>
					<fieldset>
						<legend title="" >Не архивировать файлы больше чем:</legend>
						<input type="text" name="max_size" value="100" /> мб
					</fieldset>
					<fieldset>
						<legend title="" >Ограничение по количеству файлов:</legend>
						от <input type="text" name="min" value="0" /> до <input type="text" name="max" value="14000" />
					</fieldset>
					
					<input type="submit" name="submit" value="START" />
				</form>
				
				<fieldset>
					<legend title="" >Ход выполнения архивации:</legend>
					<div>
<?
						if($_GET['submit']){
							if($_GET['dir_write']) $_GET['dir'] = $_GET['dir_write'];
							
							if(isset($_GET['dir'])){
								
								# папка с исходными файлами
								$src_dir = dirname(__FILE__)."/".$_GET['dir']."/";

								# создание zip архива
								$zip = new ZipArchive();
								# имя файла архива
								if($_GET['dir']) {
									$archname = $_GET['dir']."-backup_".date('Y_m_d_H_i_s').".zip";
								} else {
									$archname = "all-backup_".date('Y_m_d_H_i_s').".zip";
								}
								$fileName = $archive_dir.$archname;
								if ($zip->open($fileName, ZIPARCHIVE::CREATE) !== true) {
									fwrite(STDERR, "Error while creating archive file");
									echo "zip не установлен";
									exit(1);
								}

								# добавляем файлы в архив все файлы из папки src_dir
								addFolderToZip($src_dir, $zip, '', $count);
								# закрываем архив
								$zip->close();

								echo "<br />Archive <a href='/$archname'>".$archname."</a> created. Contains ".$count." files";
							} else {
								echo "Выберите директорию";
							}
						}
?>
					</div>
				</fieldset>
			</div>
		</div>
	</body>
</html>