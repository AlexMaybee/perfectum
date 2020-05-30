<?php

require_once 'Db.php';

$db = DB::init();

function debug($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}


/**
 * 1. Tables
 */


/*
 * 1.1. Users
 * */

$sql11 = "CREATE TABLE IF NOT EXISTS user (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL
);";

//debug($db->connect->exec($sql11));

//$sql11Test = "INSERT INTO user (`name`,`lastname`) VALUES ('Alex','A'),('Vova','V'),('KOLYA','K')";
//debug($db->connect->exec($sql11Test));

/*
 * 1.2. Chats
 * */
$sql12 = "CREATE TABLE IF NOT EXISTS chat (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR (50) DEFAULT NULL,
create_by INT(11) NOT NULL,
date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";

//debug($db->connect->exec($sql12));

//$sql12Test = "INSERT INTO chat (`create_by`) VALUES (1),(3)";
//debug($db->connect->exec($sql12Test));


/*
 * 1.3 Chats for users
 * */
$sql13 = 'CREATE TABLE IF NOT EXISTS user_chat_settings (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id INT(11) NOT NULL,
chat_id INT(11) NOT NULL,
is_active TINYINT(1) DEFAULT 1,
date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
date_time_update TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
);';
//debug($db->connect->exec($sql13));

//$sql13Test = "INSERT INTO user_chat_settings (user_id,chat_id) VALUES (1,1),(3,1)";
//$sql13Test = "INSERT INTO user_chat_settings (user_id,chat_id) VALUES (1,2),(3,2),(2,2)";
//debug($db->connect->exec($sql13Test));


/*
 * 1.4. Messages
 * */
$sql14 = "CREATE TABLE IF NOT EXISTS chat_message(
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
chat_id INT(11) NOT NULL,
create_by INT(11) NOT NULL,
message TEXT NOT NULL,
reply_to_message INT(11) DEFAULT NULL,
delete_for JSON DEFAULT NULL,
date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
date_time_update TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
);";
//debug($db->connect->exec($sql14));

//++++++++++++ chat 1 +++++++++++++++++++++
//$sql14Test = "INSERT INTO chat_message (chat_id,create_by,message) VALUES (1,1,'Сообщение 1 тест')";
//$sql14Test = "INSERT INTO chat_message (chat_id,create_by,message) VALUES (1,2,'И тебе привет!')";
//$sql14Test = "INSERT INTO chat_message (chat_id,create_by,message) VALUES (1,2,'Как у тебя дела?')";
//++++++++++++ chat 2 +++++++++++++++++++++
//$sql14Test = "INSERT INTO chat_message (chat_id,create_by,message) VALUES (2,3,'Врем привееет!')";
//$sql14Test = "INSERT INTO chat_message (chat_id,create_by,message) VALUES (2,3,'Как настроение?')";
//$sql14Test = "INSERT INTO chat_message (chat_id,create_by,message) VALUES (2,2,'Ну такое....')";
//$sql14Test = "INSERT INTO chat_message (chat_id,create_by,message) VALUES (2,1,'Бывало и лучше!')";
//debug($db->connect->exec($sql14Test));


/*
 * 2. Message Create
 * */

$messageArray = [
    'chat_id' => 2,
    'create_by' => 2,
    'message' => 'Сообщение Общий ответ всем',
    'reply_to_message' => 4,
];

$sql2 = 'INSERT INTO chat_message (chat_id,create_by,message,reply_to_message) VALUES (:chat_id,:create_by,:message,:reply_to_message)';
//debug($db->put($sql2,$messageArray));


/*
 * 3. Chat history
 * */

$sql3 = 'SELECT chat_message.*, CONCAT(user.lastname," ", user.name) as user FROM chat_message 
 LEFT JOIN user ON user.id = chat_message.create_by
 WHERE chat_message.chat_id = :chat_id ORDER BY date_time';
//debug($db->getAll($sql3,['chat_id' => 2],true)); //перемещаем id сообщения в ключ

/*
 * 4. Chat list
 * */
$currentUserId = 3;
//$sql4 = 'SELECT user_chat_settings.* FROM user_chat_settings WHERE user_chat_settings.user_id = :user_id';


//$sql4 = 'SELECT chat_message.*, chat_message.chat_id, chat_message.message, chat_message.date_time FROM chat_message WHERE chat_message.chat_id IN (SELECT chat_id FROM user_chat_settings WHERE user_id = 1) ORDER BY chat_message.date_time';

//$sql4 = 'SELECT DISTINCT chat_message.id, chat_message.chat_id, chat_message.message, chat_message.date_time, CONCAT(user.name," ",user.lastname) as user_name,
//chat.name as chat_name, chat.id as chat_main_id
//FROM chat_message
//LEFT JOIN user_chat_settings ON user_chat_settings.user_id = chat_message.create_by
//LEFT JOIN user ON user.id = chat_message.create_by
//LEFT JOIN chat ON chat.id = chat_message.chat_id
//WHERE chat_message.chat_id
//  IN (SELECT user_chat_settings.chat_id FROM user_chat_settings WHERE user_chat_settings.user_id = 3)
//ORDER BY chat_message.date_time
//';
//debug($db->getAll($sql4,['user_id' => $currentUserId]));


/*4.1 Чаты, названия чатов*/
$sqlChats = '
SELECT user_chat_settings.chat_id,user_chat_settings.is_active, chat.name as chat_name, chat.create_by as chat_chief
FROM user_chat_settings
LEFT JOIN chat ON user_chat_settings.chat_id = chat.id
WHERE user_chat_settings.user_id = :user_id
';
//debug($db->getAll($sqlChats,['user_id' => $currentUserId]));


$chat_ids = []; //id чатов для получения сообщений
$chat_final_arr = [];

$lol = $db->connect->prepare($sqlChats);
$lol->bindParam(':user_id',$currentUserId);
if($lol->execute())
{
    while($ob = $lol->fetch())
    {
        $chat_ids[] = $ob['chat_id'];
        $chat_final_arr[$ob['chat_id']] = $ob;
    }
}

//debug($chat_final_arr);
//debug($chat_ids);

/*4.2 Получение сообщений, подчет и пользователи*/
$sqlMessages = '
SELECT chat_message.*, CONCAT(user.name," ",user.lastname) as username
FROM chat_message
LEFT JOIN user ON user.id = chat_message.create_by
WHERE chat_message.chat_id IN ('.implode(",",$chat_ids).')
ORDER BY date_time DESC
';

//формируем общий массив
$lol2 = $db->connect->prepare($sqlMessages);
if($lol2->execute())
{
    while($ob2 = $lol2->fetch())
    {
        if(array_key_exists($ob2['chat_id'],$chat_final_arr))
        {
            $chat_final_arr[$ob2['chat_id']]['messages_num']++;
            $chat_final_arr[$ob2['chat_id']]['messages'][$ob2['id']] = $ob2;
        }
    }
}

//Результат
//debug($chat_final_arr);

/*
 * 5. Del message
 * */
$id = 9;
$sql5 = 'DELETE FROM chat_message WHERE id = :id;';
//$lol3 = $db->connect->prepare($sql5);
//$lol3->bindParam(':id',$id);
//debug($lol3->execute());

/*
 * 6. Clear History
 */
$chat_id = 3;
$sql6 = 'DELETE FROM chat_message WHERE chat_id = :chat_id;';
//$lol6 = $db->connect->prepare($sql6);
//$lol6->bindParam(':chat_id',$chat_id);
//debug($lol6->execute());