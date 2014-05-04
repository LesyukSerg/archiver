<?
	error_reporting(E_ALL);
	define('VERSION', '201404030942');
	date_default_timezone_set("Europe/Kiev");
	session_start();
	set_time_limit(0);
	$timestart = microtime(1);
	//$pass = "238a0fa7c18cd78ca1f8d14c260ee02b";
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
			'develop' => 'Розроблено',
			'settings_saved' => 'Налаштування збережені',
			'settings' => 'Налаштування',
			'create_arch' => 'Створити Архів',
			'extract_arch' => 'Витягти із Архіву',
			'file_manager' => 'Файловий Менеджер',
			'exit' => 'Вихід',
			'files_&_dirs_in' => 'Файли та теки в директорії',
			'from' => 'від',
			'to' => 'до',
			'limit' => 'по',
			'ajax_load' => '(при ajax завантаженні)',
			'show_confirm_window' => 'Запитувати підтвердження для',
			'unziping_arch' => 'Розархівування',
			'deleting_arch' => 'Видалення архіву',
			'fm_t_name' => 'Назва',
			'fm_t_count' => 'Кількість',
			'fm_t_size' => 'Розмір',
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
			'develop' => 'Developer',
			'settings_saved' => 'Settings saved',
			'settings' => 'Settings',
			'create_arch' => 'Create Archive',
			'extract_arch' => 'Extract Archive',
			'file_manager' => 'File Manager',
			'exit' => 'Exit',
			'files_&_dirs_in' => 'Files & folders in directory',
			'from' => 'from',
			'to' => 'to',
			'limit' => 'limit',
			'ajax_load' => '(ajax loaded)',
			'show_confirm_window' => 'Show confirm window for',
			'unziping_arch' => 'Unziping archive',
			'deleting_arch' => 'Deleting archive',
			'fm_t_name' => 'Name',
			'fm_t_count' => 'Count',
			'fm_t_size' => 'Size',
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
			'develop' => 'Разработано',
			'settings_saved' => 'Настройки сохранены',
			'settings' => 'Настройки',
			'create_arch' => 'Создать Архив',
			'extract_arch' => 'Извлечь из Архива',
			'file_manager' => 'Файловый Менеджер',
			'exit' => 'Выход',
			'files_&_dirs_in' => 'Файлы и папки в директории',
			'from' => 'от',
			'to' => 'до',
			'limit' => 'по',
			'ajax_load' => '(при ajax загрузке)',
			'show_confirm_window' => 'Запрашивать подтверждение для',
			'unziping_arch' => 'Разархивации',
			'deleting_arch' => 'Удаления архива',
			'fm_t_name' => 'Название',
			'fm_t_count' => 'Количество',
			'fm_t_size' => 'Размер',
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
	if(!isset($_GET['section'])) $_GET['section'] = null;
	if(!isset($_GET['fmdir'])) $_GET['fmdir'] = null;
	if(!isset($_POST['gopass'])) $_POST['gopass'] = null;
	if(!isset($_POST['dir'])) $_POST['dir'] = null;
	if(!isset($_POST['dir_write'])) $_POST['dir_write'] = null;
	if(!isset($_POST['exept'])) $_POST['exept'] = array("");
	if(!isset($_POST['submit'])) $_POST['submit'] = null;
	if(!isset($_POST['unzip'])) $_POST['unzip'] = null;
	if(!isset($_POST['delzip'])) $_POST['delzip'] = null;
	if(!isset($_POST['pswrd'])) $_POST['pswrd'] = null;
	if(!isset($_POST['log_submit'])) $_POST['log_submit'] = null;
	if(!isset($_POST['show_ok'])) $_POST['show_ok'] = null;
	if(!isset($_POST['show_notice'])) $_POST['show_notice'] = null;
	if(!isset($_POST['show_error'])) $_POST['show_error'] = null;
	if(!isset($_POST['ajax'])) $_POST['ajax'] = null;
	if(!isset($_POST['skipfiles'])) $_POST['skipfiles'] = null;
	if(!isset($_POST['confirm_unzip'])) $_POST['confirm_unzip'] = null;
	if(!isset($_POST['confirm_delzip'])) $_POST['confirm_delzip'] = null;
	if(!isset($_SESSION['options']['min'])) $_SESSION['options']['min'] = 0;
	if(!isset($_SESSION['options']['max'])) $_SESSION['options']['max'] = 20000;
	if(!isset($_SESSION['options']['max_size'])) $_SESSION['options']['max_size'] = 1024;
	if(!isset($_SESSION['pass_count'])) $_SESSION['pass_count'] = 3;
	if(!isset($_SESSION['psswrd'])) $_SESSION['psswrd'] = null;
	if(!isset($_SESSION['log']['OK'])) $_SESSION['log']['OK'] = 1;
	if(!isset($_SESSION['log']['NOTICE'])) $_SESSION['log']['NOTICE'] = 1;
	if(!isset($_SESSION['log']['ERROR'])) $_SESSION['log']['ERROR'] = 1;
	if(!isset($_SESSION['message'])) $_SESSION['message'] = array("ERROR" => array(), "NOTICE" => array(), "OK" => array());
	if(!isset($_SESSION['history'])) $_SESSION['history'] = array();
	if(!isset($_SESSION['options']['min_orig'])) $_SESSION['options']['min_orig'] = null;
	if(!isset($_SESSION['options']['max_orig'])) $_SESSION['options']['max_orig'] = null;
	if(!isset($_SESSION['options']['files_for_iteration'])) $_SESSION['options']['files_for_iteration'] = 1000;
	if(!isset($_SESSION['options']['confirm_unzip'])) $_SESSION['options']['confirm_unzip'] = 1;
	if(!isset($_SESSION['options']['confirm_delzip'])) $_SESSION['options']['confirm_delzip'] = 1;
	if(isset($lastvers)) $_SESSION['message']['NOTICE'][] = $lastvers;
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
	function getFolderCount($dir, &$cnt = 0){
		if(!$_GET['get_count'] && $cnt>999) return $cnt;
		
		if($dirs = scandir($dir)){
			unset($dirs[array_search(".",$dirs)],$dirs[array_search("..",$dirs)],$dirs[array_search(".git",$dirs)],$dirs[array_search("archive.log",$dirs)]);
			if(current($dirs)){
				do{
					if (is_file($dir."/".current($dirs))){
						$cnt++;
					}else{
						getFolderCount($dir."/".current($dirs), $cnt);
					}
				}while(next($dirs));
			}
		}
		return $cnt;
	}
	
	# Підрахунок файлів для архівації ------------------------------------
	function getFolderCount_for_ajax($dir, &$cnt = 0){
		if($dirs = scandir($dir)){
			unset($dirs[array_search(".",$dirs)],$dirs[array_search("..",$dirs)],$dirs[array_search(".git",$dirs)],$dirs[array_search("archive.log",$dirs)]);
			if(current($dirs)){
				do{
					$file = current($dirs);
					if (is_file($dir."/".$file)){
						if(filesize($dir."/".$file) < $_SESSION['options']['max_size']*1024 && $file != basename(__FILE__) && $file != 'archive.log')
							$cnt++;
					}else{
						if(!in_array($file, $_POST['exept']) && $file != '.git')
							getFolderCount_for_ajax($dir."/".$file, $cnt);
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
					$_SESSION['message']['OK'][] = trnslt('arch')." <b>".$zpfl."</b> ".trnslt('unzip_ok')." ".$archive_dir.".";
				}else{
					$_SESSION['message']['ERROR'][] = trnslt('unzip_err')." <b>".$zpfl."</b>";
				}
			}else{
				$_SESSION['message']['ERROR'][] = trnslt('unzip_not');
			}
		}else{
			$_SESSION['message']['ERROR'][] = trnslt('unzip_choose');
		}
	}
	
	# функція видалення архіву -------------------------------------------
	function delzippp($archive_dir, $zpfl){
		if($zpfl){
			$zipfile = $archive_dir."/".$zpfl;

			if(file_exists($zipfile)){
				if (unlink($zipfile)){
					$_SESSION['message']['OK'][] = trnslt('delzip_ok')." <b>".$zpfl."</b>";
				}else{
					$_SESSION['message']['ERROR'][] = trnslt('delzip_err')." <b>".$zpfl."</b>";
				}
			}else{
				$_SESSION['message']['ERROR'][] = trnslt('unzip_not');
			}
		}else{
			$_SESSION['message']['ERROR'][] = trnslt('delzip_choose');
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
				$dir = iconv('cp1251', 'UTF-8', $dir);
				$out .= "<input class='selecteddir' type='checkbox' name='dir[".$dir."]' value='".$dir."' onclick='alldir.checked=false' /> ".$dir." (".(($all_count>1000 && $_GET['get_count']!='all')?trnslt('more_999'):$all_count).")<br />";
			}
		}
		return $out;
	}
	
	# показ тек та файлів в $src_dir директорії --------------------------
	function show_root_dir_and_files($src_dir, $sub){
		if(strstr($sub, "..")){
			$sub = "";
			$src_dir = getcwd()."/";
		}
		
		$dirs = scandir($src_dir);
		unset($dirs[array_search(".",$dirs)]);
		
		global $lang, $l;
		$out = "";

		$dirs_out = array();
		$files_out = array();
		foreach($dirs as $dir){
			if (is_dir($src_dir.$dir)){
				$dirs_out[] = $dir;
			} else {
				$files_out[] = $dir;
			}
		}
		
		$out = "
			<table class='file_mamger_table'>
				<tr>
					<th>".trnslt('fm_t_name')."</th>
					<th>".trnslt('fm_t_count')."</th>
					<th>".trnslt('fm_t_size')."</th>
				</tr>
		";
		$up = "";
		foreach($dirs_out as $dir){
			$all_count = 0;
			if($dir == '..'){
				$pos = strrpos($sub, '/');
				if ($pos)
					$up = substr($sub, 0, $pos);
				else
					if(!$sub)
						continue;
				
				$dirname = "<a href='?section=filemananer&dir=".$up."'>".$dir."</a>";
			} else {
				$all_count = getFolderCount($src_dir.$dir.'/');
				$dir = iconv('cp1251', 'UTF-8', $dir);
				$dirname = "<a href='?section=filemananer&fmdir=".($sub?($sub."/"):'').$dir."'>".$dir."</a>";
			}
		
			
			$count = ($all_count>1000 && $_GET['get_count']!='all')?trnslt('more_999'):$all_count;
			
			$out .= "
				<tr>
					<td>".$dirname."</td>
					<td class='count'>".$count."</td>
					<td class='size'></td>
				</tr>
			";
		}
		
		
		foreach($files_out as $file){
			$size = filesize($src_dir.$file);
			$file = iconv('cp1251', 'UTF-8', $file);
			
			$out .= "
				<tr>
					<td>".$file."</td>
					<td class='count'></td>
					<td class='size'>".$size." b</td>
				</tr>
			";
		}
		$out .= "</table>";
		
		return $out;
	}

	# Рекурсивна функція архівації вкладених файлів і тек ----------------
	function addFolderToZip($dir, &$zipArchive, $zipdir = '', &$cnt, &$fp){		
		if (is_dir($dir)){
			fwrite($fp, $dir."\n");

			if ($dh = opendir($dir)){
				if($cnt > $_SESSION['options']['min']){
					# Додаємо порожню директорію
					if(!empty($zipdir)){
						$zdir = $zipdir;
						//echo $zipdir.mb_detect_encoding($zipdir)."<br />";
						//$zdir = iconv('windows-1251', 'utf-8', $zipdir);
						//$zdir = iconv('windows-1251', 'CP866//TRANSLIT//IGNORE', $zipdir);
						//$edir = iconv("cp1251","utf-8",$zipdir);
						if($zipArchive->addEmptyDir($zdir) === false){
							if($_SESSION['log']['ERROR'])
								$_SESSION['history'][] = "<span class='red'>".trnslt('add_folder_err')." - ".$zdir."</span><br />\n";
						}else{
							if($_SESSION['log']['OK'])
								$_SESSION['history'][] = "<b>".$zdir."</b><br />";
						}
					}
				}

				#  цикл по всім файлам
				while(($file = readdir($dh))){
					# якщо це тека - запускаємо функцію
					if(is_dir($dir.$file)){
						# пропуск директорій '.' і '..'
						if(!in_array($file, $_POST['exept']) && $file != '.git'){
							$zfile = $file;
							//$zfile = iconv(mb_detect_encoding($file), 'CP866//TRANSLIT//IGNORE', $file);
							addFolderToZip($dir.$file."/", $zipArchive, $zipdir.$zfile . "/", $cnt, $fp);
						}
					}else{
						# Додаємо файли в архів
						if($file !== basename(__FILE__)){
							if($cnt >= $_SESSION['options']['max'])
								break;

							//$except = array('zip', 'rar', 'tar', 'gz', '7z');
							if($cnt > $_SESSION['options']['min']){
								if(filesize($dir.$file) < $_SESSION['options']['max_size']*1024 && $file != basename(__FILE__) && $file != 'archive.log'){
									$zfile = iconv(mb_detect_encoding($file), 'CP866//TRANSLIT//IGNORE', $file);

									//$dir = iconv('windows-1251', 'utf-8', $dir);
									if($zipArchive->addFile($dir.$file, $zipdir.$zfile)){
										if($_SESSION['log']['OK'])
											$_SESSION['history'][] = "<span class='green'>".(1000000+$cnt)." - ".$dir.$file." OK</span><br />\n";
									}else{
										if($_SESSION['log']['ERROR'])
											$_SESSION['history'][] = "<span class='red'>".trnslt('add_file_err')." ".$dir.$file."</span><br />\n";
									}
									
									fwrite($fp, (1000000+$cnt)." - ".$dir.$file." OK\n");
								}else{
									//$dir = iconv('windows-1251', 'utf-8', $dir);
									if($_SESSION['log']['NOTICE'])
										$_SESSION['history'][] = "<span class='grey'>".$dir.$file." - ".trnslt('skip')."</span><br />\n";
									
									fwrite($fp, $dir.$file." - ".trnslt('skip')."\n");
								}
							}
							$cnt++;
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

			if(is_array($_POST['dir']) && isset($_POST['dir'][0]) && $_POST['dir'][0] == ""){
				$_POST['dir'] = "";
			}
			# ім'я архіва
			if($_POST['addtozip'] == 'new'){
				if(is_array($_POST['dir'])){				
					if(count($_POST['dir']) > 4)
						$archname = "selected-".date('Y_m_d_His').".zip";
					else{
						$archname = implode("-",$_POST['dir'])."-".date('Y_m_d_His').".zip";
					}
				}elseif($_POST['dir_write']){
					$archname = $_POST['dir']."-".date('Y_m_d_His').".zip";
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
				$_SESSION['message']['ERROR'][] = trnslt('zip_not');
				exit(1);
			}

			if(!$_POST['ajax']){
				$_SESSION['history'] = array();
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
			
			$download = preg_replace("/\/".basename(__FILE__).".*/","/",$_SERVER['REQUEST_URI']).$archname;
			$_SESSION['message']['OK'][] = trnslt('zip_created')." <a id='archv' href='".$download."'>".$archname."</a>. ".trnslt('zip_added_files')." <span id='cntfls'>".$count."</span>";
			$_SESSION['history'][] = "===========".trnslt('zip_created')." <a href='".$download."'>".$archname."</a>. ".trnslt('zip_added_files')." ".$count."===========";
		}else{
			$_SESSION['message']['NOTICE'][] = "Виберіть теку"."<br />";
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
				return '<div class="msg w"><i>er</i>'.$text.'</div>';
			case "NOTICE":
				return '<div class="msg i"><i>!</i>'.$text.'</div>';
			case "OK":
				return '<div class="msg ok"><i>ok</i>'.$text.'</div>';       
			default:
				return "wrong type";
		}
	}
	
	# функція виводу повідомлень -----------------------------------------
	function show_messages(){
		if($_SESSION['message']){
			foreach($_SESSION['message'] as $key => $messages){
				foreach($messages as $text){
					echo show_log($key, $text);
				}
				$_SESSION['message'][$key] = array();
			}
		}
	}
?>
<?
	if($_GET['logout']){
		$_SESSION['psswrd'] = 1;
		$_SESSION['pass_count'] = 3;
	}
	
	if(md5($_POST['pswrd']) == $pass) $_SESSION['psswrd'] = $pass;
	//$_SESSION['psswrd'] = "b59c67bf196a4758191e42f76670ceba";
	if($_SESSION['psswrd'] == $pass){
		$log_file = "archive.log";
		# тека в якій буде размішено архів
		$pathname = getcwd();
		$dirs = scandir($pathname);
		unset($dirs[array_search(".",$dirs)],$dirs[array_search("..",$dirs)],$dirs[array_search(".git",$dirs)]);
		sort($dirs);
		$count = 0;

		if($_POST['log_submit']){
			# налаштування логування ---------------------------------------------
			$_SESSION['log']['ok'] = $_POST['show_ok']?1:0;
			$_SESSION['log']['notice'] = $_POST['show_notice']?1:0;
			$_SESSION['log']['error'] = $_POST['show_error']?1:0;
			$_SESSION['options']['min'] = $_POST['min'];
			$_SESSION['options']['max'] = $_POST['max'];
			$_SESSION['options']['max_size'] = $_POST['max_size'];
			$_SESSION['options']['files_for_iteration'] = $_POST['files_for_iteration'];
			$_SESSION['message']['OK'][] = trnslt('settings_saved');
			
			$_SESSION['options']['confirm_unzip'] = $_POST['confirm_unzip']?1:0;
			$_SESSION['options']['confirm_delzip'] = $_POST['confirm_delzip']?1:0;
		}
		elseif($_POST['unzip']){
			unzippp($pathname, $_POST['zipfile']);
		}
		elseif($_POST['delzip']){
			delzippp($pathname, $_POST['zipfile']);
		}
		elseif($_POST['submit']){
			if($_POST['ajax']){
				if(isset($_POST['dir'])) {
					$_SESSION['options']['min_orig'] = $_SESSION['options']['min'];
					$_SESSION['options']['max_orig'] = $_SESSION['options']['max'];
					$_POST['dir'] = explode("|",substr($_POST['dir'],1, strlen($_POST['dir'])));
					$_SESSION['options']['min'] = $_POST['skipfiles'];
					$_SESSION['options']['max'] = $_POST['skipfiles']+$_SESSION['options']['files_for_iteration'];
				}
			}
			
			start_archivation($pathname, $log_file);
			
			if($_POST['ajax']){
				$_SESSION['options']['min'] = $_SESSION['options']['min_orig'];
				$_SESSION['options']['max'] = $_SESSION['options']['max_orig'];
			}
		}
		
		if(!$_POST['submit'] && $_GET['get_count'] == 1 && !$_POST['pswrd']){
			error_reporting(E_ERROR);
			$all_count = getFolderCount($pathname);
		}else
			$all_count = trnslt('many');
	}
	
	if($_POST['ajax']){
		if($_POST['skipfiles'] == 0 && isset($_POST['dir'])){
			$allfiles_ajax = 0;
			if(is_array($_POST['dir'])){
				foreach($_POST['dir'] as $fldr){
					$allfiles_ajax += getFolderCount_for_ajax($pathname."/".$fldr);
				}
			} else{
				$allfiles_ajax += getFolderCount_for_ajax(($_POST['dir'])?($pathname."/".$_POST['dir']):$pathname);
			}
			if($allfiles_ajax > $_SESSION['options']['files_for_iteration'])
				echo "<div><span id='allfls'>".($allfiles_ajax-1)."</span></div>";
		}
		
		echo show_messages();
	} else {
?>
		<!DOCTYPE html>
		<html>
			<head>
				<META http-equiv="content-type" content="text/html; charset=utf-8" />
				<META NAME="Author" CONTENT="Lesyuk Sergiy">
				<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
				<title>Archiver</title>
				<style>
* { margin:0; padding:0; }
body { font:13px/18px Verdana, Arial, Tahoma, sans-serif; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; color:#FFF; width:100%; background:#39404C; overflow-y: scroll; }
input.archivatorstart { display: block; width:30%; }
legend { font-weight:bold; font-size:medium; }
.archivelog div { max-height:394px; overflow:auto; }
.progress { height:40px; width:100%; transition:all 2s ease 0; }
.kamicadze { color:#888888; margin-top:-30px; position:absolute; right:10px; text-decoration:none; }
.kamicadze:hover { text-decoration:underline; }
.kamicadze:active { color:#444444; }
.red { color:red; }
.green { color:green; }
.zip.clear { line-height: 52px; }
form.zip:hover { background:#E8E2D2; }
.right { float:right; margin-left:20px; }
.clear { clear:both; }
.logo { color:#888888; display:block; font-size:28px; text-decoration:none; text-shadow:0 0 1px #888888; transition:all .4s ease 0; float:left; padding:20px 20px 10px 0; transition: all 0.3s ease 0s; }
.logo:hover { color: #F1F1FF; text-shadow: 0 0 8px #FFFFFF; }
h2 { margin-bottom:20px; }
.section { clear:both; position:relative; box-shadow:0 5px 10px rgba(0,0,0,0.2); margin:0 0 20px; }
.section__headline { background: #E05C50; background: linear-gradient(#EF705F, #E05C50) repeat scroll 0 0 rgba(0, 0, 0, 0); box-shadow: 0 1px #F08C75 inset; font-size: 16px; padding: 8px 14px; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2); }
.section__headline.exeption > span:hover { cursor:pointer; text-shadow:0 0 0; }
.section__inner { color:#444444; padding:15px; background:#EFEFEF; }
.wrapper { max-width:894px; position:relative; margin:0 auto; }
label { cursor:pointer; display:inline-block; line-height:22px; }
select,input[type="text"],input[type="password"] { border:1px solid #C4C9D0; color:#646F81; padding:2px 5px; }
select { padding: 2px; }
select:focus,input[type="text"]:focus,input[type="password"]:focus { border:1px solid #8891A2; }
input[type="submit"] { height:34px; cursor:pointer; font:16px Verdana, Arial, sans-serif; border:none; color:#FFF; box-shadow:0 5px 10px rgba(0,0,0,0.3); text-shadow:1px 1px 1px rgba(0,0,0,0.2); padding:0 15px; background:#94CF58; background:linear-gradient(#94CF58,#85CA40); margin: 10px auto; }
input[type="submit"]:hover { background:linear-gradient(#A4DF68,#95DA50); }
input[type="submit"]:active { box-shadow:0 0 0!important; background: #85CA40; }
input[type="submit"][disabled="disabled"] { background: none repeat scroll 0 0 #888888; box-shadow: 0 0 0; }
.nav { float:right; box-shadow:0 5px 10px rgba(0,0,0,0.2); margin:-36px 0 20px; background-color: #646F81; }
.nav li { float:left; list-style:none; cursor:pointer; border-left:1px solid #515D6D; box-shadow:inset -1px 1px #6B7787; }
.nav li a,.nav li span { display:block; color:#E7EAED; text-decoration:none; padding:8px 12px; }
.nav li:first-child { border-left:none; }
.nav li:hover { color:#FFF; box-shadow:inset 0 1px #F08C75; background:#EF705F; background:linear-gradient(#EF705F,#E05C50); }
.nav li:active { box-shadow:inset 0 1px #F08C75; background:#E04C40; }
.nav li.active { box-shadow:inset 0 1px #6B7787; background:#4B525F; background:linear-gradient(#5B6475,#4B525F); }
.row:first-child { margin-top:0; }
.row:last-child { margin-bottom:0; }
.row { margin:10px 0; }
.messages { margin-top: 20px; }
.msg.w { background-color: #F13921; }
.msg.i { background-color: #4FC0E8; }
.msg.ok { background-color: #94CF58; }
.msg i { color:#FFF; line-height:15px; font-size:11px; text-align:center; position:absolute; left:12px; top:12px; display:inline-block; width:16px; height:16px; border:1px solid #FFF; }
.msg { box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2); line-height: 20px; margin: 0 0 20px; padding: 10px 0 10px 45px; position: relative; white-space: nowrap; }
.msg.process { padding: 6px; text-align: center; }
.msg.process > div { background-color: #62C4BF; box-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1) inset, 2px 2px 1px rgba(0, 0, 0, 0.4) inset; }
.msg.ok.progress { margin: 0; padding: 0; transition: all 4s ease 0s; box-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1) inset, 2px 2px 1px rgba(0, 0, 0, 0.4) inset; }
.flytext { font-size: 13px; margin: -29px auto; position: absolute; width: 100%; }
.tab.createar { padding-bottom: 40px; }
.footer { bottom:0; color:#AEB4BB; font-size:11px; left:0; width:100%; padding:8px 0; background:#2E333D; opacity:0.6; }
.footer a { color:#AEB4BB; }
.footer a:hover { color:#FFF; }
div.login { position:absolute; width:300px; margin:10% 0 0 10%; }
input.inside[type="submit"] { box-shadow: 0 1px 1px rgba(0, 0, 0, 0.3); float: right; margin: 8px; }
.page_gen { position:absolute; margin-top:-30px; }
.section__headline.exeption > span { cursor:pointer; }
.grey { color:grey; }
.file_mamger_table { width: 100%; }
.file_mamger_table tr td { padding: 2px 4px; }
.file_mamger_table tr:nth-child(even) td{ background-color: #E0E0E0; }
.file_mamger_table tr:hover td { background-color: #D0D0D0; }
.file_mamger_table .count, .file_mamger_table .size { width: 20%; text-align: right; }
				</style>
			</head>
			<body>
				<div class="wrapper">
					<a class="logo" href="<?=$url?>">ARCHIVER</a>
					<div class="clear"></div>
<?
					if($_SESSION['psswrd'] == $pass){
						$archive_exist = check_for_archive($pathname."/", $dirs);
?>
						<ul class="nav">
							<li id="createar" <?=(!$_GET['section'] || $_GET['section'] == 'createar')?'class="active"':''?> ><span><?=trnslt('create_arch')?></span></li>
							<li id="extractar" <?=($_GET['section'] == 'extractar')?'class="active"':''?> ><span><?=trnslt('extract_arch')?></span></li>
							<li id="filemananer" <?=($_GET['section'] == 'filemananer')?'class="active"':''?> ><span><?=trnslt('file_manager')?></span></li>
							<li id="options" <?=($_GET['section'] == 'options')?'class="active"':''?> ><span><?=trnslt('settings')?></span></li>
							<li><a href="<?=$url?>?logout=ok"><?=trnslt('exit')?></a></li>
						</ul>
						
						<div id="form_block">
							<div class="messages"><?=show_messages();?></div>
<?
							if(!$_GET['section'] || $_GET['section'] == 'createar'){
?>
								<div class="tab createar">
									<h2><?=trnslt('zipsite')?></h2>
<?
									if(count($_SESSION['history'])){
?>
										<div class="section">
											<div class="section__headline"><?=trnslt('zip_log')?>:</div>
											<div class="section__inner">
												<div class="row archivelog">
													<div>
														<?
															foreach($_SESSION['history'] as $line){
																echo $line."<br />";
															}
															$_SESSION['history'] = array();
														?>
													</div>
												</div>
											</div>
										</div>
<?
									}
?>
									<div class="section">
										<div class="section__headline"><?=trnslt('count_files')?>:</div>
										<div class="section__inner">
											<div class="row">
												<?=trnslt('full_files')?> <b><?=$all_count?></b>
												<input type="checkbox" id="get_count" name="get_count" value='1' <?=(!$_POST['submit'])?'checked="checked"':''?> onclick="if(get_count.checked)window.location='<?='//'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']?>'+'/?get_count=1'; else window.location='<?='//'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']?>'" />
												<?=trnslt('show_full_count_files')?><br />
											</div>
										</div>
									</div>
									
									<form action="<?=$url?>" method="POST">
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
													
													unset($_POST['exept'][array_search(".",$_POST['exept'])],$_POST['exept'][array_search("..",$_POST['exept'])]);
?>
												</div>
											</div>
										</div>
										
										<div class="section">
											<div class="section__headline"><?=trnslt('choose_dir')?>:</div>
											<div class="section__inner">
												<div class="row">
													<?=show_root_dir($pathname."/", $dirs);?>
													<div class="clear"><br /></div>
													<b><?=trnslt('enter_subdir')?></b>
													<input type="text" name="dir_write" value="<?=$_POST['dir_write']?>" style="width:99%" /> <br />
												</div>
											</div>
										</div>

										<div class="section">
											<div class="section__headline exeption"><?=trnslt('dir_exeption')?> "<span onclick="addEx(this)">upload</span>|<span onclick="addEx(this)">products_pictures</span>|<span onclick="addEx(this)">images</span>|<span onclick="addEx(this)">image_db</span>|<span onclick="addEx(this)">rss</span>|<span onclick="addEx(this)">gallery</span>|<span onclick="addEx(this)">uploads</span>|<span onclick="addEx(this)">cgi-bin</span>")</div>
											<div class="section__inner">
												<div class="row">
													<input type="text" name="exept" value="<?=implode("|",$_POST['exept'])?>" style="width:99%" />
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
										<div class="clear"></div>
										
										<!-- input class="archivatorstart" type="submit" name="submit" value="<?=trnslt('start')?>" -->
										<input class="archivatorstart" type="submit" name="submit" value="<?=trnslt('start')?>" onclick="startarchivation(); return false;" />
									</form>
								</div>
<?
							}elseif($_GET['section'] == 'extractar'){
?>
								<div class="tab extractar">
									<h2><?=trnslt('unziper')?></h2>
									<div class="section extractar">
										<div class="section__headline"><?=trnslt('zip_found')?>:</div>
										<div class="section__inner">
											<div class="row">
<?
												if(count($archive_exist)){
													foreach($archive_exist as $dir){
?>
														<form class="zip clear" enctype="multipart/form-data" action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
															<input class="selectedzip" type="radio" name="zipfile" value="<?=$dir?>" checked="checked" /> <span title="<?=number_format(filesize($pathname."/".$dir)/1024, 2, ".", " ")?> кб"><?=$dir?></span>
															<input class="right inside" type="submit" name="delzip" value="<?=trnslt('dell')?>" />
															<input class="right inside" type="submit" name="unzip" value="<?=trnslt('unzip')?>" />
															<div class="clear"></div>
														</form>
<?
													}
												} else {
													echo trnslt('zip_not_found');
												}
?>
											</div>
										</div>
									</div>
								</div>
<?
							}elseif($_GET['section'] == 'filemananer'){
?>
								<div class="tab filemananer">
									<h2><?=trnslt('file_manager')?></h2>
									<div class="section">
										<div class="section__headline"><?=trnslt('files_&_dirs_in')?> <?="/".$_GET['fmdir']?>:</div>
										<div class="section__inner">
											<div class="row">
												<?=show_root_dir_and_files($pathname.($_GET['fmdir']?("/".$_GET['fmdir']):'')."/", $_GET['fmdir']);?>
											</div>
										</div>
									</div>
								</div>
<?
							}elseif($_GET['section'] == 'options'){
?>
								<div class="tab options">
									<h2><?=trnslt('settings')?></h2>
									<div class="section">
										<div class="section__headline"><?=trnslt('language')?>:</div>
										<div class="section__inner">
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
								
									<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
										<div class="section">
											<div class="section__headline"><?=trnslt('show_log')?>:</div>
											<div class="section__inner">
												<div class="row">
														<input type="checkbox" name="show_ok" value='1' <?if($_SESSION['log']['OK']):?>checked="checked"<?endif;?> /> <?=trnslt('show_log_ok')?> |
														<input type="checkbox" name="show_notice" value='1' <?if($_SESSION['log']['NOTICE']):?>checked="checked"<?endif;?> /> <?=trnslt('show_log_notice')?> |
														<input type="checkbox" name="show_error" value='1' <?if($_SESSION['log']['ERROR']):?>checked="checked"<?endif;?> /> <?=trnslt('show_log_error')?>
													<div class="clear"></div>
												</div>
											</div>
										</div>
										
										<div class="section">
											<div class="section__headline"><?=trnslt('show_confirm_window')?>:</div>
											<div class="section__inner">
												<div class="row">
														<input type="checkbox" name="confirm_unzip" value='1' <?if($_SESSION['options']['confirm_unzip']):?>checked="checked"<?endif;?> /> <?=trnslt('unziping_arch')?> |
														<input type="checkbox" name="confirm_delzip" value='1' <?if($_SESSION['options']['confirm_delzip']):?>checked="checked"<?endif;?> /> <?=trnslt('deleting_arch')?>
													<div class="clear"></div>
												</div>
											</div>
										</div>
									
										<div class="section">
											<div class="section__headline"><?=trnslt('dont_zip_more')?>:</div>
											<div class="section__inner">
												<div class="row">
													<input type="text" name="max_size" value="<?=$_SESSION['options']['max_size']?>" /> кб
												</div>
											</div>
										</div>
										
										<div class="section">
											<div class="section__headline"><?=trnslt('zip_max_files_count')?>:</div>
											<div class="section__inner">
												<div class="row">
													<?=trnslt('from')?> <input type="text" name="min" value="<?=$_SESSION['options']['min']?>" />
													<?=trnslt('to')?> <input type="text" name="max" value="<?=$_SESSION['options']['max']?>" />
													<?=trnslt('limit')?> <input type="text" name="files_for_iteration" value="<?=$_SESSION['options']['files_for_iteration']?>" /><?=trnslt('ajax_load')?>
												</div>
											</div>
										</div>
										<input class="right " type="submit" name="log_submit" value='<?=trnslt('show_log_save')?>' />
										<div class="clear"></div>
									</form>
								</div>
<?
							}
?>
						</div>
						<script>
							var all_files = 0;
							var archive = "";
							var intrvl
							
							$(document).ready(function(){
								if($('body').height() > $(window).height()){
									$('.footer').removeAttr('style');
								}
							
								$('.nav li').click(function(){
									if(!$(this).hasClass('active')){
										window.location.href= '//<?=$_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"]."?section="?>'+$(this).attr('id');
									}
								});								
<?
								if($_SESSION['options']['confirm_delzip']){
?>
									$('.zip.clear input[name="delzip"]').click(function(){
										if (confirm('Ви дійсно хочете видалити цей архів?'))
											return true;
										else
											return false;
									});
<?
								}
								if($_SESSION['options']['confirm_unzip']){
?>
									$('.zip.clear input[name="unzip"]').click(function(){
										if (confirm('Ви дійсно хочете розархівувати цей архів?'))
											return true;
										else
											return false;
									});
<?
								}
?>
							});
							
							// Збір данних форми для архівування ----------------------------------------
							function collectdata(){
								var addtozip = "";					
								$('input.addtozip').each(function(){
									if($(this)[0].checked)
										addtozip = $(this).val();
								});
								
								var dir = "";
								var chk = 0;
								if($('input#alldir')[0].checked){
									chk = 1;
								}else{
									$('input.selecteddir').each(function(){
										if($(this)[0].checked){
											chk = 1;
											dir = dir+'|'+$(this).val();
										}
									});
									if(!chk){
										dir = chk;
									}
								}

								var dir_write = $('input[name=dir_write]').val();
								var exept = $('input[name=exept]').val();
								var submit = 'start';
								
								return {'addtozip' : addtozip, 'dir' : dir, 'dir_write' : dir_write, 'exept': exept, 'submit' : submit, 'ajax' : 'ajax', 'skipfiles' : '0'};
							}
							
							// Запуск аяксового запросу на архівацію ------------------------------------
							function postgo(sendata){
								if(!all_files){
									$('.messages').html('<div class="msg i process"><div><div class="msg ok progress" style="width: 0%;"></div><div class="flytext"><?=trnslt('zip_added_files')?> <span id="cntfls">0</span></div><div></div>');
								}
								
								var intrvl = setInterval(function(){ $('.messages #cntfls').html($('.messages #cntfls').html()+"."); }, 2000);
								
								$.ajax({
									type: "POST",
									url: "<?=$_SERVER["SCRIPT_NAME"]?>",
									data: sendata
								}).success(function (data) {
									clearInterval(intrvl);
									
									if(!all_files){
										all_files = parseInt($(data).find('#allfls').html());
										archive = $(data).find('#archv').html();
										sendata['addtozip'] = archive;
									}
									
									skipfiles = parseInt($(data).find('#cntfls').html());
									sendata['skipfiles'] = skipfiles;
									
									console.log(skipfiles, all_files, archive);
									
									if(skipfiles < all_files){
										$('.messages .progress').css('width', (100*skipfiles/all_files)+'%');
										$('.messages #cntfls').html(skipfiles);
										postgo(sendata);
									} else {
										$('.messages').html(data);
										$('.archivatorstart').removeAttr('disabled');
									}
								}).error(function () {
									console.log("Ошибка при получении данных");
								});
								
								
							}
							
							// Підготовка до архівації --------------------------------------------------
							function startarchivation(){
								$("html, body").animate({ scrollTop: 0 }, 100);
								$('.archivatorstart').attr('disabled', 'disabled');
								var skipfiles = 0;
								all_files = 0;
								archive = '';
								
								var sendata = collectdata();
								if(sendata['dir'] == '0'){
									delete sendata['dir'];
								}
								
								postgo(sendata);
							}
						</script>
<?
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
							if($_SESSION['pass_count'] > 0){
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
				</div>
				<div class="footer" style='position:absolute'>
					<div class="page_gen">
						<?=trnslt('page_gen')." ".round(microtime(1)-$timestart, 4)." ".trnslt('sec').".<br />"?>
					</div>
					<a class="kamicadze"  href="<?=preg_replace("/\?.+/",'',$url)?>?del=itself" title="<?=trnslt('kamikadze')?>"><?=trnslt('kamikadze')?></a>
					
					<div class="wrapper">
						<span style="float: left;">&copy; <?=date("Y")?> <b>ARCHIVER</b> <?=trnslt('develop')?> <u>Lesyuk Sergiy</u>. All Right Reserved.</span>
						<span style="float: right;"><?=trnslt('your_vers')?> <?=VERSION?></span>
						<div class="clear"></div>
					</div>
				</div>
			</body>
		</html>
<?
	}
?>