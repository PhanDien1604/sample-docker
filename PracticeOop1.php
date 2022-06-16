<?php
class ExerciseString {
    //property
    public $check1;
    public $check2;

    public function readFile($path, $mode) {
        $file = @fopen($path,$mode);
        $text = fread($file, filesize($path));
        fclose($file);
        return $text;
    }
    public function checkValidString($text) {
        if (0 == strlen(strstr($text, 'book')) && 0 < strlen(strstr($text, 'restaurant'))) {
            return true;
        }
        if (0 < strlen(strstr($text, 'book')) && 0 == strlen(strstr($text, 'restaurant'))) {
            return true;
        }
        return false;
    }
    public function writeFile($path, $mode, $result) {
        $file = @fopen($path,$mode);
        fwrite($file, $result);
        fclose($file);
    }
}

$object1 = new ExerciseString();
//check1
$text1 = $object1->readFile('file1.txt','r');
$object1->check1 = $object1->checkValidString($text1);
if($object1->check1) {
    $result = 'check1 là chuỗi "'.$text1.'". Hợp lệ';
} else {
    $result = 'check1 là chuỗi "'.$text1.'". Không hợp lệ';
}
$result .= ' <br> ';
//check2
$text2 = $object1->readFile('file2.txt','r');
$object1->check1 = $object1->checkValidString($text2);
if($object1->check2) {
    $result = $result.'check2 là chuỗi "'.$text2.'". Chuỗi có '.$count_sentences.' câu . Hợp lệ';
} else {
    $result = $result.'check2 là chuỗi "'.$text2.'". Chuỗi có '.$count_sentences.' câu . Không hợp lệ';
}
echo $result;

$object1->writeFile('result_file.txt', 'w', $result);

?>