<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

function p($el)
{
    echo "<pre>";
    print_r($el);
    echo "</pre>";
}

// function upp()
// {
//     $arr = ["G", "б", "в", "г", "д", "е", "ё", "ж", "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы", "ь", "э", "ю", "я"];
//     foreach($arr as $key => $value)
//     {
//         echo "\"" . mb_strtoupper($value). "\", ";
//     }
//     echo mb_detect_encoding(mb_convert_encoding($arr, "UTF-8"));
// }
// upp();
// return;
$mytext = "ло\$х kadirov. !Сука P@idor, #";
// $mytext = str_replace(['\\','$'], ['', '\$'], $mytext);
$mytext = addslashes($mytext);
class Cipher
{
    // Из-за дополнительных знаков, у меня есть расхождения с оригинальной таблицей.
    public $alf = 
    [
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
        "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
        "а", "б", "в", "г", "д", "е", "ё", "ж", "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы", "ь", "э", "ю", "я",
        "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж", "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ы", "Ь", "Э", "Ю", "Я",
        ",", ".", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "-", "=", "+", ":", ";", "\"", "\'", "\\", "|", "/", "?", "{", "[", "}", "]", "<", ">",
        "0", "1", "2", "3", "4", "5" ,"6", "7", "8", "9"
    ];
    public $secret_to_array = [];
    public $mirrored_secret_array = [];
    public $text = [];
    public $text_array = [];
    public $word_ciphered_decipehered = [];
    public $cursor;
    public $word;
    public $count_alf;
    public $count_word;
    public $count_text_array;
    public $count_secret_to_array;

    public function __construct()
    {

    }
    public function cipDecip($text, $secret_word, $variant)
    {
        $this->text = [];
        $this->text_array = explode(" ", $text);
        $this->secret_to_array = str_split($secret_word);
        $this->count_alf = count($this->alf);
        $this->count_text_array = count($this->text_array);
        $this->count_secret_to_array = count($this->secret_to_array);
        $this->cursor = 0;

        foreach($this->text_array as $key => $value)
        {
            $this->mirrored_secret_array = [];
            $this->word_ciphered_decipehered = [];
            $this->word = [];

            $count_word = mb_strlen($value);
            for($i = 0; $i < $count_word; $i++)
            {
                $this->word[] = mb_substr($value, $i, 1, "UTF-8");
            }
            // echo count($this->word);
            // echo "<h4>current word $value</h4>";
            foreach($this->word as $k => $v)
            {
                if($this->cursor == $this->count_secret_to_array)
                {
                    $this->cursor = 0;
                    $this->mirrored_secret_array[] = $this->secret_to_array[$this->cursor];
                    $this->cursor++;
                }
                else
                {
                    $this->mirrored_secret_array[] = $this->secret_to_array[$this->cursor];
                    $this->cursor++;
                }
                
            }

            // echo "secret: " . implode("", $this->mirrored_secret_array);
            $this->count_word = count($this->word);
            // p($this->word);
            // echo $this->count_word;
            switch($variant)
            {
                case 1:
                    for($i = 0; $i < $this->count_word; $i++)
                    {
                        // пояснительная бригада
                        // смотрим в таблицу
                        // находим пересечение букв (для проверки)
                        // находим значение ключа в массиве для секретной буквы и оригинальной
                        // их сумма будет позицией ключа для новой шифрованной буквы
                        $ind = array_search($this->mirrored_secret_array[$i], $this->alf); // find secret letter index
                        $myind = array_search($this->word[$i], $this->alf); // find my text letter index
                        $sum_ind = ($ind + $myind) % $this->count_alf;

                        // p("ind " . $ind . ", myind " . $myind . ", sum_ind " . $sum_ind.  ", letter " . $this->alf[$sum_ind]);

                        $this->word_ciphered_decipehered[] = $this->alf[$sum_ind];
                    }
                break;
                case 2:
                    for($i = 0; $i < $this->count_word; $i++)
                    {
                        // пояснительная бригада
                        // смотрим в таблицу
                        // находим пересечение секретной и зашифрованной букв 
                        // их разница позиций ключей в массиве будет позицией ключа для оригинальной буквы
                        $ind = array_search($this->mirrored_secret_array[$i], $this->alf); // find secret letter index
                        $myind = array_search($this->word[$i], $this->alf); // find my text letter index
                        $sum_ind = ($this->count_alf - $ind + $myind) % $this->count_alf;
                        
                        // p("ind " . $ind . ", myind " . $myind . ", sum_ind " . $sum_ind.  ", letter " . $this->alf[$sum_ind]);
                        
                        $this->word_ciphered_decipehered[] = $this->alf[$sum_ind];
                    }
                break;
                default:
                echo "def";
            }
            $this->text[] = implode("", $this->word_ciphered_decipehered);
        }
        return implode(" ", $this->text);
    }
}
$request = $_POST;

$obj = new Cipher();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Machine Learning Workshop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1"/>
    <script src=""></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="" rel="stylesheet" />
</head>
<body>
<div class="container mt-3">
<form action="" method="post" class="row g-3">
<div class="form-check">
  <input class="form-check-input" type="radio" name="cipdecip" id="flexRadioDefault1" value="2">
  <label class="form-check-label" for="flexRadioDefault1">
    Дешифрование
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="cipdecip" id="flexRadioDefault2" checked value="1">
  <label class="form-check-label" for="flexRadioDefault2">
    Шифрование
  </label>
</div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Ключевое слово</label>
        <input name="key_word" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ключевое слово" required>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Текст</label>
        <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-primary mb-3">
    </div>
</form>
</div>
<div class="container">
    <h3>Результат:</h3>
    <div class="mb-3">
        <?php echo ($_POST["cipdecip"] == 1) ? $obj->cipDecip($request["text"], $request["key_word"], 1) : $obj->cipDecip($request["text"], $request["key_word"], 2) ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src=""></script>
</body>
</html>
