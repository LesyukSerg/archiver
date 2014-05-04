<?/*
	-archiver_201307311120
		метод выдправки форми змінений на POST
		змінена перевірка на розмір файлів

	-archiver_201308021520
		додана можливість обчислення кількості файлів
		вибрані налаштування зберігаються після створення архіву
		трохи змінений інтерфейс

	-archiver_201308060806_edit_by_artem
		виправлені помилки при роботы в браузері Opera

	-archiver_201308061321
		додана можливість розархівації

	-archiver_201308071023
		додано виключення файлу самого архыватора із архіву
		додана функція flush, завдяки якій повинен точніше відображатись хід архівації
		
	-archiver_201308081003
		додано назва повного дампу буде складатися із назви серверу та дати створення
		додано log файл, який залишаэться якщо архівацыя не дійшла до кінця
	
	-archiver_201308121800
		додано доповнення архіву
		
	-archiver_201308131230
		вернув старый лог архівації
		
	-archiver_201308131230
		виправив баг стосовно opendir i closedir
		
*/
	set_time_limit(0);
?>
<!DOCTYPE html>
<html>
	<head>
		<META http-equiv="content-type" content="text/html; charset=utf-8" />
		<META NAME="Author" CONTENT="Lesyuk Sergiy">
		<title>Archiver</title>
		<style>
			/*
			fieldset.left { float:left; width: 47%; }
			fieldset.right { float:right; width: 47%; }
			.clear { clear:both; }
			*/
			
			input.archivatorstart {
				font-size: 20px;
				margin: 8px 0 4px;
				width: 100%;
				cursor: pointer;
			}
			
			.archivelog div { max-height: 394px; overflow: auto; }
		</style>
	</head>
<?
	# тека в якій буде размішено архів
	$archive_dir = dirname(__FILE__);
	var_dump($archive_dir);
	$dirs = scandir($archive_dir);
	$count = 0;
	$archive_dir = $archive_dir."/";
	$src_dir = dirname(__FILE__)."/";
	
	$log_file = "archive_log.txt";

	if($_GET['get_count']) {
		addFolderCount($src_dir, $all_count);
	} else {
		$all_count = " багацько";
	}
	# Підрахунок всіх файлів в корені -------------
	function addFolderCount($dir, &$cnt){
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if(is_dir($dir . $file)){
					if($file !== "." && $file !== ".."){
						addFolderCount($dir . $file . "/", $cnt);
					}
				}else{
					$cnt++;
				}
			}
			closedir($dh);
		}
	}

	# Рекурсивна функція архівації вкладених файлів і тек
	function addFolderToZip($dir, &$zipArchive, $zipdir = '', &$cnt, &$fp){
		if (is_dir($dir)) {
			fwrite($fp, $dir."\n");

			if ($dh = opendir($dir)){
				# Додаємо порожню директорію
				if(!empty($zipdir)){
					if($zipArchive->addEmptyDir($zipdir) === false){
						echo "Помилка при додаванні порожної теки - $zipdir<br />";
					} else {
						//echo "<b><span title='".$dir."'> * </span></b>";
						echo "<b>$dir</b><br />";
					}
				}

				#  цикл по всім файлам
				while (($file = readdir($dh)) !== false) {
					# якщо це тека - запускаємо функцію
					if(is_dir($dir . $file)){
						# пропуск директорій '.' і '..'
						if( ($file !== ".") && $file !== ".." && !in_array($file, explode("|",$_POST['exept'])) ){
							addFolderToZip($dir . $file . "/", $zipArchive, $zipdir . $file . "/", $cnt, $fp);
						}
					}else{
						# Додаємо файли в архів
						if($file !==__FILE__){
							$cnt++;
							if($cnt > $_POST['max']){
								break;
							}

							if($cnt > $_POST['min'] && filesize($dir.$file) < $_POST['max_size']*1024 && $file != basename(__FILE__) && !strstr($file, "zip")){
								if($zipArchive->addFile($dir . $file, $zipdir . $file)){
									echo (1000000+$cnt)." - ".$dir.$file." OK <br />";
									//echo "<span title='".$dir.$file."'> . </span>";
								} else {
									echo "Помилка архівації: файл $dir.$file<br />";
								}
								flush();
								fwrite($fp, (1000000+$cnt)." - $dir.$file OK\n");
							}
						}
					}
				}
				closedir($dh);
			}
		}
	}
?>
	<body>
		<div id="wpapper">
			<h1>Архіватор сайту</h1>
			<div id="form_block">
				<fieldset class="right">
					<legend title="">Кількість файлів:</legend>
					Всього файлів <b><?=$all_count?></b>
					<input type="checkbox" id="get_count" name="get_count" value='1' checked="checked" onclick="if(get_count.checked)window.location=window.location.href+'/?get_count=1'; else window.location='<?='http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']?>'" /> Показати кількість файлів.(Це займе деякий час...)<br />
				</fieldset>
				<fieldset>
					<legend title="" >Знайдені архіви:</legend>
<?
						foreach($dirs as $dir){
							if (!is_dir($archive_dir.$dir) && strstr($dir, "zip")){
?>
								<form enctype="multipart/form-data" action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
									<input class="selectedzip" type="radio" name="zipfile" value="<?=$dir?>" checked="checked" /> <?=$dir?> <input type="submit" name="unzip" value="Видобути архів" />
								</form>
<?
							}
						}
?>
					<fieldset>
						<legend title="" >Хід виконання розархівації:</legend>
						<div>
<?
							if($_POST['unzip']){
								if($_POST['zipfile']) {
									$zipfile = $archive_dir.$_POST['zipfile'];

									if(file_exists($zipfile)){
										$zip = new ZipArchive;
										$res = $zip->open($zipfile);
										if ($res === TRUE) {
											$zip->extractTo($archive_dir);
											$zip->close();
											echo "Ура! Архів <b>".$_POST['zipfile']."</b> успішно відобуто в директорію $archive_dir";
										} else {
											echo "Архів <b>".$_POST['zipfile']."</b> пожкоджено";
										}
									} else {
										echo "Файл не знайдено";
									}
								} else {
									echo "Виберіть файл для розархівування";
								}
							}
?>
						</div>
					</fieldset>
				</fieldset>
				<hr /><hr /><hr />
				<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
					<fieldset class="left">
						<legend title="">Виберіть архів:</legend>
						<input class="addtozip" type="radio" name="addtozip" value="new" checked="checked" /> Створити новий архів<br />
<?
						foreach($dirs as $dir){
							if (!is_dir($archive_dir.$dir) && strstr($dir, "zip")){
?>
								<input class="addtozip" type="radio" name="addtozip" value="<?=$dir?>" /> Доповнити архів <b><?=$dir?></b><br />
<?
							}
						}
?>
					</fieldset>
					
					<fieldset class="left">
						<legend title="">Виберіть директорію для архівування:</legend>
						<script>
							<?if(!$_GET['get_count']):?>
								document.getElementById('get_count').checked = false;
							<?endif;?>

							function turn_of(alldir){
								if(alldir.checked) {
									var f1 = document.getElementsByTagName('input');
									for (var i=0; i<f1.length; i++)
										if (f1[i].className == 'selecteddir')
											f1[i].checked = false;
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
						if(!$_POST['max']) $_POST['max'] = 20000;
?>
						від <input type="text" name="min" value="<?=$_POST['min']?>" /> до <input type="text" name="max" value="<?=$_POST['max']?>" />
					</fieldset>
					<div class="clear"></div>
					<input class="archivatorstart" type="submit" name="submit" value="РОЗПОЧАТИ АРХІВАЦІЮ" />
				</form>
				<div class="clear"></div>
				<fieldset class="archivelog">
					<legend title="" >Хід виконання архівації:</legend>
					<div>
<?
						if($_POST['submit']){
							if($_POST['dir_write']){
								unset($_POST['dir']);
								$_POST['dir'] = $_POST['dir_write'];
							}

							if(isset($_POST['dir'])){								
								# створення zip архіву
								$zip = new ZipArchive();
								
								# ім'я архіва
								if($_POST['addtozip'] == 'new') {
									if(is_array($_POST['dir'])) {
										$archname = implode("-",$_POST['dir'])."-backup_".date('Y_m_d_H_i_s').".zip";
									} elseif($_POST['dir_write']) {
										$archname = $_POST['dir_write']."-backup_".date('Y_m_d_H_i_s').".zip";
									} else {
										$archname = $_SERVER['SERVER_NAME']."-backup_".date('Y_m_d_H_i_s').".zip";
									}
								} else {
									$archname = $_POST['addtozip'];
								}
								$fileName = $archive_dir.$archname;
								
								if ($zip->open($fileName, ZIPARCHIVE::CREATE) !== true) {
									fwrite(STDERR, "Error while creating archive file");
									echo "zip не установлен";
									exit(1);
								}

								# додаємо файли в архів всі файли із теки src_dir
								$fp = fopen($log_file, 'w');
								fwrite($fp, $fileName."\n");
								
								if(is_array($_POST['dir'])) {
									foreach($_POST['dir'] as $onedir){
										$src_dir = dirname(__FILE__)."/".$onedir."/";
										addFolderToZip($src_dir, $zip, $onedir."/", $count, $fp);
									}
								} else {
									$src_dir = dirname(__FILE__)."/".$_POST['dir']."";
									addFolderToZip($src_dir, $zip, '', $count, $fp);
								}
								fclose($fp);
								# закриваемо архів
								$zip->close();
								unlink($log_file);

								echo "<br />Архів <a href='/$archname'>".$archname."</a> створено. Він вміщує ".$count." файлів";
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