<?
	error_reporting(E_ALL);
	define('VERSION', '201402111630');
	date_default_timezone_set("Europe/Kiev");
	session_start();
	//set_time_limit(300);
	$timestart = microtime(1);
	$pass = "238a0fa7c18cd78ca1f8d14c260ee02b";
	$pass = "b59c67bf196a4758191e42f76670ceba";
	$url = preg_replace("/\?.*/","",$_SERVER['REQUEST_URI']);
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
			'show_log_save' => 'Зберегти',
			'access_denied' => 'Доступ не надано.',
			'shots' => 'Залишилось',
			'left' => 'спроб',
			'check_new_vers_err' => 'Не вдалось перевірити нову версію',
			'develop' => 'Розроблено'
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
			'show_log_save' => 'Save',
			'access_denied' => 'Access denied.',
			'shots' => 'Shots',
			'left' => 'left',
			'check_new_vers_err' => 'Can not check new version',
			'develop' => 'Developer'
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
			'unzip_not' => 'Архив не найден',
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
			'show_log_save' => 'Сохранить',
			'access_denied' => 'Доступ запрещен.',
			'shots' => 'Осталось',
			'left' => 'попыток',
			'check_new_vers_err' => 'Не удалось проверить новую версию',
			'develop' => 'Разработано'
		)
	);
	#--- /массив перекладів -------------------------------------------------------
?>
<?
	if(isset($_GET['lang']))
		$_SESSION['lang'] = $_GET['lang'];
	elseif(!isset($_SESSION['lang']))
		$_SESSION['lang'] = 'ua';
	
	$l = $_SESSION['lang'];

	if(isset($_GET['del']) && !file_exists("checker.php")){
		unset($_SESSION);
		if(unlink(__FILE__))
			exit($lang[$l]['kamikadze_ok']);
		else
			exit($lang[$l]['kamikadze_err']);
	}
	
	if(!isset($_GET['get_count'])) $_GET['get_count'] = null;
	if(!isset($_GET['logout'])) $_GET['logout'] = null;
	if(!isset($_POST['gopass'])) $_POST['gopass'] = null;
	if(!isset($_POST['dir_write'])) $_POST['dir_write'] = null;
	if(!isset($_POST['exept'])) $_POST['exept'] = null;
	if(!isset($_POST['max_size'])) $_POST['max_size'] = null;
	if(!isset($_POST['min'])) $_POST['min'] = 0;
	if(!isset($_POST['max'])) $_POST['max'] = 20000;
	if(!isset($_POST['max_size'])) $_POST['max_size'] = 1024;
	if(!isset($_POST['submit'])) $_POST['submit'] = null;
	if(!isset($_POST['unzip'])) $_POST['unzip'] = null;
	if(!isset($_POST['delzip'])) $_POST['delzip'] = null;
	if(!isset($_POST['pswrd'])) $_POST['pswrd'] = null;
	if(!isset($_POST['log_submit'])) $_POST['log_submit'] = null;
	if(!isset($_POST['show_ok'])) $_POST['show_ok'] = null;
	if(!isset($_POST['show_notice'])) $_POST['show_notice'] = null;
	if(!isset($_POST['show_error'])) $_POST['show_error'] = null;
	if(!isset($_SESSION['pass_count'])) $_SESSION['pass_count'] = 3;
	if(!isset($_SESSION['psswrd'])) $_SESSION['psswrd'] = null;
	if(!isset($_SESSION['log']['ok'])) $_SESSION['log']['ok'] = 1;
	if(!isset($_SESSION['log']['notice'])) $_SESSION['log']['notice'] = 1;
	if(!isset($_SESSION['log']['error'])) $_SESSION['log']['error'] = 1;
?>
<? # ФУНКЦІЇ -------------------------------------------------------------
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
		if($last_ver = file_get_contents("http://lesyuk-serg.w.pw/archiver/checker.php?curr=".$vers)){
			if(strlen($last_ver) > strlen((int)$last_ver)+2)
				return $last_ver;
		} else {
			return show_log("ERROR", trnslt('check_new_vers_err'));
		}
	}
	
	# Підрахунок всіх файлів в корені (по версії Армема) -----------------
	function getFolderCount($dir){
		$cnt = 0;
		if($dirs = scandir($dir)){
			unset($dirs[array_search(".",$dirs)],$dirs[array_search("..",$dirs)]);
			if(current($dirs)){
				do{
					if (is_file($dir."/".current($dirs))){
						$cnt++;
					}else{
						if(!$_GET['get_count'] && $cnt>999) return $cnt;
						
						$cnt+= getFolderCount($dir."/".current($dirs));
					}
				}while(next($dirs));
			}
		}
		return $cnt;
	}

	# перевірка в root каталозі на zip файли -----------------------------
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

	# функція розархівації -----------------------------------------------
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
	
	# функція видалення архіву -------------------------------------------
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
	
	# показ та функціонал вибору тек в root директорії -------------------
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
				if(!$_POST['submit'] && $_GET['get_count'] !=1){
					$all_count = getFolderCount($src_dir.$dir.'/');
					//addFolderCount($src_dir.$dir.'/', $all_count);
				}
				$out .= "<input class='selecteddir' type='checkbox' name='dir[".$dir."]' value='".$dir."' onclick='alldir.checked=false' /> ".$dir." (".(($all_count>1000 && $_GET['get_count']!='all')?trnslt('more_999'):$all_count).")<br />";
			}
		}
		return $out;
	}

	# Рекурсивна функція архівації вкладених файлів і тек ----------------
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

	# головна функція підготовки до архівації ----------------------------
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

	# функція перевірки паролю -------------------------------------------
	function check_pass($pass){
		if(md5($_POST['pswrd']) == $pass){
			$_SESSION['psswrd'] = $pass;
		}else{
			$_SESSION['pass_count']--;
			return show_log("ERROR", trnslt('access_denied')." ".trnslt('shots')." ".trnslt('left').": ".$_SESSION['pass_count']);
		}
	}
	
	# функція відображення повідомлень -----------------------------------
	function show_log($type, $text){
		switch ($type) {
			case "ERROR":
				return '<div class="msg w"><i>w</i>'.$text.'</div>';
			case 'NOTICE':
				return '<div class="msg i"><i>!</i>'.$text.'</div>';
			case 'OK':
				return '<div class="msg ok"><i>ok</i>'.$text.'</div>';       
			default:
				return "wrong type";
		}
	}
	
?>
<?
	if($_GET['logout']){
		$_SESSION['psswrd'] = 1;
		$_SESSION['pass_count'] = 3;
	}
	if(md5($_POST['pswrd']) == $pass) $_SESSION['psswrd'] = $pass;
	
	if($_SESSION['psswrd'] == $pass){
		$log_file = "archive_log.txt";
		# тека в якій буде размішено архів
		$pathname = getcwd();
		$dirs = scandir($pathname);
		unset($dirs[array_search(".",$dirs)],$dirs[array_search("..",$dirs)]);
		sort($dirs);
		$count = 0;

		# налаштування логування ---------------------------------------------
		if($_POST['log_submit']){
			$_SESSION['log']['ok'] = $_POST['show_ok']?1:0;
			$_SESSION['log']['notice'] = $_POST['show_notice']?1:0;
			$_SESSION['log']['error'] = $_POST['show_error']?1:0;
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
			body{ margin: 0; background-color: #F8F8E2; padding: 0px; }
			input.archivatorstart{ cursor: pointer; display: block; font-size: 20px; height: 50px; margin: 8px auto; width: 30%; }
			legend{ font-weight: bold; font-size: medium; }
			.archivelog div{ max-height: 394px; overflow: auto; }
			.passblock{ width: 220px; margin: 100px auto; }
			.newvers{ width: 98%; margin: 0 auto; }
			.progress{ height: 40px; background:#444; width: 100%; transition: all 2s ease 0s; }
			.kamicadze {
				color: #888888;
				margin-top: -40px;
				position: absolute;
				right: 10px;
				text-decoration: none;
			}
			.kamicadze:hover { text-decoration: underline; }
			.kamicadze:active { color: #444444; }
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
			.logo { color: #888888; display: block; font-size: 28px; padding: 20px 20px 10px 0px; text-decoration: none; text-shadow: 0 0 1px #888888; transition: all 0.4s ease 0s; float: left;}
			.logo:hover {color: #666666; text-shadow: 0 0 1px #000000; }
			#wpapper > form.lang_form { padding: 8px 0 0; }
			
			
			
			
			
			
			
			
			
			
			
			* {
				margin: 0;
				padding: 0;
			}
			body {
				font: 13px/18px Verdana, Arial, Tahoma, sans-serif;
				-webkit-text-size-adjust: 100%;
				-ms-text-size-adjust: 100%;
				background-color: #39404C;
				color: #FFF;
				width: 100%;
			}
			.section {
				clear: both;
				position: relative;
				margin: 0 0 20px;
				box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
			}
			.section__headline {
				padding: 7px 15px;
				border-bottom: 1px solid #FAFCF7;
				border-radius: 3px 3px 0 0;
				background: linear-gradient(#EF705F, #E05C50);
				box-shadow: inset 0 1px #F08C75;
				color: #FFF;
				text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
				font-weight: normal;
				font-size: 16px;
				line-height: 24px;
			}
			.section__inner { 
				background: #EFEFEF;
				border-radius: 0px 0px 2px 2px;
				padding: 15px;
				color: #444444;
			}
			.section__inner.log {
				max-height: 300px;
				overflow: auto;
			}
			.wrapper { 
				margin: 0px auto;
				max-width: 894px;
				position: relative;
			}
			label { 
				cursor: pointer;
				display: inline-block;
				line-height: 22px;
			}
			label span {
				display: inline-block;
				min-width: 70px;
			}
			select,
			input[type="text"],
			input[type="password"] {
				border-radius: 3px;
				padding: 2px 5px;
				border: 1px solid #C4C9D0;
				color: #646F81;
			}
			select:focus,
			input[type="text"]:focus,
			input[type="password"]:focus {
				border: 1px solid #8891A2;
			}
			input[type="submit"] {
				height: 34px;
				padding: 0 15px;
				cursor: pointer;
				font: 16px Verdana, Arial, sans-serif;
				border: none;
				color: #FFF;
				border-radius: 3px;
				box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
				background: linear-gradient(#94CF58, #85CA40);
				text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
			}
			input[type="submit"]:hover { background: #94CF58; }
			input[type="submit"]:active {
				background: none repeat scroll 0 0 #84CE48;
				box-shadow: 0 0 0 !important;
			}
			.nav {
				margin: -36px 0 20px 0;
				float: right;
				box-shadow: 0 5px 10px rgba(0,0,0,0.2);
				border-radius: 3px;
				background: #646F81;
			}
			.nav li {
				float: left;
				list-style: none;
				cursor: pointer;
				border-left: 1px solid #515D6D;
				box-shadow: inset -1px 1px #6B7787;
			}
			.nav li a, .nav li span{
				display: block;
				color: #E7EAED;
				padding: 8px 12px 8px;
				text-decoration: none;
			}
			.nav li:first-child {
				border-radius: 3px 0 0 3px;
				border-left: none;
			}
			.nav li:last-child {
				border-radius: 0 2px 2px 0;
			}
			.nav li:hover {
				color: #FFF;
				background: linear-gradient(#EF705F, #E05C50);
				box-shadow: inset 0 1px #F08C75;
			}
			.nav li:active {
				background: #E04C40;
				box-shadow: inset 0 1px #F08C75;
			}
			.nav li.active {
				background: linear-gradient(#5B6475, #4B525F);
				box-shadow: inset 0 1px #6B7787;
			}
			.row:first-child {
				margin-top: 0;
			}
			.row:last-child {
				margin-bottom: 0;
			}
			.row { margin: 10px 0; }
			.msg.w { background: #F13921; }
			.msg.i { background: #4FC0E8; }
			.msg.ok { background: #94CF58; }
			.msg i {
				color: #FFF;
				line-height: 15px;
				font-size: 11px;
				text-align: center;
				position: absolute;
				left: 12px;
				top: 12px;
				display: inline-block;
				width: 16px;
				height: 16px;
				border-radius: 8px;
				border: 1px solid #FFF;
			}
			.msg {
				position: relative;
				margin: 0 0 20px;
				padding: 10px 0 10px 45px;
				border-radius: 3px;
				font-size: 12px;
				line-height: 20px;
				color: #FFF;
				box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
			}
			.footer { 
				background: rgba(0, 0, 0, 0.196);
				bottom: 0px;
				color: #AEB4BB;
				font-size: 11px;
				left: 0px;
				padding: 8px 0px;
				/* position: absolute; */
				width: 100%;
			}
			.footer a {
				color: #AEB4BB;
			}
			.footer a:hover {
				color: #FFF;
			}

			.clear { clear:both; }
			
			
			div.login {
				margin: 10% 0 0 10%;
				position: absolute;
				width: 300px;
			}
			input[type="submit"].inside{
				float:right;
				box-shadow: 0 1px 1px rgba(0, 0, 0, 0.3)
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
		</style>
	</head>
	<body>
		<div class="wrapper">
			<a class="logo" href="<?=$url?>">ARCHIVER</a>
			<div class="clear"></div>
<?
			if($_SESSION['psswrd'] == $pass){
?>
				<ul class="nav">
					<li class="active"><span>Настройки</span></li>
					<li><span>Создать архив</span></li>
					<li><span>Извлеч из архива</span></li>
					<li><span>Дополнить архив</span></li>
					<li><span>Файловый менеджер</span></li>
					<li><a href="<?=$url?>?logout=ok">Выйти</a></li>
				</ul>
				
				<div id="form_block">
					<div class="section">
						<div class="section__headline"><?=trnslt('count_files')?>:</div>
						<div class="section__inner">
							<div class="row">
								<?=trnslt('full_files')?> <b><?=$all_count?></b>
								<input type="checkbox" id="get_count" name="get_count" value='1' <?=(!$_POST['submit'])?'checked="checked"':''?> onclick="if(get_count.checked)window.location=window.location.href+'/?get_count=1'; else window.location='<?='http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']?>'" />
								<?=trnslt('show_full_count_files')?><br />
							</div>
						</div>
					</div>
					
					<div class="section">
						<div class="section__headline"><?=trnslt('show_log')?>:</div>
						<div class="section__inner">
							<div class="row">
								<form class="zip clear" action="<?=$url?>" method="POST">
									<input type="checkbox" name="show_ok" value='1' <?if($_SESSION['log']['ok']):?>checked="checked"<?endif;?> /> <?=trnslt('show_log_ok')?> |
									<input type="checkbox" name="show_notice" value='1' <?if($_SESSION['log']['notice']):?>checked="checked"<?endif;?> /> <?=trnslt('show_log_notice')?> |
									<input type="checkbox" name="show_error" value='1' <?if($_SESSION['log']['error']):?>checked="checked"<?endif;?> /> <?=trnslt('show_log_error')?>
									<input class="right inside" type="submit" name="log_submit" value='<?=trnslt('show_log_save')?>' />
								</form>
								<div class="clear"></div>
							</div>
						</div>
					</div>

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
					<div class="section">
						<div class="section__headline"><?=trnslt('zip_found')?>:</div>
						<div class="section__inner">
							<div class="row">
<?					
								if(count($archive_exist)){
									foreach($archive_exist as $dir){
?>
										<form class="zip clear" enctype="multipart/form-data" action="<?=$url?>" method="POST">
											<input class="selectedzip" type="radio" name="zipfile" value="<?=$dir?>" checked="checked" /> <span title="<?=number_format(filesize($pathname."/".$dir)/1024, 2, ".", " ")?> кб"><?=$dir?></span>
											<input class="right inside" type="submit" name="delzip" value="<?=trnslt('dell')?>" />
											<input class="right inside" type="submit" name="unzip" value="<?=trnslt('unzip')?>" />
											<div class="clear"></div>
										</form>
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
							</div>
						</div>
					</div>

					<hr class="progress" />

					<h1><?=trnslt('zipsite')?></h1>
					<form action="<?=$url?>#gotobottom" method="POST">
						<div class="section">
							<div class="section__headline"><?=trnslt('choose_zip')?>:</div>
							<div class="section__inner">
								<div class="row">
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
								</div>
							</div>
						</div>
						
						<div class="section">
							<div class="section__headline"><?=trnslt('choose_dir')?>:</div>
							<div class="section__inner">
								<div class="row">
									<?=show_root_dir($pathname."/", $dirs);?>
									<fieldset>
										<legend title=""><?=trnslt('enter_subdir')?></legend>
										<input type="text" name="dir_write" value="<?=$_POST['dir_write']?>" style="width:99%" /> <br />
									</fieldset>
								</div>
							</div>
						</div>

						<div class="section">
							<div class="section__headline"><?=trnslt('dir_exeption')?> "<span onclick="addEx(this)">upload</span>|<span onclick="addEx(this)">products_pictures</span>|<span onclick="addEx(this)">images</span>|<span onclick="addEx(this)">image_db</span>|<span onclick="addEx(this)">rss</span>|<span onclick="addEx(this)">gallery</span>|<span onclick="addEx(this)">uploads</span>|<span onclick="addEx(this)">cgi-bin</span>")</div>
							<div class="section__inner">
								<div class="row">
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
								</div>
							</div>
						</div>

						<div class="section">
							<div class="section__headline"><?=trnslt('dont_zip_more')?>:</div>
							<div class="section__inner">
								<div class="row">
									<input type="text" name="max_size" value="<?=$_POST['max_size']?>" /> кб
								</div>
							</div>
						</div>

						<div class="section">
							<div class="section__headline"><?=trnslt('zip_max_files_count')?>:</div>
							<div class="section__inner">
								<div class="row">
									від <input type="text" name="min" value="<?=$_POST['min']?>" />
									до <input type="text" name="max" value="<?=$_POST['max']?>" />
								</div>
							</div>
						</div>
						<div class="clear"></div>
						
						<input class="archivatorstart" type="submit" name="submit" value="<?=trnslt('start')?>" />

						<a class="kamicadze"  href="<?=preg_replace("/\?.+/",'',$url)?>?del=itself" title="<?=trnslt('kamikadze')?>"><?=trnslt('kamikadze')?></a>
					</form>
					<div class="clear"></div>
					
					<div class="section">
						<div class="section__headline"><?=trnslt('zip_log')?>:</div>
						<div class="section__inner log">
							<div class="row">
								<div id="log">
<?
									if($_POST['submit'])
										start_archivation($pathname, $log_file);
?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script>
					document.getElementById('log').scrollTop = 88888888;
					/*
					var req;
					var handlerPath = 'test_ajax.php'; // Путь к файлу на сервере на который будет отправляться запрос

					function createRequest() {
						if (window.XMLHttpRequest) req = new XMLHttpRequest();		// normal browser
						else if (window.ActiveXObject) {							// IE
							try {
								req = new ActiveXObject('Msxml2.XMLHTTP');			// IE разных версий
							} catch (e){}											// может создавать
							try {													// объект по разному
								req = new ActiveXObject('Microsoft.XMLHTTP');
							} catch (e){}
						}
						return req;
					}

					function getData(handlerPath, parameters) {
						req = createRequest();
						if (req) {
							req.open("POST", handlerPath, false);
							req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							req.send(parameters);

							if (req.status == 200) {
								var rData = req.responseText;
								var eData = JSON.parse(rData);
								var eArray = !(/[^,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]/.test(rData.replace(/"(\\.|[^"\\])*"/g, ''))) && eval('(' + rData + ')');
							} else {
								alert("Не удалось получить данные:\n" + req.statusText);
							}
						} else {
							alert("Браузер не поддерживает AJAX");
						}
						return eArray;
					}
					*/
				</script>
<?
				echo trnslt('page_gen')." ".round(microtime(1)-$timestart, 4)." ".trnslt('sec').".<br />";
			}else{
				if (class_exists('ZipArchive')){
					$new_version = check_new_vers(VERSION);
					if($new_version){
?>
						<div class="section">
							<div class="section__headline"><?=trnslt('your_vers').' '.VERSION.' '.trnslt('not_new')?>:</div>
							<div class="section__inner">
								<div class="row">
									<?=check_new_vers(VERSION)?>
								</div>
							</div>
						</div>
<?
					}
					if ($_SESSION['pass_count'] > 0){
?>
						<?=$_POST['pswrd']?check_pass($pass):''?>
							
						<div class="section login">
							<div class="section__headline"><?=trnslt('enter_pass')?>:</div>
							<div class="section__inner">
								<div class="row">
									<form name="login" action="<?=$url?>" method="POST">
										<input type="password" name="pswrd" value="" />
										<input class="inside" type="submit" name="gopass" value="<?=trnslt('login')?>" />
									</form>
								</div>
								<div class="row">
									<form class="lang_form" action="<?=$url?>" method="GET">
										<?=trnslt('language')?>:
										<select name="lang" onchange="this.form.submit()">
											<option value="ua" <?=($l=='ua')?'selected="selected"':''?>>Українська</option>
											<option value="en" <?=($l=='en')?'selected="selected"':''?>>English</option>
											<option value="ru" <?=($l=='ru')?'selected="selected"':''?>>Русский</option>
										</select>
									</form>
								</div>
							</div>
						</div>
							
<?
					} else {
						echo show_log("ERROR", trnslt('access_denied')." ".trnslt('shots')." ".trnslt('left').": ".$_SESSION['pass_count']);
					}
				}else{
					echo "<h1 align='center'>".trnslt('zip_sorry')."</h1>";
				}
			}
?>
			<div id="gotobottom"></div>
		</div>
		<div class="footer" <?=($_SESSION['psswrd'] != $pass)?"style='position:absolute'":""?>>
			<div class="wrapper">&copy; <?=date("Y")?> <b>ARCHIVER</b> <?=trnslt('develop')?> <u>Lesyuk Sergiy</u>. All Right Reserved. 
				<span style="float: right;"><?=trnslt('your_vers')?> <?=VERSION?></span>
			</div>
		</div>
	</body>
</html>