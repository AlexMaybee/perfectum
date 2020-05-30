<?php

require_once 'Db.php';

$db = DB::init();

function debug($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}


/*
 * 1. Add tables
 * */

/*
 * 1.1 Users
 * */


$sql11 = "CREATE TABLE IF NOT EXISTS user (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL
);";
//debug($db->connect->exec($sql11));

/*
 * 1.2. Chats
 * */
$sql12 = "CREATE TABLE IF NOT EXISTS chat (
id TINYINT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
participant JSON NOT NULL,
date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";
//debug($db->connect->exec($sql12));

/*
 * 1.3. Messages
 * */
$sql13 = "CREATE TABLE IF NOT EXISTS chat_text(
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
chat_id TINYINT(6) NOT NULL,
create_by INT(11) NOT NULL,
message TEXT NOT NULL,
date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
//debug($db->connect->exec($sql13));


/*
 * 1.4 Create users
 * */
$sql14 = "INSERT INTO user (`name`) VALUES ('Alex'),('Vova')";
//debug($db->connect->exec($sql14));
//$testSql14 = 'SELECT * FROM user WHERE id = :id LIMIT 1';
//$test14Res = $db->getOne($testSql14,['id' => 1]);
//debug($test14Res);
//debug(gettype($test14Res['id']));


/*
 * 1.5 Создание чата
 * */
$users = json_encode(['users' => ['1','2','3']]);

$current_user_id = 1;

$sql15 = "INSERT INTO chat (participant) VALUES ('".$users."');";
//debug($users);
//debug($db->connect->exec($sql15));

//$testSql15 = "SELECT chat.id, chat.date_time as date, chat.participant->>'$.users' as users FROM chat WHERE JSON_CONTAINS(`participant`,JSON_OBJECT('users','{$current_user_id}'))";
//debug($db->getAll($testSql15));

/*
 * 2. Создание сообщения
 * */
$messageArray = [
    'chat_id' => 2,
    'create_by' => $current_user_id,
    'message' => 'Сообщение Общий ответ всем',
];

//$sql2 = 'INSERT INTO chat_text (chat_id,create_by,message) VALUES (:chat_id,:create_by,:message)';
//debug($db->put($sql2,$messageArray));

/*
 * 3. История переписки
 * */
$chat_id = 1;
//$sql3 = 'SELECT * FROM chat_text WHERE chat_id = :chat_id ORDER BY date_time ASC';
//debug($db->getAll($sql3,['chat_id' => $chat_id]));

/*
 * 4. Список всех диалогов
 * */

/*
 * 4.1. Получение всех чатов пользователя
 * */
$cur_user_id = 1;
//$sql4 = "SELECT chat.id, chat.date_time as date, chat.participant->>'$.users' as users FROM chat WHERE JSON_CONTAINS(`participant`,JSON_OBJECT('users','{$cur_user_id}'))";
$sql4 = "SELECT chat.id, chat.date_time as date, chat.participant->>'$.users' as users, 
(SELECT * FROM chat_text WHERE chat_text.chat_id = chat.id) as test
FROM chat WHERE JSON_CONTAINS(`participant`,JSON_OBJECT('users','{$cur_user_id}'))";

$obj = $db->connect->prepare($sql4);
if($obj->exec())
    debug($obj);

//$user_chats = $db->getAll($sql4);
//debug($user_chats);

/*
 * 4.2. Получение массива имен пользователей
 * */
if($user_chats)
{
    $final_arr = [];

    $chatFilterArr = [];
    $usersFilterArr = [];
    foreach ($user_chats as $chat)
    {
        $chatFilterArr[] = $chat['id'];
        $usersFilterArr = array_merge($usersFilterArr,json_decode($chat['users']));
    }
//    debug(array_unique($usersFilterArr));

    /*
     * Массив пользователей в виде ключ = имя
     * */
    $sql42 = 'SELECT * FROM user WHERE id IN ('.implode(',',array_unique($usersFilterArr)).') ORDER BY id';

    $users = [];
    $obj = $db->connect->prepare($sql42);
    if($obj->execute())
    {
        while($row = $obj->fetch())
        {
            $users[$row['id']] = $row['name'];
        }
    }
//    debug($db->getAll($sql42));

    /*
     * Массив собщений
     * */
    $sql43 = 'SELECT * FROM chat_text WHERE chat_id IN ('.implode(',',$chatFilterArr).') ORDER BY id LIMIT 100';
//    debug($db->getAll($sql43));
    $messages = [];
    $obj = $db->connect->prepare($sql43);
    if($obj->execute())
    {
        while($rowM = $obj->fetch())
        {
            $rowM['user_name'] = $users[$rowM['create_by']];

            foreach ($user_chats as &$chat)
            {
                if($chat['id'] == $rowM['chat_id'])
                {
                    $chat['messages'][] = $rowM;
                }
                    $final_arr[$chat['id']] = $chat;
            }
        }
    }


//    debug($chatFilterArr);
    debug($users);
    debug($final_arr);


//    usort($final_arr,function($){

//    });

}