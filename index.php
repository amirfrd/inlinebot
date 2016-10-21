<?php
ob_start();
define('API_KEY','134334988:AAHvnblCY5GpErXfhWPm5VWvm84Fsi2Yffo');
//function to send with curl its need php 5.5 or upper
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$up = json_decode(file_get_contents('php://input'),true);//get updates from webhook
//file_put_contents('a.txt',json_encode($up));//save update in a.txt file
$msg = $up['message'];//get update type message
$callback = $up['callback_query'];//get update type callback_query
$inline = $up['inline_query'];//get update type inline_query

if(isset($msg)){
  //send it message 
  bot('sendMessage',array('chat_id'=>$msg['from']['id'],'text'=>'not found'));
}elseif(isset($callback)){
  //ansewr message typed callback
}elseif(isset($inline)){
  //answer as inline
  echo 'QUERY ...';
  bot('answerInlineQuery',[
      'inline_query_id'=>$up['inline_query']['id'],
      'cache_time' => 1,
      'results'=>json_encode([
        [
          'type'=>'photo',
          'id'=>base64_encode(1),
          'title'=>'لیست کانال های امشب',
          'photo_file_id'=>'AgADBAAEsjEb_Ra1BJEzAsUMDbd3FwNmGQAEFZisHrhQ6vw2DgIAAQI',
          'caption'=>"test \n @Amir_Dev",
          'reply_markup'=>[
            'inline_keyboard'=>[
              [
                ['text'=>'monster','url'=>'monsterbot.ir']
              ]
            ]
          ]
        ],
        [
          'type'=>'photo',
          'id'=>base64_encode(2),
          'title'=>'لیست کانال های امشب',
          'photo_file_id'=>'AgADBAAEsjEb_Ra1BJEzAsUMDbd3FwNmGQAEFZisHrhQ6vw2DgIAAQI',
          'caption'=>"test \n @Amir_Dev",
          'reply_markup'=>[
            'inline_keyboard'=>[
              [
                ['text'=>'Nort','url'=>'nort.ir']
              ]
            ]
          ]
        ],
        [
          'type'=>'photo',
          'id'=>base64_encode(3),
          'title'=>'لیست کانال های امشب',
          'photo_file_id'=>'AgADBAAEsjEb_Ra1BJEzAsUMDbd3FwNmGQAEFZisHrhQ6vw2DgIAAQI',
          'caption'=>"test \n @Amir_Dev",
          'reply_markup'=>[
            'inline_keyboard'=>[
              [
                ['text'=>'api monster','url'=>'api.monsterbot.ir'],['text'=>'amir','url'=>'google.com']
              ],
              [
                ['text'=>'api monster','url'=>'api.monsterbot.ir'],['text'=>'amir','url'=>'google.com']
              ],
              [
                ['text'=>'api monster','url'=>'api.monsterbot.ir'],['text'=>'amir','url'=>'google.com']
              ]
            ]
          ]
        ]
      ])
    ]);
}

