<?php

/*******************************************************Database******************************************************/

//define('DB_NAME', 'simple_blog');
//define('DB_USER', 'root');
//define('DB_PASSWORD', '');

/********************************************************Errors*******************************************************/

define('ARTICLE_NOT_FOUND', 'Ошибка 404. Нет такой статьи!');
define('ARTICLE_SAVE_ERROR', 'Ошибка сохранения статьи');
define('FILL_IN_ALL_FIELDS', 'Заполните все поля!');

define('SUCCESSFULLY_SAVED', 'Успешно сохранено');

define('EDIT_DENIED', 'Внимание! Вам нельзя редактировать эту статью!');
define('PERMISSION_DENIED_ERROR', 'ERROR 403 - PERMISSION DENIED!!!');


// Authorization errors
define('INVALID_LOGIN_OR_PASSWORD', 'Неверный логин или пароль!');
define('NOT_AUTHORIZED', 'Для просмотра ресурса необходима авторизация!');


/******************************************************Views*********************************************************/


define('TITLE_404', 'Ошибка 404');
define('ERROR_404', 'Ошибка 404. Попробуйте начать с главной');
define('TITLE_LOGIN', 'Авторизация');
define('TITLE_REGISTER',  'Регистрация');
define('ADD_ARTICLE_TITLE', 'Добавить статью');
define('DASHBOARD_PAGE_TITLE', 'Личный кабинет');
define('ROOT', '/ornek_mvc');

define('PAGE_NOT_FOUND', 'Ошибка 404 - страница не найдена!');

/**************************************************One entry point****************************************************/


define('DASHBOARD_TEMPLATES_MAP', [
    'home' => 'home.php',
    'texts' => 'texts/index.php'
]);

define('TEXTS_TEMPLATES_MAP', [
    'all' => 'all_texts.php',
    'edit' => 'edit.php'
]) ;
