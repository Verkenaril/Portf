<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

function p($el)
{
    echo "<pre>";
    print_r($el);
    echo "</pre>";
}

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
<form action="/results.php" method="post" class="row g-3">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src=""></script>
</body>
</html>
