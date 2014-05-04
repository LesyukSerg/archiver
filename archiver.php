<?
if($_GET['del'] && !file_exists("checker.php")){
	unset($_SESSION);
	unlink(__FILE__);
	exit();
}
error_reporting(E_ALL);
$timestart = microtime(1);
define('VERSION', '201312021608');
session_start();
set_time_limit(300);
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

		-archiver_201311261730
			виправив хлях до завантаження файлу
			виправив хлях для перезавантаження
			скролл лог блоку донизу

		-archiver_201311271530
			виправив визначення функцій 

		-archiver_201311281218
			додав функцію самознищення

		-archiver_201311291142
			функція addFolderCount замінена швидшою getFolderCount(автор Армем)

		-archiver_201311291240
			додана перевірка скриття блоку вибору архіву
			додана можливість автоматично додавати стандартні теки для виключення
		
		-archiver_201311292328
			була проведена мала оптимізація коду
			додана перревірка на можливість запису
			відображення дозволів теки
		
		-archiver_201311301400
			додана кольорове відображення дій
		
		-archiver_201312021608
			виправлена функція unzip прибраний "//"

	#---Майбутні допрацьовки-------------------------------------------------------------
		// архівація без перезавантаження
		// додати кнопку "зупинити". (при ajax архивації)
		// прогресс бар
		// додати мови
		// можливість прорахувати загальний об'єм данних чи об'єм данних тек
		// можливість вибрати теку для розархівування
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

	if(md5($_POST['pswrd']) == $pass)
		$_SESSION['psswrd'] = $pass;

	# функція перевірки нової версії -------------------------------------
	function check_new_vers($vers){
		$last_ver = file_get_contents("http://lesyuk-serg.w.pw/archiver/checker.php?curr=".$vers);

		if($last_ver){
			return '<fieldset class="newvers"><legend title="" >Ваша версія '.$vers.' архіватору не є найновішою</legend>'.$last_ver.'</fieldset>';
		}
		return false;
	}

	if($_SESSION['psswrd'] == $pass){
		# тека в якій буде размішено архів
		$pathname = getcwd();
		$dirs = scandir($pathname);
		$count = 0;
		$archive_dir = $pathname."/";
		
		$log_file = "archive_log.txt";

		# Підрахунок всіх файлів в корені --------------------------------
		function addFolderCount($dir, &$cnt){
			if(!$_GET['get_count'] && $cnt>999)
				return;

			if ($dh = opendir($dir)){
				while(($file = readdir($dh))){
					if(is_dir($dir.$file)){
						if($file !== "." && $file !== ".."){
							addFolderCount($dir.$file."/", $cnt);
						}
					}else{
						$cnt++;
					}
				}
				closedir($dh);
			}
		}

		# Підрахунок всіх файлів в корені (по версії Армема) -------------
		function getFolderCount($dir){
			$cnt = 0;
			$dirs = scandir($dir);
			do{
				if (!in_array(current($dirs), array('.', '..')))
					if (is_file($dir."/".current($dirs))){
						$cnt++;
					}else{
						if(!$_GET['get_count'] && $cnt>999) return $cnt;

						$cnt+= getFolderCount($dir."/".current($dirs));
					}
			}while(next($dirs));
			return $cnt;
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
			if($zpfl){
				$zipfile = $archive_dir."/".$zpfl;

				if(file_exists($zipfile)){
					$zip = new ZipArchive;
					$res = $zip->open($zipfile);
					if ($res === TRUE){
						$num = $zip->numFiles;
						$zip->extractTo($archive_dir);
						$zip->close();
						echo "";
						return "<span class='green'>Ура! Архів <b>".$zpfl."</b> успішно видобуто в директорію $archive_dir.</span>";
					}else{
						return "<span class='red'>Архів <b>".$zpfl."</b> пожкоджено</span>";
					}
				}else{
					return "<span class='red'>Файл не знайдено</span>";
				}
			}else{
				return "<span class='red'>Виберіть файл для розархівування</span>";
			}
		}

		# показ та функціонал вибору тек в root директорії ---------------
		function show_root_dir($src_dir, $archive_dir, $dirs){
			$out = "<script>";
			if(!$_GET['get_count'])
				$out .= "document.getElementById('get_count').checked = false;";

			$out .= "
				function turn_of(alldir){
					if(alldir.checked){
						var f1 = document.getElementsByTagName('input');
						for (var i=0; i<f1.length; i++)
							if (f1[i].className == 'selecteddir')
								f1[i].checked = false;
					}
				}";
			$out .= "</script>";
			$out .= "<input id='alldir' type='checkbox' name='dir' value='' onclick='turn_of(this)' /> <b>Усі файли та теки</b> <input type='checkbox' name='get_count' value='all' ".(($_GET['get_count']=='all')?"checked='checked'":"")." onclick='if(get_count.checked)window.location=\"".preg_replace("/\?.*/","",$_SERVER['REQUEST_URI'])."?get_count=all\"; else window.location=\"".$_SERVER['SCRIPT_NAME']."\"' /> Показати точну кількість файлів у теках.(Це займе деякий час...)<br />";

			foreach($dirs as $dir){
				if (is_dir($archive_dir.$dir) && !in_array($dir, array(".",".."))){
					$all_count = 0;
					if(!$_POST['submit'] && $_GET['get_count'] !=1){
						$all_count = getFolderCount($src_dir.$dir.'/');
						//addFolderCount($src_dir.$dir.'/', $all_count);
					}
					$out .= "<input class='selecteddir' type='checkbox' name='dir[".$dir."]' value='".$dir."' onclick='alldir.checked=false' /> ".$dir." (".(($all_count>1000 && $_GET['get_count']!='all')?"більше 999 файлів":$all_count).")<br />";
				}
			}
			return $out;
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
							echo "<span class='red'>Помилка при додаванні порожної теки - $zipdir</span><br />";
						}else{
							//echo "<b><span title='".$dir."'> * </span></b>";
							echo "<b>$zipdir</b><br />";
						}
					}

					#  цикл по всім файлам
					while(($file = readdir($dh))){
						# якщо це тека - запускаємо функцію
						if(is_dir($dir.$file)){
							# пропуск директорій '.' і '..'
							if(!in_array($file, $_POST['exept'])){
								addFolderToZip($dir.$file."/", $zipArchive, $zipdir.$file . "/", $cnt, $fp);
							}
						}else{
							# Додаємо файли в архів
							if($file !== basename(__FILE__)){
								$cnt++;
								if($cnt > $_POST['max'])
									break;

								$except = array('zip', 'rar', 'tar', 'gz', '7z');
								if($cnt > $_POST['min'] && filesize($dir.$file) < $_POST['max_size']*1024 && $file != basename(__FILE__)){
									$zfile = iconv(mb_detect_encoding($file), 'CP866//TRANSLIT//IGNORE', $file);

									if($zipArchive->addFile($dir . $file, $zipdir . $zfile)){
										//echo mb_detect_encoding($file)."-";
										echo "<span class='green'>".(1000000+$cnt)." - ".$dir.$file." OK</span>.<br />";
										//echo "<span title='".$dir.$file."'> . </span>";
									}else{
										echo "<span class='grey'>Помилка архівації: файл $dir.$file</span><br />";
									}

									fwrite($fp, (1000000+$cnt)." - $dir.$file OK\n");
								}else{
									fwrite($fp, "$dir.$file - Пропущений\n");
									echo "<span class='grey'>$dir.$file - Пропущений</span><br />";
								}
							}
						}
					}
					closedir($dh);
				}
			}
		}

		# головна функція підготовки до архівації --------------------
		function start_archivation($archive_dir, $pathname, $log_file){
			if($_POST['dir_write']){
				unset($_POST['dir']);
				$_POST['dir'] = $_POST['dir_write'];
			}
			
			if($_POST['exept']){
				$_POST['exept'] = explode("|",$_POST['exept']);
			}
			$_POST['exept'][] = ".";
			$_POST['exept'][] = "..";

			if(isset($_POST['dir'])){
				# створення zip архіву
				$zip = new ZipArchive();

				# ім'я архіва
				if($_POST['addtozip'] == 'new'){
					if(is_array($_POST['dir'])){
						$archname = implode("-",$_POST['dir'])."-".date('Y_m_d_His').".zip";
					}elseif($_POST['dir_write']){
						$archname = $_POST['dir_write']."-".date('Y_m_d_His').".zip";
					}else{
						$archname = $_SERVER['SERVER_NAME']."-".date('Y_m_d_His').".zip";
					}
				}else{
					$archname = $_POST['addtozip'];
				}
				$fileName = $archive_dir.$archname;
				
				if($fp = fopen($log_file, 'w')){
					fwrite($fp, $fileName."\n");
				} else {
					$dirperm = substr(sprintf('%o', fileperms($pathname)), -4);
					if(chmod($pathname, 0777)){
						fwrite($fp, $fileName."\n");
					} else {
						echo "<span class='red'>Архів не створено. Немає прав на запис. ".$dirperm."</span>";
						return;
					}
				}
		
				//ZIPARCHIVE::ER_ZLIB
				if ($zip->open($fileName, ZIPARCHIVE::CREATE) !== true){
					fwrite(STDERR, "Error while creating archive file");
					echo "<span class='red'>zip не установлен</span>";
					exit(1);
				}

				# додаємо файли в архів всі файли із теки src_dir

				if(is_array($_POST['dir'])){
					foreach($_POST['dir'] as $onedir){
						addFolderToZip($pathname."/".$onedir."/", $zip, $onedir."/", $count, $fp);
					}
				}else{
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
				
				$download = str_replace(basename(__FILE__),"",$_SERVER['REQUEST_URI']).$archname;
				echo "<br />Архів <a href='$download'>".$archname."</a> створено. До архіву додано ".$count." файлів. ";
				echo "<br /><input type='button' value='заново' onclick='window.location=\""."http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."\"' />";
			}else{
				echo "Виберіть теку"."<br /><input type='button' value='заново' onclick='window.location=\""."http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."\"' />";
			}
		}

		if(!$_POST['submit'] && $_GET['get_count'] == 1 && !$_POST['pswrd'])
			$all_count = getFolderCount($pathname);
			//addFolderCount($src_dir, $all_count);
		else
			$all_count = " багацько";
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<META http-equiv="content-type" content="text/html; charset=utf-8" />
		<META NAME="Author" CONTENT="Lesyuk Sergiy">
		<title>Archiver</title>
		<style>
			body{ margin: 0; background-color: #F8F8E2; padding: 2px 20px; }
			input.archivatorstart{ cursor: pointer; display: block; font-size: 20px; height: 50px; margin: 8px auto; width: 30%; }
			legend{ font-weight: bold; font-size: medium; }
			.archivelog div{ max-height: 394px; overflow: auto; }
			.passblock{ width: 220px; margin: 100px auto; }
			.newvers{ width: 98%; margin: 0 auto; }
			.progress{ height: 40px; background:#444; width: 100%; transition: all 2s ease 0s; }
			.kamicadze{ margin-top: -40px; position: absolute; right: 28px; }
			legend span{ cursor: pointer; }
			legend span:hover{ color:grey }
			.red { color: red; }
			.grey { color: grey; }
			.green { color: green; }
		</style>
	</head>
	<body>
		<div id="wpapper">
			Мова:
			<select name="lang">
				<option value="ua">Українська</option>
			</select>
<?
			if($_SESSION['psswrd'] == $pass){
				if(!$_POST['max_size']) $_POST['max_size'] = 1024;
				if(!$_POST['max']) $_POST['min'] = 0;
				if(!$_POST['max']) $_POST['max'] = 20000;
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
										echo unzippp($pathname, $_POST['zipfile']);
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
<?
						$zipfiles = array();
						foreach($dirs as $dir)
							if (!is_dir($archive_dir.$dir) && strstr($dir, "zip"))
								$zipfiles[] = $dir;
?>
						<fieldset class="left">
							<legend title="">Виберіть архів:</legend>
							<input class="addtozip" type="radio" name="addtozip" value="new" checked="checked" /> Створити новий архів<br />
<?
							foreach($zipfiles as $zzz){
								if (!is_dir($archive_dir.$zzz) && strstr($zzz, "zip")){
?>
									<input class="addtozip" type="radio" name="addtozip" value="<?=$zzz?>" /> Доповнити архів <b><?=$zzz?></b><br />
<?
								}
							}
?>
						</fieldset>

						<fieldset class="left">
							<legend title="">Виберіть директорію для архівування:</legend>
								<?=show_root_dir($pathname."/", $archive_dir, $dirs);?>
							<fieldset>
								<legend title="">Або впишіть шлях до вкладеної теки: (Наприклад: "bitrix/upload")</legend>
								<input type="text" name="dir_write" value="<?=$_POST['dir_write']?>" style="width:99%" /> <br />
							</fieldset>
						</fieldset>

						<fieldset class="right">
							<legend title="" >Які теки слід виключити: вводити через "|" (Наприклад: "<span onclick="addEx(this)">upload</span>|<span onclick="addEx(this)">product_pictures</span>|<span onclick="addEx(this)">images</span>|<span onclick="addEx(this)">image_db</span>")</legend>
							<input type="text" name="exept" value="<?=$_POST['exept']?>" style="width:99%" />
							<script>
								function addEx(el){
									var input = el.parentNode.parentNode.getElementsByTagName('input').item(0);
									var arr = [];
									if(input.value.length)
										var arr = input.value.split('|');

									arr.push(el.innerHTML);
									input.value = arr.join('|');
								}
							</script>
						</fieldset>

						<fieldset class="right">
							<legend title="" >Не архівувати файли більше ніж:</legend>
							<input type="text" name="max_size" value="<?=$_POST['max_size']?>" /> кб
						</fieldset>

						<fieldset class="right">
							<legend title="" >Обмеження за кількістю файлів:</legend>
							від <input type="text" name="min" value="<?=$_POST['min']?>" />
							до <input type="text" name="max" value="<?=$_POST['max']?>" />
						</fieldset>
						<div class="clear"></div>
						<input class="archivatorstart" type="submit" name="submit" value="РОЗПОЧАТИ АРХІВАЦІЮ" />

						<a class="kamicadze"  href="<?=preg_replace("/\?.+/",'',$_SERVER['REQUEST_URI'])?>?del=itself" title="видалити archiver">видалити archiver</a>
					</form>
					<div class="clear"></div>
					<fieldset class="archivelog">
						<legend title="" >Хід виконання архівації:</legend>
						<div id="log">
<?
							if($_POST['submit'])
								start_archivation($archive_dir, $pathname, $log_file);
?>
						</div>
					</fieldset>
				</div>
				<script>
					document.getElementById('log').scrollTop = 88888888;
					// ---------------Artem ajax function -----------------------------------------------------------------
					/*
					function ajax(params){
						var async = params.async || true; // Асинхронность
						var url = params.url || './'; // Путь
						var data = params.data || null; // Данные
						var done = params.done || function (){}; // Если все ok
						var error = params.error || function (){}; // Если все плохо
						var xmlhttp=window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject("Microsoft.XMLHTTP");
						xmlhttp.onreadystatechange=function(event){
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
							data:{
								qwe: 'qwe'
							},
							done: function (event){
								// body...
							},
							error: function (event){
								// body...
							}
						});
					}
					*/
				</script>
<?
				echo "Cторінка згенерована за ".round(microtime(1)-$timestart, 4)." секунд.<br />";
			}else{
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
				}else{
					echo "<h1 align='center'>Шановний користувач архіватору.<br /> На жаль на цьому хостингу не встановлений ZIP архіватор.</h1>";
				}
			}
?>
			<div id="gotobottom"></div>
		</div>
	</body>
</html>