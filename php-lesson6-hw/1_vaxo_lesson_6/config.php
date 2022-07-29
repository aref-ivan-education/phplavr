<?php
const DSN = 'mysql:host=localhost;dbname=nt_blog';
const DB_USER = 'root';
const DB_PASSWORD = '';

const REDIRECT_PATH = 'index.php';
const SECRET = 'T,J~@jfsf69+f8S*';

const TITLE_MAX = 50;
const TITLE_MIN = 3;
const CONTENT_MAX = 100;
const CONTENT_MIN = 5;
const LOGIN_MAX = 32;
const LOGIN_MIN = 5;
const PASSWORD_MAX = 100;
const PASSWORD_MIN = 8;

const NOT_ALLOWED_IN_ID = '/[^0-9]/';
const NOT_ALLOWED_IN_TITLE = '/[^0-9a-z- ]/i';
const NOT_ALLOWED_IN_LOGIN = '/[^0-9a-z- ]/i';
const NOT_ALLOWED_IN_CONTENT = '/[^0-9a-z-\s\p{P}]/i';

const ERROR_LOGIN_PASSWORD = 'Login or password incorrect!';

const ERROR_ARTICLE_EXISTENCE =  'Error 404. Such article does not exist!';

const ERROR_PARAM_GIVEN =  'Parameter not given!';
const ERROR_PARAM_EMPTY = 'Empty parameter!';
const ERROR_PARAM_INCORRECT = 'Incorrect param!';

const ERROR_TITLE_GIVEN =  'Title does not given!';
const ERROR_TITLE_EMPTY = 'Empty title!';
const ERROR_TITLE_SHORT = 'Too short title!';
const ERROR_TITLE_BIG = 'Too long title!';

const ERROR_CONTENT_GIVEN =  'Content does not given!';
const ERROR_CONTENT_EMPTY = 'Empty content!';
const ERROR_CONTENT_SHORT = 'Too short content!';
const ERROR_CONTENT_BIG = 'Too long content!';

const ERROR_LOGIN_GIVEN =  'Login does not given!';
const ERROR_LOGIN_EMPTY = 'Empty login!';
const ERROR_LOGIN_SHORT = 'Too short login!';
const ERROR_LOGIN_BIG = 'Too long login!';
const ERROR_LOGIN_INCORRECT = 'Incorrect login!';

const ERROR_PASSWORD_GIVEN =  'Password does not given!';
const ERROR_PASSWORD_EMPTY = 'Empty password!';
const ERROR_PASSWORD_SHORT = 'Too short password!';
const ERROR_PASSWORD_BIG = 'Too long password!';
const ERROR_NECESSARY_SIMBOLS = 'Password must contain necessary symbols!';

?>