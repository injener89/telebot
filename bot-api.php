<?php
/*$API_KEY = '187767986:AAFLK_h8SMMG1mH8cDS64xfE5Lb6LRyo2vU';
$url = 'https://api.telegram.org/bot'.$API_KEY;
$update = file_get_contents($url."/getupdates");
$updateArray = json_decode($update,TRUE);

$chatId = $updateArray["result"][0]["message"]["chat"]["id"];

$update = file_get_contents($url."/sendMessage?chat_id=".$chatId."&text=Maxalchik");
*/
/**
 * Telegram Bot access token и URL.
 */
$access_token = '187767986:AAFLK_h8SMMG1mH8cDS64xfE5Lb6LRyo2vU';
$api = 'https://api.telegram.org/bot' . $access_token;

/**
 * Задаём основные переменные.
 */
$output = json_decode(file_get_contents('php://input'), TRUE);
$chat_id = $output['message']['chat']['id'];
$first_name = $output['message']['chat']['first_name'];
$message = $output['message']['text'];

/**
 * Emoji для лучшего визуального оформления.
 */
$emoji = array(
  'preload' => json_decode('"\uD83D\uDE03"'), // Улыбочка.
  'weather' => array(
    'clear' => json_decode('"\u2600"'), // Солнце.
    'clouds' => json_decode('"\u2601"'), // Облака.
    'rain' => json_decode('"\u2614"'), // Дождь.
    'snow' => json_decode('"\u2744"'), // Снег.
  ),
);

/**
 * Получаем команды от пользователя.
 */  
switch($message) {
  // API погоды предоставлено OpenWeatherMap.
  // @see http://openweathermap.org
  case '/pogoda':
    // Отправляем приветственный текст.
    $preload_text = 'Одну секунду, ' . $first_name . ' ' . $emoji['preload'] . ' Я уточняю для вас погоду..';
    sendMessage($chat_id, $preload_text);
    // API key для OpenWeatherMap.
    // Формирование ответа.
    $weather_text = 'Сейчас в Ташкенте. Температура воздуха: 31°C. Ветер  10м/сек.';
    // Отправка ответа пользователю Telegram.
    sendMessage($chat_id, $weather_text);
    break;
    case 'Ne':
    $weather_text = 'Атан басы козявка';
    // Отправка ответа пользователю Telegram.
    sendMessage($chat_id, $weather_text);
    break;
  default:
    break;
}  


/**
 * Функция отправки сообщения sendMessage().
 */
function sendMessage($chat_id, $message) {
  file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message));
}
