<?php
session_start();

if(!$_SESSION["user_uid"]) $_SESSION["user_uid"] = rand(0, 10000) . "_" . time();

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <!-- <script src="https://kit.fontawesome.com/a062562745.js" crossorigin="anonymous"></script> -->
        <title>MP3 Player</title>
        <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="style.css" media=all> 
        <link rel="icon" type="image/x-icon" href="/img/playicon32.png">
        <!-- <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css"> -->

    </head>
<body>

<div id="wrapper">






<audio id="myAudio">
  <!-- <source src="audio.ogg" type="audio/ogg"> -->
  <source id="source-audio" src="" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>

<div class="player-ctn">
  <div class="infos-ctn">
    <div class="timer" id="timer">00:00</div>
    <div class="title" id="title_div"><span id="title"></span></div>
    <div class="duration" id="duration">00:00</div>
  </div>
  <div id="progress-bar">
    <div id="my-bar"></div>
  </div>
  <div class="btn-ctn">
     <div class="btn-action first-btn" onclick="previous()">
        <div id="btn-faws-back">
          <i class='fa fas fa-step-backward'></i>
        </div>
     </div>
     <div class="btn-action" onclick="rewind()">
        <div id="btn-faws-rewind">
          <i class='fa fas fa-backward'></i>
        </div>
     </div>
     <div class="btn-action" id="btn-play">
        <div id="btn-faws-play-pause">
          <i class='fa fas fa-play' id="icon-play"></i>
          <i class='fa fas fa-pause' id="icon-pause" style="display: none"></i>
        </div>
     </div>
     <div class="btn-action" onclick="forward()">
        <div id="btn-faws-forward">
          <i class='fa fas fa-forward'></i>
        </div>
     </div>
     <div class="btn-action" onclick="next()">
        <div id="btn-faws-next">
          <i class='fa fas fa-step-forward'></i>
        </div>
     </div>
     <div class="btn-mute" id="toggleMute" onclick="toggleMute()">
        <div id="btn-faws-volume">
          <i id="icon-vol-up" class='fa fas fa-volume-up'></i>
          <i id="icon-vol-mute" class='fa fas fa-volume-down' style="display: none"></i>
        </div>
     </div>
     <div class="btn-volume">
        <input id="range-volume" type="range" value="100">
     </div>
  </div>
  <div class="playlist-ctn" id="playlist-ctn"></div>
</div>
<div id="container">
    <div id="menu">
        <div class="menu__element" id="menu__search">
            <i class="fa fa-search m_e" aria-hidden="true"></i>
        </div>
        <div class="menu__element" id="menu__favorite">
            <i class="fa fa-star-o m_e" aria-hidden="true" ></i>
        </div>
        <div class="menu__element" id="menu__add">
        <i class="fa fa-plus m_e" aria-hidden="true"></i>
        </div>
    </div>
    <div id="content">
        <div id="content-inner">
            <div id="content__actions"></div>
            <div id="content__results"></div>
            <div id="content__animation"></div>
          </div>  
        </div>
    </div>
</div>

</div>
<script src="script.js"></script>

</body>
</html>
