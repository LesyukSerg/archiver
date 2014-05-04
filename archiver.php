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
	$src_dir = dirname(__FILE__)."/";
	
	addFolderCount($src_dir, $all_count);
	
	# Подсчет всех файлов в корне -------------
	function addFolderCount($dir, &$cnt){
		if ($dh = opendir($dir)) {
			#  цикл по всем файлам
			while (($file = readdir($dh)) !== false) {				
				if(is_dir($dir . $file)){
					if($file !== "." && $file !== ".."){
						addFolderCount($dir . $file . "/", $cnt);
					}
				}else{
					$cnt++;
				}
			}
		}
	}
	
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
						if($file !==__FILE__){
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
			<h1>Архіватор сайту</h1>
			Всього файлів <b><?=$all_count?></b>
			<div id="form_block">
				<form enctype="multipart/form-data" action="<?=$_SERVER['REQUEST_URI']?>" method="GET">
					<fieldset>
						<legend title="">Виберіть директорію для архівування:</legend>
						<input id="alldir" type="checkbox" name="dir" value="" onclick="" /> Усі файли та теки<br />
<?
						foreach($dirs as $dir){
							if (is_dir($archive_dir.$dir) && $dir != "." && $dir != "..") {
?>
								<input class="selecteddir" type="checkbox" name="dir[<?=$dir?>]" value="<?=$dir?>" /> <?=$dir?><br />
<?
							}
						}
?>
						<fieldset>
							<legend title="">Або впишіть шлях до вкладеної теки:</legend>
							<input type="text" name="dir_write" value="<?=$_GET['dir_write']?>" size="100"/> <br />
						</fieldset>
					</fieldset>
					
					<fieldset>
						<legend title="" >Які теки слід виключити: вводити через "|"</legend>
						<input type="text" name="exept" value="<?=$_GET['exept']?>" size="100" />
					</fieldset>
					<fieldset>
						<legend title="" >Не архівувати файли більше ніж:</legend>
						<input type="text" name="max_size" value="100" /> мб
					</fieldset>
					<fieldset>
						<legend title="" >Обмеження за кількістю файлів:</legend>
						от <input type="text" name="min" value="0" /> до <input type="text" name="max" value="14000" />
					</fieldset>
					
					<input type="submit" name="submit" value="РОЗПОЧАТИ АРХІВАЦІЮ" />
				</form>
				
				<fieldset>
					<legend title="" >Хід виконання архівації:</legend>
					<div>
<?
						if($_GET['submit']){
							
							if($_GET['dir_write']){
								unset($_GET['dir']);
								$_GET['dir'] = $_GET['dir_write'];
							}
							
							if(isset($_GET['dir'])){
								# создание zip архива
								$zip = new ZipArchive();
								# имя файла архива
								if(is_array($_GET['dir'])) {
									$archname = implode("-",$_GET['dir'])."-backup_".date('Y_m_d_H_i_s').".zip";
								} elseif($_GET['dir_write']) {
									$archname = $_GET['dir_write']."-backup_".date('Y_m_d_H_i_s').".zip";
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
								if(is_array($_GET['dir'])) {
									foreach($_GET['dir'] as $onedir){
										# папка с исходными файлами
										$src_dir = dirname(__FILE__)."/".$onedir."/";
										addFolderToZip($src_dir, $zip, $onedir."/", $count);
									}
								} else {
									$src_dir = dirname(__FILE__)."/".$_GET['dir']."/";
									addFolderToZip($src_dir, $zip, '', $count);
								}
								
								# закрываем архив
								$zip->close();

								echo "<br />Архів <a href='$archname'>".$archname."</a> створено. Він вміщує ".$count." файлів";
							} else {
								echo "Виберіть теку";
							}
						}
?>
					</div>
				</fieldset>
			</div>
		</div>
	</body>
</html>