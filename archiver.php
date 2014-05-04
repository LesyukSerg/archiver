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

	if($_GET['get_count']) {
		addFolderCount($src_dir, $all_count);
	} else {
		$all_count = " багацько";
	}
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
						if( ($file !== ".") && $file !== ".." && !in_array($file, explode("|",$_POST['exept'])) ){
							addFolderToZip($dir . $file . "/", $zipArchive, $zipdir . $file . "/", $cnt);
						}
					}else{
						# Добавляем файлы в архив
						if($file !==__FILE__){
							$cnt++;
							if($cnt > $_POST['max']){
								break;
							}
							
							if($cnt > $_POST['min'] && filesize($dir.$file) < $_POST['max_size']*1024 ){
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
			<div id="form_block">
				<form enctype="multipart/form-data" action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
					<fieldset class="right">
						<legend title="">Кількість файлів:</legend>
						Всього файлів <b><?=$all_count?></b>
						<input type="checkbox" id="get_count" name="get_count" value='1' checked="checked" onclick="if(this.checked)window.location=window.location.href+'/?get_count=1'; else window.location='<?='http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']?>'" /> Показати кількість файлів.(Це займе деякий час...)<br />
					</fieldset>
					
					<fieldset class="left">
						<legend title="">Виберіть директорію для архівування:</legend>
						<script>
						var get_count = document.getElementById('get_count');
							<?if(!$_GET['get_count']):?>
								document.getElementById('get_count').checked = false;
							<?endif;?>
							
							function turn_of(alldir){
								if(alldir.checked) {
									var f1 = document.getElementsByTagName('input');
									for (var i=0; i<f1.length; i++) {
										if (f1[i].className == 'selecteddir')
										f1[i].checked = false;
									}
								}
							}
						</script>
						<input id="alldir" type="checkbox" name="dir" value="" onclick="turn_of(this)" /> <b>Усі файли та теки</b><br />
<?
						foreach($dirs as $dir){
							if (is_dir($archive_dir.$dir) && $dir != "." && $dir != "..") {
?>
								<input class="selecteddir" type="checkbox" name="dir[<?=$dir?>]" value="<?=$dir?>" onclick="alldir.checked=false" /> <?=$dir?><br />
<?
							}
						}
?>
						<fieldset>
							<legend title="">Або впишіть шлях до вкладеної теки:</legend>
							<input type="text" name="dir_write" value="<?=$_POST['dir_write']?>" style="width:99%" /> <br />
						</fieldset>
					</fieldset>
				
					<fieldset class="right">
						<legend title="" >Які теки слід виключити: вводити через "|"</legend>
						<textarea cols="10" rows="4" name="exept" style="resize:none; width: 99%"><?=$_POST['exept']?></textarea>
					</fieldset>
				
					<fieldset class="right">
						<legend title="" >Не архівувати файли більше ніж:</legend>
<?
						if(!$_POST['max_size']) $_POST['max_size'] = 10240;
?>
						<input type="text" name="max_size" value="<?=$_POST['max_size']?>"  /> кб
					</fieldset>
					
					<fieldset class="right">
						<legend title="" >Обмеження за кількістю файлів:</legend>
<?
						if(!$_POST['max']) $_POST['min'] = 0;
						if(!$_POST['max']) $_POST['max'] = 14000;
?>
						від <input type="text" name="min" value="<?=$_POST['min']?>" /> до <input type="text" name="max" value="<?=$_POST['max']?>" />
					</fieldset>
					<div class="clear"></div>
					<input type="submit" name="submit" value="РОЗПОЧАТИ АРХІВАЦІЮ" />
				</form>
				<div class="clear"></div>
				<fieldset>
					<legend title="" >Хід виконання архівації:</legend>
					<div>
<?
						if($_POST['submit']){
							if($_POST['dir_write']){
								unset($_POST['dir']);
								$_POST['dir'] = $_POST['dir_write'];
							}
							
							if(isset($_POST['dir'])){
								# создание zip архива
								$zip = new ZipArchive();
								# имя файла архива
								if(is_array($_POST['dir'])) {
									$archname = implode("-",$_POST['dir'])."-backup_".date('Y_m_d_H_i_s').".zip";
								} elseif($_POST['dir_write']) {
									$archname = $_POST['dir_write']."-backup_".date('Y_m_d_H_i_s').".zip";
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
								if(is_array($_POST['dir'])) {
									foreach($_POST['dir'] as $onedir){
										# папка с исходными файлами
										$src_dir = dirname(__FILE__)."/".$onedir."/";
										addFolderToZip($src_dir, $zip, $onedir."/", $count);
									}
								} else {
									$src_dir = dirname(__FILE__)."/".$_POST['dir']."/";
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