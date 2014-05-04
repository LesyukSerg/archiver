<?
error_reporting(E_ALL);
$timestart = microtime(1);
define('VERSION', '201401271040');
session_start();
set_time_limit(300);
?>
<? #--- массив перекладів -------------------------------------------------------
$lang = array(
	'ua' => array(
		'language' => 'Мова',
		'file_not' => 'Не знайдено файл ',
		'kamikadze_ok' => 'Самознищення пройшло вдало.',
		'kamikadze_err' => 'файл не знищено. В доступі відмовлено.',
		'your_vers' => 'Ваша версія',
		'not_new' => 'архіватору не є найновішою',
		'arch' => 'Архів',
		'unzip_ok' => 'успішно розархівовано в директорію ',
		'unzip_err' => 'Пошкоджено архів',
		'unzip_not' => 'Архів не знайдено',
		'unzip_choose' => 'Виберіть файл для розархівування',
		'unzip' => 'Розархівувати',
		'unzip_log' => 'Хід виконання',
		'dell' => 'Видалити',
		'delzip_ok' => 'Успішно видалено архів.',
		'delzip_err' => 'Не видалено архів',
		'delzip_choose' => 'Виберіть файл для видалення',
		'all_files' => 'Усі файли та теки',
		'show_dir_count_files' => 'Показати точну кількість файлів у теках.(Це займе деякий час...)',
		'more_999' => 'більше 999 файлів',
		'add_folder_err' => 'ПОМИЛКА архівації: додавання порожної теки',
		'add_file_err' => 'ПОМИЛКА архівації: додавання файлу',
		'skip' => 'Пропущений',
		'permission' => 'Архів не створено. Немає прав на запис',
		'zip_created' => 'Створено архів',
		'zip_added_files' => 'До архіву додано файлів',
		'many' => ' багацько',
		'choose_folder' => 'Виберіть теку',
		'count_files' => 'Кількість файлів',
		'full_files' => 'Всього файлів',
		'show_full_count_files' => 'Показати кількість файлів.(Це займе деякий час...)',
		'unziper' => 'Розархіватор сайту',
		'zip_found' => 'Знайдені архіви (тільки zip формату)',
		'zip_not_found' => 'Не знайдено жодного zip архіву',
		'zipsite' => 'Архіватор сайту',
		'choose_zip' => 'Виберіть архів',
		'create_new_zip' => 'Створити новий архів',
		'add_to_zip' => 'Доповнити архів',
		'choose_dir' => 'Виберіть директорію для архівування',
		'enter_subdir' => 'Або впишіть шлях до вкладеної теки: (Наприклад: "bitrix/upload")',
		'dir_exeption' => 'Які теки слід виключити: вводити через "|" (Наприклад',
		'dont_zip_more' => 'Не архівувати файли більше ніж',
		'zip_max_files_count' => 'Обмеження за кількістю файлів',
		'start' => 'РОЗПОЧАТИ АРХІВАЦІЮ',
		'kamikadze' => 'видалити archiver',
		'zip_log' => 'Хід виконання архівації',
		'page_gen' => 'Cторінка згенерована за',
		'sec' => 'секунд',
		'enter_pass' => 'Введіть пароль',
		'login' => 'вхід',
		'zip_sorry' => 'Шановний користувач архіватору.<br /> На жаль на цьому хостингу не встановлений ZIP архіватор.',
		'show_log' => 'Відображення повідомлень',
		'show_log_ok' => 'Успішні',
		'show_log_notice' => 'Пропущені',
		'show_log_error' => 'Помилки',
		'show_log_save' => 'Зберегти'
	),
	'en' => array(
		'language' => 'Language',
		'file_not' => 'File not found ',
		'kamikadze_ok' => 'Destroy itself successfully completed.',
		'kamikadze_err' => 'File dont destroy. Permission denied.',
		'your_vers' => 'Your version',
		'not_new' => 'archivator is not newest',
		'arch' => 'Archive',
		'unzip_ok' => 'Successfully extracted in directory ',
		'unzip_err' => 'Archive broken',
		'unzip_not' => 'Archive not found',
		'unzip_choose' => 'Choose file to extract',
		'unzip' => 'Extract',
		'unzip_log' => 'Log',
		'dell' => 'Delete',
		'delzip_ok' => 'Successfully deleted archive.',
		'delzip_err' => 'Archive was not deleted',
		'delzip_choose' => 'Choose file to delete',
		'all_files' => 'All files and directories',
		'show_dir_count_files' => 'Show exact count files in directories.(It will take some time...)',
		'more_999' => 'more than 999 files',
		'add_folder_err' => 'ERROR archivation: adding empty dir',
		'add_file_err' => 'ERROR archivation: adding file',
		'skip' => 'Skiped',
		'permission' => 'Archive will not created. Permission denied',
		'zip_created' => 'Archive will created',
		'zip_added_files' => 'filed added',
		'many' => ' many',
		'choose_folder' => 'Choose directory',
		'count_files' => 'Count files',
		'full_files' => 'All files',
		'show_full_count_files' => 'Show count files.(It will take some time...)',
		'unziper' => 'Site Extractor',
		'zip_found' => '',
		'zip_found' => 'Found archives (only zip format)',
		'zip_not_found' => 'Not found any zip archive',
		'zipsite' => 'Site Archivator',
		'choose_zip' => 'Choose archive',
		'create_new_zip' => 'Create a new archive',
		'add_to_zip' => 'Archive supplement',
		'choose_dir' => 'Choose dir to archivation',
		'enter_subdir' => 'Or enter path to subdir: (Example: "bitrix/upload")',
		'dir_exeption' => 'Skiped dir: enter with delimiter "|" (Example',
		'dont_zip_more' => 'Do not archive files bigger more than',
		'zip_max_files_count' => 'Limit on the number of files',
		'start' => 'START ARCHIVATION',
		'kamikadze' => 'delete archiver',
		'zip_log' => 'Log archivation',
		'page_gen' => 'Page generate in',
		'sec' => 'second',
		'enter_pass' => 'Enter password',
		'login' => 'enter',
		'zip_sorry' => 'Dear user archiver. <br /> Unfortunately this host is not established ZIP archive.',
		'show_log' => 'Show log settings',
		'show_log_ok' => 'Success',
		'show_log_notice' => 'Skiped',
		'show_log_error' => 'Error',
		'show_log_save' => 'Сохранить'
	),
	'ru' => array(
		'language' => 'Язык',
		'file_not' => 'Не найдено файл',
		'kamikadze_ok' => 'Самоуничтожение прошло удачно.',
		'kamikadze_err' => 'файл не уничтожено. В доступе отказано.',
		'your_vers' => 'Ваша версия',
		'not_new' => 'архиватора не является новейшей',
		'arch' => 'Архив',
		'unzip_ok' => 'успешно извлечен в директорию',
		'unzip_err' => 'Поврежден архив',
		'unzip_not' => 'Архив не найдено',
		'unzip_choose' => 'Выберите файл для разархивирования',
		'unzip' => 'Разархивировать',
		'unzip_log' => 'Ход выполнения',
		'dell' => 'Удалить',
		'delzip_ok' => 'Успешно удалено архив.',
		'delzip_err' => 'Не было удалено архив',
		'delzip_choose' => 'Выберите файл для удаления',
		'all_files' => 'Все файлы и папки',
		'show_dir_count_files' => 'Показать точное количество файлов в папках. (Это займет некоторое время ...)',
		'more_999' => 'более 999 файлов',
		'add_folder_err' => 'Ошибка архивации Добавление пустые папки',
		'add_file_err' => 'Ошибка архивации: добавление файла',
		'skip' => 'Пропущенный',
		'permission' => 'Архив не создан. Нет прав на запись',
		'zip_created' => 'Создан архив',
		'zip_added_files' => 'В архив добавлено файлов',
		'many' => 'множество',
		'choose_folder' => 'Выберите папку',
		'count_files' => 'Количество файлов',
		'full_files' => 'Всего файлов',
		'show_full_count_files' => 'Показать количество файлов. (Это займет некоторое время ...)',
		'unziper' => 'Розархиватор сайта',
		'zip_found' => 'Найденные архивы (только zip формат)',
		'zip_not_found' => 'Не нойдено ни одного архіва zip формата',
		'zipsite' => 'Архиватор сайта',
		'choose_zip' => 'Выберите архив',
		'create_new_zip' => 'Создать архив',
		'add_to_zip' => 'Дополнить архив',
		'choose_dir' => 'Выберите директорию для архивирования',
		'enter_subdir' => 'Или впишите путь к вложенной папки (Например: "bitrix / upload")',
		'dir_exeption' => 'Какие папки следует исключить: вводить через "|" (например',
		'dont_zip_more' => 'Не архивировать файлы более',
		'zip_max_files_count' => 'Ограничения по количеству файлов',
		'start' => 'НАЧАТЬ АРХИВАЦИЮ',
		'kamikadze' => 'удалить архиватор',
		'zip_log' => 'Ход выполнения архивации',
		'page_gen' => 'Страница сгенерирована за',
		'sec' => 'секунд',
		'enter_pass' => 'Введите пароль',
		'login' => 'вход',
		'zip_sorry' => 'Уважаемый пользователь архиватора. <br /> К сожалению на этом хостинге не установлен ZIP архиватор.',
		'show_log' => 'Отображение уведомлений',
		'show_log_ok' => 'Успешные',
		'show_log_notice' => 'Пропущеные',
		'show_log_error' => 'Ошибки',
		'show_log_save' => 'Save'
	)
);
#--- /массив перекладів -------------------------------------------------------
?>
<?
if(isset($_GET['lang'])) $_SESSION['lang'] = $_GET['lang'];
if(!isset($_SESSION['lang'])) $_SESSION['lang'] = 'ua';
$l = $_SESSION['lang'];

if(isset($_GET['del']) && !file_exists("checker.php")){
	unset($_SESSION);
	if(unlink(__FILE__))
		exit($lang[$l]['kamikadze_ok']);
	else
		exit($lang[$l]['kamikadze_err']);
}
if(!isset($_POST['gopass'])) $_POST['gopass'] = null;
if(!isset($_GET['get_count'])) $_GET['get_count'] = null;
if(!isset($_POST['dir_write'])) $_POST['dir_write'] = null;
if(!isset($_POST['exept'])) $_POST['exept'] = null;
if(!isset($_POST['max_size'])) $_POST['max_size'] = null;
if(!isset($_POST['min'])) $_POST['min'] = null;
if(!isset($_POST['max'])) $_POST['max'] = null;
if(!isset($_POST['max_size'])) $_POST['max_size'] = null;
if(!isset($_POST['submit'])) $_POST['submit'] = null;
if(!isset($_POST['unzip'])) $_POST['unzip'] = null;
if(!isset($_POST['delzip'])) $_POST['delzip'] = null;
if(!isset($_POST['pswrd'])) $_POST['pswrd'] = null;
if(!isset($_SESSION['psswrd'])) $_SESSION['psswrd'] = null;
if(!isset($_POST['log_submit'])) $_POST['log_submit'] = null;
if(!isset($_POST['show_ok'])) $_POST['show_ok'] = null;
if(!isset($_POST['show_notice'])) $_POST['show_notice'] = null;
if(!isset($_POST['show_error'])) $_POST['show_error'] = null;
if(!isset($_SESSION['log']['ok'])) $_SESSION['log']['ok'] = 1;
if(!isset($_SESSION['log']['notice'])) $_SESSION['log']['notice'] = 1;
if(!isset($_SESSION['log']['error'])) $_SESSION['log']['error'] = 1;

	$pass = "238a0fa7c18cd78ca1f8d14c260ee02b";
	$pass = "b59c67bf196a4758191e42f76670ceba";

	if(md5($_POST['pswrd']) == $pass)
		$_SESSION['psswrd'] = $pass;
	
	# налаштування логування --------------------------------------------------
	if($_POST['log_submit']){
		$_SESSION['log']['ok'] = $_POST['show_ok']?1:0;
		$_SESSION['log']['notice'] = $_POST['show_notice']?1:0;
		$_SESSION['log']['error'] = $_POST['show_error']?1:0;
	}
	
	# функція перекладу --------------------------------------------------
	function trnslt($key){
		global $lang;
		$l = $_SESSION['lang'];
		if($lang[$l][$key])
			return $lang[$l][$key];
		else
			return $key;
	}
	
	# функція перевірки нової версії -------------------------------------
	function check_new_vers($vers){
		$last_ver = file_get_contents("http://lesyuk-serg.w.pw/archiver/checker.php?curr=".$vers);

		if($last_ver){
			return '<fieldset class="newvers"><legend title="" >'.trnslt('your_vers').' '.$vers.' '.trnslt('not_new').'</legend>'.$last_ver.'</fieldset>';
		}
		return false;
	}

	if($_SESSION['psswrd'] == $pass){
		$log_file = "archive_log.txt";
		# тека в якій буде размішено архів
		$pathname = getcwd();
		$dirs = scandir($pathname);
		unset($dirs[array_search(".",$dirs)],$dirs[array_search("..",$dirs)]);
		sort($dirs);
		$count = 0;

		# Підрахунок всіх файлів в корені (по версії Армема) -------------
		function getFolderCount($dir){
			$cnt = 0;
			if($dirs = scandir($dir)){
				do{
					if (!in_array(current($dirs), array('.', '..')))
						if (is_file($dir."/".current($dirs))){
							$cnt++;
						}else{
							if(!$_GET['get_count'] && $cnt>999) return $cnt;

							$cnt+= getFolderCount($dir."/".current($dirs));
						}
				}while(next($dirs));
			}
			return $cnt;
		}

		# перевірка в root каталозі на zip файли -------------------------
		function check_for_archive($archive_dir, $dirs){
			$deleted_zip = "";
			if($_POST['delzip']) $deleted_zip = $_POST['zipfile'];
			
			$zips = array();
			foreach($dirs as $dir){
				if (!is_dir($archive_dir.$dir) && strstr($dir, "zip") && $dir != $deleted_zip){
					$zips[] = $dir;
				}
			}
			return $zips;
		}

		# функція розархівації -------------------------------------------
		function unzippp($archive_dir, $zpfl){
			global $l, $lang;
			
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
						return "<span class='green'>".$lang[$l]['arch']." <b>".$zpfl."</b> ".trnslt('unzip_ok')." ".$archive_dir.".</span>";
					}else{
						return "<span class='red'>".$lang[$l]['unzip_err']." <b>".$zpfl."</b></span>";
					}
				}else{
					return "<span class='red'>".trnslt('unzip_not')."</span>";
				}
			}else{
				return "<span class='red'>".trnslt('unzip_choose')."</span>";
			}
		}
		
		# функція видалення архіву ---------------------------------------
		function delzippp($archive_dir, $zpfl){
			if($zpfl){
				$zipfile = $archive_dir."/".$zpfl;

				if(file_exists($zipfile)){
					if (unlink($zipfile)){
						return "<span class='green'>".trnslt('delzip_ok')." <b>".$zpfl."</b></span>";
					}else{
						return "<span class='red'>".trnslt('delzip_err')." <b>".$zpfl."</b>.</span>";
					}
				}else{
					return "<span class='red'>".trnslt('unzip_not')."</span>";
				}
			}else{
				return "<span class='red'>".trnslt('delzip_choose')."</span>";
			}
		}

		# показ та функціонал вибору тек в root директорії ---------------
		function show_root_dir($src_dir, $dirs){
			global $lang, $l;
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
			$out .= "<input id='alldir' type='checkbox' name='dir' value='' onclick='turn_of(this)' /> <b>".trnslt('all_files')."</b> <input type='checkbox' name='get_count' value='all' ".(($_GET['get_count']=='all' && !$_POST['submit'])?"checked='checked'":"")." onclick='if(get_count.checked)window.location=\"".preg_replace("/\?.*/","",$_SERVER['REQUEST_URI'])."?get_count=all\"; else window.location=\"".$_SERVER['SCRIPT_NAME']."\"' />".trnslt('show_dir_count_files')."<br />";

			foreach($dirs as $dir){
				if (is_dir($src_dir.$dir)){
					$all_count = 0;
					if(!isset($_GET['dont_count']) && !$_POST['gopass'] && !$_POST['submit'] && $_GET['get_count'] !=1){
						$all_count = getFolderCount($src_dir.$dir.'/');
						//addFolderCount($src_dir.$dir.'/', $all_count);
					}
					$out .= "<input class='selecteddir' type='checkbox' name='dir[".$dir."]' value='".$dir."' onclick='alldir.checked=false' /> ".$dir." (".(($all_count>1000 && $_GET['get_count']!='all')?trnslt('more_999'):$all_count).")<br />";
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
							//$_SESSION['log']['ok']
							//$_SESSION['log']['notice']
							if($_SESSION['log']['error'])
								echo "<span class='red'>".trnslt('add_folder_err')." - $zipdir</span><br />\n";
						}else{
							if($_SESSION['log']['ok'])
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

								//$except = array('zip', 'rar', 'tar', 'gz', '7z');
								if($cnt > $_POST['min'] && filesize($dir.$file) < $_POST['max_size']*1024 && $file != basename(__FILE__) && $file != 'archive_log.txt'){
									$zfile = iconv(mb_detect_encoding($file), 'CP866//TRANSLIT//IGNORE', $file);

									if($zipArchive->addFile($dir . $file, $zipdir . $zfile)){
										if($_SESSION['log']['ok'])
											echo "<span class='green'>".(1000000+$cnt)." - ".$dir.$file." OK</span><br />\n";
									}else{
										if($_SESSION['log']['error'])
											echo "<span class='red'>".trnslt('add_file_err')." ".$dir.$file."</span><br />\n";
									}
									if($_SESSION['log']['error'])
										fwrite($fp, (1000000+$cnt)." - ".$dir.$file." OK\n");
								}else{
									fwrite($fp, $dir.$file." - ".trnslt('skip')."\n");
									
									if($_SESSION['log']['notice'])
										echo "<span class='grey'>".$dir.$file." - ".trnslt('skip')."</span><br />\n";
								}
							}
						}
					}
					closedir($dh);
				}
			}
		}

		# головна функція підготовки до архівації --------------------
		function start_archivation($pathname, $log_file){
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
						if(count($_POST['dir']) > 4)
							$archname = "selected-".date('Y_m_d_His').".zip";
						else
							$archname = implode("-",$_POST['dir'])."-".date('Y_m_d_His').".zip";
					}elseif($_POST['dir_write']){
						$archname = $_POST['dir_write']."-".date('Y_m_d_His').".zip";
					}else{
						$archname = $_SERVER['SERVER_NAME']."-".date('Y_m_d_His').".zip";
					}
				}else{
					$archname = $_POST['addtozip'];
				}
				$fileName = $pathname."/".$archname;
				
				if($fp = fopen($log_file, 'w')){
					fwrite($fp, $fileName."\n");
				} else {
					$dirperm = substr(sprintf('%o', fileperms($pathname)), -4);
					if(chmod($pathname, 0777)){
						fwrite($fp, $fileName."\n");
					} else {
						echo "<span class='red'>".trnslt('permission')." ".$dirperm."</span>";
						return;
					}
				}
		
				//ZIPARCHIVE::ER_ZLIB
				if ($zip->open($fileName, ZIPARCHIVE::CREATE) !== true){
					fwrite(STDERR, "Error while creating archive file");
					echo "<span class='red'>".trnslt('zip_not')."</span>";
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
				
				$download = preg_replace("/\/".basename(__FILE__).".*/","",$_SERVER['REQUEST_URI']).$archname;
				echo "<br />".trnslt('zip_created')." <a href='".$download."'>".$archname."</a>. ".trnslt('zip_added_files')." ".$count;
				echo "<br />";
			}else{
				echo "Виберіть теку"."<br />";
			}
		}

		if(!$_POST['submit'] && $_GET['get_count'] == 1 && !$_POST['pswrd']){
			error_reporting(E_ERROR);
			$all_count = getFolderCount($pathname);
		}else
			$all_count = trnslt('many');
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
			form.zip:hover{ background-color: #E8E2D2; }
			.copyright { margin: -18px 4px 0 0; opacity: 0.2; position: relative; text-align: center; text-transform: lowercase; width: 100%; }
			.right { float: right; margin-left: 20px; }
			.left { float: left; }
			.clear { clear:both; }
		</style>
	</head>
	<body>
		<div id="wpapper">
			<div class="right"><?=VERSION?></div>
			<form action="<?=$_SERVER['REQUEST_URI']?>" method="GET">
				<?=trnslt('language')?>:
				<select name="lang" onchange="this.form.submit()">
					<option value="ua" <?=($l=='ua')?'selected="selected"':''?>>Українська</option>
					<option value="en" <?=($l=='en')?'selected="selected"':''?>>English</option>
					<option value="ru" <?=($l=='ru')?'selected="selected"':''?>>Русский</option>
				</select>
			</form>
<?
			if($_SESSION['psswrd'] == $pass){
				if(!$_POST['max_size']) $_POST['max_size'] = 1024;
				if(!$_POST['max']) $_POST['min'] = 0;
				if(!$_POST['max']) $_POST['max'] = 20000;
?>
				<div id="form_block">
					<fieldset class="left">
						<legend title=""><?=trnslt('count_files')?>:</legend>
						<?=trnslt('full_files')?> <b><?=$all_count?></b>
						<input type="checkbox" id="get_count" name="get_count" value='1' <?=(!$_POST['submit'])?'checked="checked"':''?> onclick="if(get_count.checked)window.location=window.location.href+'/?get_count=1'; else window.location='<?='http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']?>'" />
						<?=trnslt('show_full_count_files')?><br />
					</fieldset>
					
					<fieldset class="right">
						<legend title=""><?=trnslt('show_log')?>:</legend>
						<form class="zip clear" action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
							<input type="checkbox" name="show_ok" value='1' <?if($_SESSION['log']['ok']):?>checked="checked"<?endif;?> /> <?=trnslt('show_log_ok')?> |
							<input type="checkbox" name="show_notice" value='1' <?if($_SESSION['log']['notice']):?>checked="checked"<?endif;?> /> <?=trnslt('show_log_notice')?> |
							<input type="checkbox" name="show_error" value='1' <?if($_SESSION['log']['error']):?>checked="checked"<?endif;?> /> <?=trnslt('show_log_error')?>
							<input type="submit" name="log_submit" value='<?=trnslt('show_log_save')?>' />
						</form>
					</fieldset>
					<div class="clear"></div>
<?
					$rez_zip = "";
					if($_POST['unzip']){
						$rez_zip = unzippp($pathname, $_POST['zipfile']);
					}elseif($_POST['delzip']){
						$rez_zip = delzippp($pathname, $_POST['zipfile']);
					}
					$archive_exist = check_for_archive($pathname."/", $dirs);
?>
					<h2><?=trnslt('unziper')?></h2>
					<fieldset>
						<legend title="" ><?=trnslt('zip_found')?>:</legend>
<?					
						if(count($archive_exist)){
							foreach($archive_exist as $dir){
?>
								<form class="zip clear" enctype="multipart/form-data" action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
									<input class="selectedzip" type="radio" name="zipfile" value="<?=$dir?>" checked="checked" /> <span title="<?=number_format(filesize($pathname."/".$dir)/1024, 2, ".", " ")?> кб"><?=$dir?></span>
									<input class="right" type="submit" name="delzip" value="<?=trnslt('dell')?>" />
									<input class="right" type="submit" name="unzip" value="<?=trnslt('unzip')?>" />
								</form>
								<div class="clear"></div>
<?
							}
?>
							<fieldset>
								<legend title="" ><?=trnslt('unzip_log')?>:</legend>
								<div>
									<?=$rez_zip?>
								</div>
							</fieldset>
<?
						} else {
							echo trnslt('zip_not_found');
						}
?>
					</fieldset>
					<hr class="progress" />

					<h1><?=trnslt('zipsite')?></h1>
					<form action="<?=$_SERVER['REQUEST_URI']?>#gotobottom" method="POST">
						<fieldset>
							<legend title=""><?=trnslt('choose_zip')?>:</legend>
							<input class="addtozip" type="radio" name="addtozip" value="new" checked="checked" /> <?=trnslt('create_new_zip')?><br />
<?
							if(count($archive_exist)){
								foreach($archive_exist as $zzz){
									if (!is_dir($pathname."/".$zzz) && strstr($zzz, "zip")){
?>
										<input class="addtozip" type="radio" name="addtozip" value="<?=$zzz?>" /> <?=trnslt('add_to_zip')?> <b><?=$zzz?></b><br />
<?
									}
								}
							}
?>
						</fieldset>

						<fieldset>
							<legend title=""><?=trnslt('choose_dir')?>:</legend>
								<?=show_root_dir($pathname."/", $dirs);?>
							<fieldset>
								<legend title=""><?=trnslt('enter_subdir')?></legend>
								<input type="text" name="dir_write" value="<?=$_POST['dir_write']?>" style="width:99%" /> <br />
							</fieldset>
						</fieldset>

						<fieldset>
							<legend title="" ><?=trnslt('dir_exeption')?> "<span onclick="addEx(this)">upload</span>|<span onclick="addEx(this)">products_pictures</span>|<span onclick="addEx(this)">images</span>|<span onclick="addEx(this)">image_db</span>|<span onclick="addEx(this)">rss</span>|<span onclick="addEx(this)">gallery</span>|<span onclick="addEx(this)">uploads</span>|<span onclick="addEx(this)">cgi-bin</span>")</legend>
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

						<fieldset>
							<legend title="" ><?=trnslt('dont_zip_more')?>:</legend>
							<input type="text" name="max_size" value="<?=$_POST['max_size']?>" /> кб
						</fieldset>

						<fieldset>
							<legend title="" ><?=trnslt('zip_max_files_count')?>:</legend>
							від <input type="text" name="min" value="<?=$_POST['min']?>" />
							до <input type="text" name="max" value="<?=$_POST['max']?>" />
						</fieldset>
						<div class="clear"></div>
						<input class="archivatorstart" type="submit" name="submit" value="<?=trnslt('start')?>" />

						<a class="kamicadze"  href="<?=preg_replace("/\?.+/",'',$_SERVER['REQUEST_URI'])?>?del=itself" title="<?=trnslt('kamikadze')?>"><?=trnslt('kamikadze')?></a>
					</form>
					<div class="clear"></div>
					<fieldset class="archivelog">
						<legend title="" ><?=trnslt('zip_log')?>:</legend>
						<div id="log">
<?
							if($_POST['submit'])
								start_archivation($pathname, $log_file);
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
				echo trnslt('page_gen')." ".round(microtime(1)-$timestart, 4)." ".trnslt('sec').".<br />";
			}else{
				if (class_exists('ZipArchive')){
					echo check_new_vers(VERSION);
?>
					<fieldset class="passblock">
						<legend title="" ><?=trnslt('enter_pass')?>:</legend>
						<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
							<input type="password" name="pswrd" value="" style="float:left" />
							<input type="submit" name="gopass" value="<?=trnslt('login')?>" style="float:right" />
						</form>
					</fieldset>
<?
				}else{
					echo "<h1 align='center'>".trnslt('zip_sorry')."</h1>";
				}
			}
?>
			<div id="gotobottom"></div>
		</div>
		<div class="copyright">&copy <?=date("Y")?> Lesyuk Sergiy</div>
	</body>
</html>