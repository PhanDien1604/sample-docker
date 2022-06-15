<!DOCTYPE html>
<html>
<body>
    <?php
        function checkValidString($text) {
            if (0 == strlen(strstr($text, 'book')) && 0 < strlen(strstr($text, 'restaurant'))) {
                return true;
            }
            if (0 < strlen(strstr($text, 'book')) && 0 == strlen(strstr($text, 'restaurant'))) {
                return true;
            }
            return false;
        }
        // file1
        echo '<h3>File 1</h3>';
        $file1 = @fopen('file1.txt', 'r');
        
        $text = fread($file1, filesize('file1.txt'));

        $check = checkValidString($text);
        
        if($check) {
            $count_sentences = substr_count($text,'.');
            echo 'Chuỗi hợp lệ. Chuỗi bao gồm ' .$count_sentences. ' câu';
        } else {
            echo 'Chuỗi không hợp lệ';
        }
        fclose($file1);

        
        // file 2
        echo '<h3>File 2</h3>';
        $file2 = @fopen('file2.txt', 'r');
        
        $text = fread($file2, filesize('file1.txt'));
        
        $check = checkValidString($text);

        if($check) {
            $count_sentences = substr_count($text,'.');
            echo 'Chuỗi hợp lệ. Chuỗi bao gồm ' .$count_sentences. ' câu';
        } else {
            echo 'Chuỗi không hợp lệ';
        }
        fclose($file2);
    ?>

</body>
</html>