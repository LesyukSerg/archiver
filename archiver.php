<?
define('VERSION', '201311221530');
session_start();
set_time_limit(300);
error_reporting(E_ALL);
if(!isset($_GET['get_count'])) $_GET['get_count'] = null;
if(!isset($_POST['dir_write'])) $_POST['dir_write'] = null;
if(!isset($_POST['exept'])) $_POST['exept'] = null;
if(!isset($_POST['max_size'])) $_POST['max_size'] = null;
if(!isset($_POST['min'])) $_POST['min'] = null;
if(!isset($_POST['max'])) $_POST['max'] = null;
if(!isset($_POST['max_size'])) $_POST['max_size'] = null;
if(!isset($_POST['submit'])) $_POST['submit'] = null;
if(!isset($_POST['unzip'])) $_POST['unzip'] = null;
if(!isset($_POST['pswrd'])) $_POST['pswrd'] = null;
if(!isset($_SESSION['psswrd'])) $_SESSION['psswrd'] = null;
/*	історія змін ---
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
			додано виключення файлу самого архіватора із архіву
			додана функція flush, завдяки якій повинен точніше відображатись хід архівації
			
		-archiver_201308081003
			додано назва повного дампу буде складатися із назви серверу та дати створення
			додано log файл, який залишаэться якщо архівацыя не дійшла до кінця
		
		-archiver_201308121800
			додано доповнення архіву
			
		-archiver_201308131230
			вернув старый лог архівації
			
		-archiver_201309251606
			виправив баг стосовно opendir i closedir
			
		-archiver_201310021205
			додав перелік файлів
			виправив архівацію вписаної теки
		
		-archiver_201310081020
			Виправив повний перелік файлів
		
		-archiver_201310151225
			Виправив виключення архівів
		
		-archiver_201310171150
			Виправив архівування тек і файлів, назви яких мають кіриличні символи
			
		-archiver_201310311130
			Виправив підрахунок кількості файлів всього і по теках
			
		-archiver_201310311512
			Зручніше розташував блоки
		
		-archiver_201311051614
			Выправив всі NOTICE - некоректні звернення до змінної
		
		-archiver_201311181116
			Замінив dirname(__FILE__) на getcwd();
			Виніс функціонал розархівації у функцію
			Виніс функціонал архівації у функцію
			Виніс функціонал показу тек у функцію
		
		-archiver_201311191602
			додав пароль на весь функціонал
			додав перевірку можливості архівування
			
		-archiver_201311201626
			додана функція перевырки нової версії
			
		-archiver_201311221530
			додав вивід часу виконання архівації і розархівації
*/

/*		
	#---Майбутні допрацьовки-------------------------------------------------------------
		// архівація без перезавантаження
		// додати кнопку "зупинити". (при ajax архивації)
		// прогресс бар
		// додати мови
		// можливість прорахувати загальний об'єм данних чи об'єм данних тек
	#---/Майбутні допрацьовки------------------------------------------------------------
	
	#---Існуючі проблеми---------------------------------------------------------
		// довго рахує кількість файлів
		// не може архівувати великі об'єми даних
		// залежить від того чи встановлено zip на хостинг
		// максимальний розмір архіву залежить від налаштувань хостинга
	#---/Існуючі проблеми--------------------------------------------------------
*/
	$pass = "238a0fa7c18cd78ca1f8d14c260ee02b";
	$pass = "b59c67bf196a4758191e42f76670ceba";
	
	# тека в якій буде размішено архів
	$pathname = getcwd();
	$archive_dir = $pathname;
	$dirs = scandir($archive_dir);
	$count = 0;
	$archive_dir = $archive_dir."/";
	$src_dir = $pathname."/";
	
	$log_file = "archive_log.txt";
	
	if(md5($_POST['pswrd']) == $pass)
		$_SESSION['psswrd'] = $pass;
	
	if($_GET['get_count'] == 1)
		addFolderCount($src_dir, $all_count);
	else
		$all_count = " багацько";
	
	function timer(){
		list($msec, $sec) = explode(chr(32), microtime());
		return ($sec+$msec);
	}
	
	# Підрахунок всіх файлів в корені --------------------------------
	function addFolderCount($dir, &$cnt){
		if(!$_GET['get_count'] && $cnt>999){
			return;
		}
		
		if ($dh = opendir($dir)){
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

	# Рекурсивна функція архівації вкладених файлів і тек ------------
	function addFolderToZip($dir, &$zipArchive, $zipdir = '', &$cnt, &$fp){
		if (is_dir($dir)){
			fwrite($fp, $dir."\n");

			if ($dh = opendir($dir)){
				# Додаємо порожню директорію
				if(!empty($zipdir)){
					$zdir = iconv('windows-1251', 'CP866//TRANSLIT//IGNORE', $zipdir);
					//$edir = iconv("cp1251","utf-8",$zipdir);
					if($zipArchive->addEmptyDir($zdir) === false){
						echo "Помилка при додаванні порожної теки - $zipdir<br />";
					} else {
						//echo "<b><span title='".$dir."'> * </span></b>";
						echo "<b>$zipdir</b><br />";
					}
				}

				#  цикл по всім файлам
				while (($file = readdir($dh)) !== false){
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

							$except = array('zip', 'rar', 'tar', 'gz', '7z');
							if($cnt > $_POST['min'] && filesize($dir.$file) < $_POST['max_size']*1024 && $file != basename(__FILE__) /* && !in_array(pathinfo($file, PATHINFO_EXTENSION), $except) */){
								//echo $file."-".mb_detect_encoding($file)."<br />";
								
								$zfile = iconv(mb_detect_encoding($file), 'CP866//TRANSLIT//IGNORE', $file);
								//$efile = iconv("cp1251","utf-8",$file);
								//$zfile = iconv('ASCII', 'utf-8', $file);
								//$zfile = $file;
								if($zipArchive->addFile($dir . $file, $zipdir . $zfile)){
									//echo mb_detect_encoding($file)."-";
									echo (1000000+$cnt)." - ".$dir.$file." OK<br />";
									//echo "<span title='".$dir.$file."'> . </span>";
								} else {
									echo "Помилка архівації: файл $dir.$file<br />";
								}
								flush();
								fwrite($fp, (1000000+$cnt)." - $dir.$file OK\n");
							} else {
								fwrite($fp, "$dir.$file - Пропущений\n");
								echo "$dir.$file - Пропущений<br />";
							}
						}
					}
				}
				closedir($dh);
			}
		}
	}
	
	# перевірка в root каталозі на zip файли -------------------------
	function check_for_archive($archive_dir, $dirs){
		foreach($dirs as $dir){
			if (!is_dir($archive_dir.$dir) && strstr($dir, "zip")){
				return 1;
				break;
			}
		}
		return 0;
	}
	
	# функція розархівації -------------------------------------------
	function unzippp($archive_dir, $zpfl){
		define('TIMESTART', timer());
		if($zpfl) {
			$zipfile = $archive_dir.$zpfl;

			if(file_exists($zipfile)){
				$zip = new ZipArchive;
				$res = $zip->open($zipfile);
				if ($res === TRUE){
					$num = $zip->numFiles;
					$zip->extractTo($archive_dir);
					$zip->close();
					$timeleft = round(timer()-TIMESTART,2);
					echo "";
					return "Ура! Архів <b>".$zpfl."</b> успішно відобуто в директорію $archive_dir. <b>За $timeleft сек.</b>";
				} else {
					return "Архів <b>".$zpfl."</b> пожкоджено";
				}
			} else {
				return "Файл не знайдено";
			}
		} else {
			return "Виберіть файл для розархівування";
		}
	}
	
	# показ та функціонал вибору тек в root директорії ---------------
	function show_root_dir($src_dir, $archive_dir, $dirs){
?>
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
		<input id="alldir" type="checkbox" name="dir" value="" onclick="turn_of(this)" /> <b>Усі файли та теки</b> <input type="checkbox" name="get_count" value='all' <?if($_GET['get_count']=='all'):?>checked="checked"<?endif;?> onclick="if(get_count.checked)window.location='<?=preg_replace("/\?.*/","",$_SERVER['REQUEST_URI'])?>?get_count=all'; else window.location='<?=$_SERVER['SCRIPT_NAME']?>'" /> Показати точну кількість файлів у теках.(Це займе деякий час...)<br />
<?
		foreach($dirs as $dir){
			if (is_dir($archive_dir.$dir) && $dir != "." && $dir != "..") {
				if(!$_POST['submit']){
					$all_count = 0;
					addFolderCount($src_dir.$dir.'/', $all_count);
				}
?>
				<input class="selecteddir" type="checkbox" name="dir[<?=$dir?>]" value="<?=$dir?>" onclick="alldir.checked=false" /> <?=$dir?> (<?=($all_count>1000 && $_GET['get_count']!='all')?'більше 999 файлів':$all_count?>)<br />
<?
			}
		}
	}
	
	# функція перевірки нової версії ----------------------------
	function check_new_vers($vers){
		$last_ver = file_get_contents("http://lesyuk-serg.w.pw/archiver/checker.php?curr=".$vers);

		if($last_ver){
			return '<fieldset class="newvers"><legend title="" >Ваша версія '.$vers.' архіватору не є найновішою</legend>'.$last_ver.'</fieldset>';
		}
		return false;
	}
	
	# головна функція підготовки до архівації --------------------
	function start_archivation($archive_dir, $pathname, $log_file){
		define('TIMESTART', timer());
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
					$archname = implode("-",$_POST['dir'])."-".date('Y_m_d_His').".zip";
				} elseif($_POST['dir_write']) {
					$archname = $_POST['dir_write']."-".date('Y_m_d_His').".zip";
				} else {
					$archname = $_SERVER['SERVER_NAME']."-".date('Y_m_d_His').".zip";
				}
			} else {
				$archname = $_POST['addtozip'];
			}
			$fileName = $archive_dir.$archname;
			//ZIPARCHIVE::ER_ZLIB
			if ($zip->open($fileName, ZIPARCHIVE::CREATE) !== true) {
				fwrite(STDERR, "Error while creating archive file");
				echo "zip не установлен";
				exit(1);
			}

			# додаємо файли в архів всі файли із теки src_dir
			$fp = fopen($log_file, 'w');
			fwrite($fp, $fileName."\n");
			
			if(is_array($_POST['dir'])){
				foreach($_POST['dir'] as $onedir){
					$src_dir = $pathname."/".$onedir."/";
					addFolderToZip($src_dir, $zip, $onedir."/", $count, $fp);
				}
			} else {
				if($_POST['dir'])
					$src_dir = $pathname."/".$_POST['dir']."/";
				else
					$src_dir = $pathname."/".$_POST['dir'];
				
				addFolderToZip($src_dir, $zip, '', $count, $fp);
			}
			fclose($fp);
			# закриваемо архів
			$zip->close();
			unlink($log_file);
			$timeleft = round(timer()-TIMESTART,2);
			echo "<br />Архів <a href='/$archname'>".$archname."</a> створено. Він вміщує ".$count." файлів. За $timeleft сек.";
			echo "<br /><input type='button' value='заново' onclick='window.location=\""."http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."\"' />";
		} else {
			echo "Виберіть теку"."<br /><input type='button' value='заново' onclick='window.location=\""."http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."\"' />";
		}
	}

	
?>
<!DOCTYPE html>
<html>
	<head>
		<META http-equiv="content-type" content="text/html; charset=utf-8" />
		<META NAME="Author" CONTENT="Lesyuk Sergiy">
		<title>Archiver</title>
		<style>
			body { margin: 0; background-color: #F8F8E2; padding: 2px 20px; }
			input.archivatorstart { cursor: pointer; display: block; font-size: 20px; height: 50px; margin: 8px auto; width: 30%; }
			legend { font-weight: bold; font-size: medium; }
			.archivelog div { max-height: 394px; overflow: auto; }
			.passblock { width: 220px; margin: 100px auto; }
			.newvers { width: 98%; margin: 0 auto; }
			.progress { height: 40px; background:#444; width: 100%; transition: all 2s ease 0s; }
		</style>
	</head>
	<body>
		<div id="wpapper">
<?
			if($_SESSION['psswrd'] == $pass){
?>
				<div id="form_block">
					<fieldset class="right">
						<legend title="">Кількість файлів:</legend>
						Всього файлів <b><?=$all_count?></b>
						<input type="checkbox" id="get_count" name="get_count" value='1' checked="checked" onclick="if(get_count.checked)window.location=window.location.href+'/?get_count=1'; else window.location='<?='http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']?>'" /> Показати кількість файлів.(Це займе деякий час...)<br />
					</fieldset>
<?
					$archive_exist = check_for_archive($archive_dir, $dirs);
					
					if($archive_exist){
?>
						<h2>Розархіватор сайту</h2>
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
										echo unzippp($archive_dir, $_POST['zipfile']);
									}
?>
								</div>
							</fieldset>
						</fieldset>
						<hr class="progress" />
<?
					}
?>
					<h1>Архіватор сайту</h1>
					<form action="<?=$_SERVER['REQUEST_URI']?>#gotobottom" method="POST">
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
<?
							if(!$_POST['submit']){
								show_root_dir($src_dir, $archive_dir, $dirs);
							}
?>
							<fieldset>
								<legend title="">Або впишіть шлях до вкладеної теки: (Наприклад: "bitrix/admin")</legend>
								<input type="text" name="dir_write" value="<?=$_POST['dir_write']?>" style="width:99%" <?if($_POST['submit']):?>disabled="disabled"<?endif;?> /> <br />
							</fieldset>
						</fieldset>

						<fieldset class="right">
							<legend title="" >Які теки слід виключити: вводити через "|" (Наприклад: "upload|product_pictures|images|images_db")</legend>
							<input type="text" name="exept" value="<?=$_POST['exept']?>" style="width:99%" <?if($_POST['submit']):?>disabled="disabled"<?endif;?> />
						</fieldset>

						<fieldset class="right">
							<legend title="" >Не архівувати файли більше ніж:</legend>
<?
							if(!$_POST['max_size']) $_POST['max_size'] = 1024;
?>
							<input type="text" name="max_size" value="<?=$_POST['max_size']?>" <?if($_POST['submit']):?>disabled="disabled"<?endif;?> /> кб
						</fieldset>

						<fieldset class="right">
							<legend title="" >Обмеження за кількістю файлів:</legend>
<?
							if(!$_POST['max']) $_POST['min'] = 0;
							if(!$_POST['max']) $_POST['max'] = 20000;
?>
							від <input type="text" name="min" value="<?=$_POST['min']?>" <?if($_POST['submit']):?>disabled="disabled"<?endif;?> />
							до <input type="text" name="max" value="<?=$_POST['max']?>" <?if($_POST['submit']):?>disabled="disabled"<?endif;?> />
						</fieldset>
						<div class="clear"></div>
						<input class="archivatorstart" type="submit" name="submit" value="РОЗПОЧАТИ АРХІВАЦІЮ" <?if($_POST['submit']):?>disabled="disabled"<?endif;?> />
					</form>
					<div class="clear"></div>
					<fieldset class="archivelog">
						<legend title="" >Хід виконання архівації:</legend>
						<div>
<?
							if($_POST['submit']){
								start_archivation($archive_dir, $pathname, $log_file);
							}
?>
						</div>
					</fieldset>
				</div>
				<script>
					// ---------------Artem ajax function -----------------------------------------------------------------
					/*
					function ajax(params){
						var async = params.async || true; // Асинхронность
						var url = params.url || './'; // Путь
						var data = params.data || null; // Данные
						var done = params.done || function () {}; // Если все ok
						var error = params.error || function () {}; // Если все плохо
						var xmlhttp=window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject("Microsoft.XMLHTTP");
						xmlhttp.onreadystatechange=function(event) {
							if (event.readyState==4 && event.status==200) done(event);
							else error(event);
						}
						xmlhttp.open('POST',url,async);
						xmlhttp.send(data);
					}
					*/
					// ---------------/Artem ajax function ----------------------------------------------------------------
					/*
					function send_post(){
						
						ajax ({
							async: true,
							url: 'index.php',
							data: {
								qwe: 'qwe'
							},
							done: function (event) {
								// body...
							},
							error: function (event) {
								// body...	
							}
						});
					}
					*/
				</script>
<?
			} else {
				if (class_exists('ZipArchive')){
					echo check_new_vers(VERSION);
?>
					<fieldset class="passblock">
						<legend title="" >Введіть пароль:</legend>
						<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
							<input type="password" name="pswrd" value="" style="float:left" />
							<input type="submit" name="gopass" value="вхід" style="float:right" />
						</form>
					</fieldset>
<?
				} else {
					echo "<h1 align='center'>Шановний користувач архіватору.<br /> На жаль на цьому хостингу не встановлений ZIP архіватор.</h1>";
				}
			}
?>
			<div id="gotobottom"></div>
		</div>
	</body>
</html>