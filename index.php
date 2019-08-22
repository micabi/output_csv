<?php

$csvFile = './data.csv';

$datas = [
  array('名前', '身長', '体重', '年齢', '性別'),
  array('jack', '164', '67', '43', 'male'),
  array('mikky', '164', '69', '37', 'female'),
  array('mika', '310', '12', '10', 'female'),
  array('karu', '97', '11', '9', 'female')
];

$fp = fopen($csvFile, 'ab'); // ファイルを開く(ファイルパス, モード)

flock($fp, LOCK_EX); // 排他的ロック

//ftruncate($fp, 0);

foreach ($datas as $data) {
  $line = implode(',', $data); // 配列を文字列として連結
  fwrite($fp, $line."\n" ); // data.csvに, $line(1レコード) + 改行を書き込み
}

fflush($fp); // バッファを開放
flock($fp, LOCK_UN); // ロック解除

fclose($fp); // ファイルを閉じる

if (file_exists($csvFile)) {
  echo "データはcsvファイルとして保存されました。<br>";
  echo "保存されたファイルは(" . $csvFile .")です。<br>";
  $csv = file_get_contents($csvFile);
  echo "---------------------------------<br>";
  echo nl2br( htmlspecialchars($csv , ENT_QUOTES, 'UTF-8'), false);
}else{
  echo "データは保存されませんでした。";
}