// проблемы
// задачи

// при добавлении нового плеера нужно создать:
// 1. новую переменную с трэками
// 2. новую переменную с "айди" и другими элементами
// 3. вызвать функцию отрисовки
// 4. навесить события на песни

let list1 =
[
    {
        id: 0,
        name: "Пропаганда - Мелом",
        file: "files/Пропаганда - Мелом.mp3",
        duration: "03:24"
    },
    {
        id: 8,
        name: "Юные смешные голоса",
        file: "files/Юные смешные голоса.mp3",
        duration: "04:33"
    },
    {
        id: 3,
        name: "Погасли свечи",
        file: "files/Погасли свечи.mp3",
        duration: "03:55"
    },
    {
        id: 1,
        name: "DaBro - Юность",
        file: "files/DaBro - Юность.mp3",
        duration: "03:39"
    },
    {
        id: 2,
        name: "AP$ENT - Можно я с тобой",
        file: "files/AP$ENT - Можно я с тобой.mp3",
        duration: "02:13"
    },

    {
        id: 4,
        name: "Sabaton - Barbariki",
        file: "files/Sabaton - Barbariki.mp3",
        duration: "03:15"
    },
    {
        id: 5,
        name: "Январская Вьюга",
        file: "files/Январская Вьюга.wav",
        duration: "02:42"
    },
    {
        id: 6,
        name: "И вновь продолжается бой",
        file: "files/И вновь продолжается бой.mp3",
        duration: "03:49"
    },

    // {
    //     id: 1,
    //     name: "Artist 1 - audio 1",
    //     file: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-10.mp3",
    //     duration: "08:47"
    // },
    // {
    //     id: 2,
    //     name: "Artist 2 - audio 2",
    //     file: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3",
    //     duration: "05:53"
    // },
    {
        id: 7,
        name: "Sabaton - Гимн Наемников",
        file: "files/Sabaton - Гимн Наемников.mp3",
        duration: "03:02"
    },
    
];
let list2 = [];
let list3 = [];


function getPlayerList(query)
{
    document.getElementById("content__animation").innerHTML = "<span class='loader'></span>";
    document.getElementById("content__results").innerHTML = "";
    
    fetch(`http://83.222.11.85:7771/back/file/read.php?q=${query}`)
    .then(response => response.json())
    .then(tracks =>
        {
            if(!tracks.length)
            {
                document.getElementById("content__results").innerHTML = "<h2>Ничего не найдено</h2>"
                document.getElementById("content__animation").innerHTML = "";
                return;
            } 
            
            list2 = tracks;
            player_audio.trackList = list2;
            document.getElementById("content__results").innerHTML = "";
            document.getElementById("content__animation").innerHTML = "";
            renderFindedTrackList(findedTrackList);  
            let playlist_track_ctn_f = document.getElementsByClassName("playlist-track-ctn-f");
            
            let ch= 0;
            for(let e of playlist_track_ctn_f)
                {
                    e.setAttribute("data-uid", tracks[ch].uid)
                    e.addEventListener("click", runTargetTrack);
                    ch++;
                } 
            // loadTrack(0);
        })
}



let player_audio =
{
    trackList: [],
    previousTrack:
    {
        element: "",
        duration: "",
        name: "",
        id_attrib: "",
        index: "",
        data_list: "",
        uid: ""
    },
    currentTrack:
    {
        element: "",
        duration: "",
        name: "",
        id_attrib: "",
        index: "",
        data_list: "",
        uid: ""
    },
    nextTrack:
    {
        element: "",
        duration: "",
        name: "",
        id_attrib: "",
        index: "",
        data_list: "",
        uid: ""
    },
    different_info: "",

};
class Xzkakzvatb
{
    constructor(a, b, c, d, e, f, g = "")
    {
        this.renderIn = a;
        this.div_track = b;
        this.div_btn = c;
        this.i_btn = d;
        this.div_class = e;
        this.list = f;
        this.uid = g;
    }
}

let currentTrackList = new Xzkakzvatb("playlist-ctn", "ptc", "pbp", "p-img", "playlist-track-ctn", 1);
let findedTrackList = new Xzkakzvatb("content__results", "ptc-f", "pbp-f", "p-img-f", "playlist-track-ctn-f", 2);
let favoriteTrackList = new Xzkakzvatb("content__results", "ptc-f", "pbp-f", "p-img-f", "playlist-track-ctn-f", 3);


let player_access =
{
    audio_tag: document.getElementById("myAudio"),
    source_tag: document.getElementById("source-audio"),

    volume_input: document.getElementById("range-volume"),
    currentTrack:
    {
        timer: document.getElementById("timer"),
        title: document.getElementById("title"),
        duration: document.getElementById("duration"),
        progressbar: document.getElementById("progress-bar"),
        track_progress: document.getElementById("my-bar"),
    },
    buttons:
    {
        play_pause: document.getElementById("btn-play"),
        play_i_tag: document.getElementById("icon-play"),
        pause_i_tag: document.getElementById("icon-pause"),
    },
};






// -----------------events--------------------------------------------------
// -----------------events--------------------------------------------------
// -----------------events--------------------------------------------------
player_access.buttons.play_pause.addEventListener("click", playPause);
player_access.volume_input.addEventListener("input", changeVolume);
player_access.currentTrack.progressbar.addEventListener("click", seek);
player_access.audio_tag.addEventListener("timeupdate", onTimeUpdate);

let menu_search = document.getElementById("menu__search");
menu_search.addEventListener("click", ()=> {callAnimateOnElement(search_btn_fn)});

let menu_favorite = document.getElementById("menu__favorite");
menu_favorite.addEventListener("click", ()=> {callAnimateOnElement(favorite_btn_fn)});

let menu_add = document.getElementById("menu__add");
menu_add.addEventListener("click", ()=> {callAnimateOnElement(add_btn_fn)});






function renderTrackList(obj)
{
    for(let i = 0; i < player_audio.trackList.length; i++)
    {
        let trackItem =
        `
        <div class="${obj.div_class}" id="${obj.div_track}-${i}" data-index="${i}" data-list="${obj.list}" data-uid="${obj.uid}">
            <div class="playlist-btn-play" id="${obj.div_btn}-${i}">
                <i class="fa fas fa-play" height="40" width="40" id="${obj.i_btn}-${i}" aria-hidden="true"></i>
            </div>
        <div class="playlist-info-track" >${player_audio.trackList[i].name}</div>
        <div class="playlist-duration">${player_audio.trackList[i].duration}</div>
        </div>
        `;
        document.getElementById(obj.renderIn).innerHTML += trackItem;
    }
}

// -----------------отрисовка-------------------
player_audio.trackList = list1;
renderTrackList(currentTrackList);




// ---------------события на песнях------------
let playlist_track_ctn = document.getElementsByClassName("playlist-track-ctn");
for(let e of playlist_track_ctn) e.addEventListener("click", runTargetTrack);


// первичная установка
loadTrack(0);
player_audio.different_info = currentTrackList;
player_audio.currentTrack.element = document.getElementById(player_audio.different_info.div_track + "-" + 0);
setCurrentTrackInPlayerAudio(player_audio.currentTrack.element);










function runTargetTrack(e)
{
    // это условие нужно, чтобы при клике по "звезде" не происходило включения//выключения
    if(e.currentTarget == e.target)
    {
        if(player_audio.currentTrack.index != "") updateStylePlayer(0);

        changeTrackList(e.currentTarget);

        //если клик по тому же элементу то стоп или запуск
        // иначе будет загрузка другого трека
        if(e.currentTarget.getAttribute("data-index") == player_audio.currentTrack.index 
        && e.currentTarget.getAttribute("data-list") == player_audio.currentTrack.data_list)
        {
            playPause();
        }
        else
        {
            setCurrentTrackInPlayerAudio(e.currentTarget);
            updateStylePlayer(1);
            loadTrack(e.currentTarget.getAttribute("data-index"));
            playPause();
        }
    }
}
function changeTrackList(l)
{
    if(l.getAttribute("data-list") == 1)
    {
        player_audio.different_info = currentTrackList;
        player_audio.trackList = list1;
    }
    else if(l.getAttribute("data-list") == 2)
    {   
        player_audio.different_info = findedTrackList;
        player_audio.trackList = list2;
    }
    else
    {
        player_audio.different_info = favoriteTrackList;
        player_audio.trackList = list3;
    }
}
function playPause()
{
    if(player_access.audio_tag.paused)
    {
        updateStylePlayer(1);
        player_access.buttons.play_i_tag.style.display = 'none';
        player_access.buttons.pause_i_tag.style.display = 'block';
        player_access.audio_tag.play();
    }
    else
    {
        updateStylePlayer(0);
        player_access.buttons.play_i_tag.style.display = 'block';
        player_access.buttons.pause_i_tag.style.display = 'none';
        player_access.audio_tag.pause();
    }
    
}

function setCurrentTrackInPlayerAudio(targetElement)
{
    player_audio.currentTrack.id_attrib = targetElement.getAttribute("id");
    player_audio.currentTrack.index = targetElement.getAttribute("data-index");
    player_audio.currentTrack.data_list = targetElement.getAttribute("data-list");
    player_audio.currentTrack.element = targetElement;

    previousNextTrackInPlayerAudio(targetElement);
}

function previousNextTrackInPlayerAudio(targetElement)
{   
    let prev = targetElement.previousElementSibling;
    let next = targetElement.nextElementSibling;

    if(next != null)
    {
        player_audio.nextTrack.id_attrib = next.getAttribute("id");
        player_audio.nextTrack.index = next.getAttribute("data-index");
        player_audio.nextTrack.data_list = next.getAttribute("data-list");
        player_audio.nextTrack.element = next;
    }

    if(prev != null)
    {
        player_audio.previousTrack.id_attrib = prev.getAttribute("id");
        player_audio.previousTrack.index = prev.getAttribute("data-index");
        player_audio.previousTrack.data_list = prev.getAttribute("data-list");
        player_audio.previousTrack.element = prev;
    }
}

function loadTrack(k)
{
        document.getElementById("title_div").setAttribute("title", player_audio.trackList[k].name);
        player_access.currentTrack.duration.innerHTML = player_audio.trackList[k].duration;
        player_access.currentTrack.title.innerHTML = player_audio.trackList[k].name;
        player_access.source_tag.src = player_audio.trackList[k].file;
        player_access.audio_tag.load();
}



function changeVolume() 
{
    player_access.audio_tag.volume = player_access.volume_input.value / 100;
}

function toggleMute() 
{
    let btnMute = document.querySelector('#toggleMute');
    let volUp = document.querySelector('#icon-vol-up');
    let volMute = document.querySelector('#icon-vol-mute');
    if (player_access.audio_tag.muted == false) 
    {
        player_access.audio_tag.muted = true
        volUp.style.display = "none"
        volMute.style.display = "block"
    } 
    else 
    {
        player_access.audio_tag.muted = false
        volMute.style.display = "none"
        volUp.style.display = "block"
    }
}

function seek(event) 
{
    let percent = event.offsetX / player_access.currentTrack.progressbar.offsetWidth;
    player_access.audio_tag.currentTime = percent * player_access.audio_tag.duration;
    player_access.currentTrack.track_progress.style.width = percent * 100 + "%";
}

function setBarProgress() {
    let progress = (player_access.audio_tag.currentTime / player_access.audio_tag.duration) * 100;
    player_access.currentTrack.track_progress.style.width = progress + "%";
}

function getMinutes(t) {
    let min = parseInt(parseInt(t) / 60);
    let sec = parseInt(t % 60);
    if (sec < 10) {
        sec = "0" + sec
    }
    if (min < 10) {
        min = "0" + min
    }
    return min + ":" + sec
}
function setBarProgress() 
{
    let progress = (player_access.audio_tag.currentTime / player_access.audio_tag.duration) * 100;
    player_access.currentTrack.track_progress.style.width = progress + "%";
}
function onTimeUpdate() 
{ 
    player_access.currentTrack.timer.innerHTML = getMinutes(player_access.audio_tag.currentTime);
    setBarProgress();
    if(player_access.audio_tag.ended && player_audio.currentTrack.index < (player_audio.trackList.length-1))
    {
        let nextIndex = +player_audio.currentTrack.index + 1;
        updateStylePlayer(0);
        loadTrack(nextIndex);
        setCurrentTrackInPlayerAudio(document.getElementById(player_audio.different_info.div_track + "-" + nextIndex));
        playPause();
    } 
}

function updateStylePlayer(int)
{
    let id_attrib_i_tag = player_audio.different_info.i_btn + "-" + player_audio.currentTrack.index;
    let received_element_div = document.getElementById(player_audio.currentTrack.id_attrib);
    let received_element_i = document.getElementById(id_attrib_i_tag);
    
    // 1 - set style on new track
    // 0 - delete style from old track
    if(int == 1)
    {
        received_element_div.classList.add("active-track");
        received_element_i.classList.add("fa-pause");
        received_element_i.classList.remove("fa-play");
    }
    else
    {
        received_element_div.classList.remove("active-track");
        received_element_i.classList.add("fa-play");
        received_element_i.classList.remove("fa-pause");
    }
}

function forward() 
{
    player_access.audio_tag.currentTime = player_access.audio_tag.currentTime + 5;
    this.setBarProgress();
}

function rewind() 
{
    player_access.audio_tag.currentTime = player_access.audio_tag.currentTime - 5;
    this.setBarProgress();
}

function next() 
{
    if(player_audio.currentTrack.index < player_audio.trackList.length - 1)
    {
        let nextTrack = +player_audio.currentTrack.index + 1;
        updateStylePlayer(0);
        loadTrack(nextTrack);
        setCurrentTrackInPlayerAudio(player_audio.nextTrack.element);
        playPause();
    }
}

function previous() 
{
    if(player_audio.currentTrack.index - 1 > -1)
    {
        let prevTrack = +player_audio.currentTrack.index - 1;
        updateStylePlayer(0);
        loadTrack(prevTrack);
        setCurrentTrackInPlayerAudio(player_audio.previousTrack.element);
        playPause();
    }
}

function returnBack_fn()
{

    player_audio.trackList = list1;
    if(!player_access.audio_tag.paused) playPause();
    loadTrack(0);
    player_access.currentTrack.track_progress.style.width = 0 + "%";
    player_audio.different_info = currentTrackList;
    player_audio.currentTrack.element = document.getElementById(player_audio.different_info.div_track + "-" + 0);
    setCurrentTrackInPlayerAudio(player_audio.currentTrack.element);


    let animate_duration = 300;
    
    document.getElementById("content-inner").animate(
        [
            {
                transform: "scale(0.9)",
                opacity: 0
            },
        ],
        {
            duration: animate_duration,
        }
    );
    setTimeout(function() 
    {
        document.getElementById("menu").style.display = "flex";
        document.getElementById("content-inner").innerHTML = 
        `
        <div id="content__actions"></div>
        <div id="content__animation"></div>
        <div id="content__results"></div>
        `; 
        document.getElementById("content").style.display = "none";
    }, animate_duration);
    window.stop();
}

function createBackBtn_fn()
{
    return `
    <div id="back-btn" onclick="returnBack_fn()">
      Назад
    </div>
    `;
}

function renderFindedTrackList(obj)
{
    for(let i = 0; i < player_audio.trackList.length; i++)
        {
            let trackItem =
            `
            <div class="${obj.div_class}" id="${obj.div_track}-${i}" data-index="${i}" data-list="${obj.list}" data-uid="${obj.uid}">
                <div class="playlist-btn-play" id="${obj.div_btn}-${i}">
                    <i class="fa fas fa-play" height="40" width="40" id="${obj.i_btn}-${i}" aria-hidden="true"></i>
                </div>
            <div class="playlist-info-track" id=n-${i}>${player_audio.trackList[i].name}</div>
                <div><i class="fa fas fa-star-o sl" data-index="${i}" aria-hidden="true" onclick="addFavorite(this)"></i></div>
            <div class="playlist-duration">${player_audio.trackList[i].duration}</div>
            </div>
            `;
            document.getElementById(obj.renderIn).innerHTML += trackItem;
        }
}

function searchTrack()
{

    getPlayerList(document.getElementById("search_inp").value);
    
    player_audio.trackList = list1;
}

function search_btn_fn()
{
    document.getElementById("content").style.display = "block";
    let search_html =
    `
    <div id="search">
        <input id="search_inp" type="search" placeholder="Поиск">
        <button type="button" id="search-btn" onclick="searchTrack()">Поиск!</button>
    </div>
    `;
    document.getElementById("menu").style.display = "none";
    
    let content_div = document.getElementById("content__actions"); 
    
    content_div.innerHTML += createBackBtn_fn(); // 1 set
    content_div.innerHTML += search_html; // 2 set
    
}

function callAnimateOnElement(callFunction, animate_duration = 300)
{
    
    document.getElementById("menu").animate(
        [
            {
                transform: "scale(0.9)",
                opacity: 0
            },
        ],
        {
            duration: animate_duration,
        }
    );
    setTimeout(function() 
    {
        callFunction();
    }, animate_duration);
}



//------------------------------favorite---------------------
//------------------------------favorite---------------------
//------------------------------favorite---------------------
//------------------------------favorite---------------------
async function addFavorite(e)
{    
    player_audio.trackList = list1;
    if(!player_access.audio_tag.paused) playPause();
    loadTrack(0);
    player_access.currentTrack.track_progress.style.width = 0 + "%";
    player_audio.different_info = currentTrackList;
    player_audio.currentTrack.element = document.getElementById(player_audio.different_info.div_track + "-" + 0);
    setCurrentTrackInPlayerAudio(player_audio.currentTrack.element);

    let num = e.getAttribute("data-index");
    let query = document.getElementById("n-" + num).innerHTML;

    document.getElementById("content__animation").innerHTML = "<span class='loader'></span>";
    document.getElementById("content__results").innerHTML = "";

    await fetch(`http://83.222.11.85:7771/back/favorite/create.php?q=${query}`)
    .then(res => res.json())
    .then(e => console.log(e));
    searchTrack();
}



async function delFavorite(e)
{
    player_audio.trackList = list1;
    if(!player_access.audio_tag.paused) playPause();
    loadTrack(0);
    player_access.currentTrack.track_progress.style.width = 0 + "%";
    player_audio.different_info = currentTrackList;
    player_audio.currentTrack.element = document.getElementById(player_audio.different_info.div_track + "-" + 0);
    setCurrentTrackInPlayerAudio(player_audio.currentTrack.element);

    let num = e.getAttribute("data-index");
    let query = document.getElementById("n-" + num).innerHTML;
    document.getElementById("content__animation").innerHTML = "<span class='loader'></span>";
    document.getElementById("content__results").innerHTML = "";
    await fetch(`http://83.222.11.85:7771/back/favorite/delete.php?q=${query}`);
    getFavoriteList();
}

function renderFavoriteTrackList(obj)
{
    for(let i = 0; i < player_audio.trackList.length; i++)
        {
            let trackItem =
            `
            <div class="${obj.div_class}" id="${obj.div_track}-${i}" data-index="${i}" data-list="${obj.list}" data-uid="${obj.uid}">
                <div class="playlist-btn-play" id="${obj.div_btn}-${i}">
                    <i class="fa fas fa-play" height="40" width="40" id="${obj.i_btn}-${i}" aria-hidden="true"></i>
                </div>
            <div class="playlist-info-track" id=n-${i}>${player_audio.trackList[i].name}</div>
                <div><i class="fa fas fa-trash-o sl" data-index="${i}" aria-hidden="true" onclick="delFavorite(this)"></i></div>
            <div class="playlist-duration">${player_audio.trackList[i].duration}</div>
            </div>
            `;
            document.getElementById(obj.renderIn).innerHTML += trackItem;
        }
}
function getFavoriteList()
{
    document.getElementById("content").style.display = "block";

    document.getElementById("content__animation").innerHTML = "<span class='loader'></span>";
    document.getElementById("content__results").innerHTML = "";

    fetch("http://83.222.11.85:7771/back/favorite/read.php")
    .then(res => res.json())
    .then(tracks =>
    { 
        if(!tracks.length)
        {
            document.getElementById("content__results").innerHTML = "<h2>Ничего не найдено</h2>"
            document.getElementById("content__animation").innerHTML = "";
            return;
        } 
            
        list3 = tracks;
        player_audio.trackList = list3;
        document.getElementById("content__results").innerHTML = "";
        document.getElementById("content__animation").innerHTML = "";
        renderFavoriteTrackList(favoriteTrackList);  
        let playlist_track_ctn_fa = document.getElementsByClassName("playlist-track-ctn-f");
        
        let ch= 0;
        for(let e of playlist_track_ctn_fa)
            {
                e.setAttribute("data-uid", tracks[ch].uid)
                e.addEventListener("click", runTargetTrack);
                ch++;
            } 
        // loadTrack(0);
    }
    )
    
}
function favorite_btn_fn()
{
    document.getElementById("menu").style.display = "none";
    let content_div = document.getElementById("content__actions"); 
    
    content_div.innerHTML += createBackBtn_fn(); // 1 set
    getFavoriteList();
}



// ----------------------------------------------------------
// ----------------------------------------------------------
// ----------------------------------------------------------

let chi = 0;
function add_btn_fn()
{
    document.getElementById("menu").style.display = "none";
    document.getElementById("content").style.display = "block";

    let content_div = document.getElementById("content__actions"); 
    
    content_div.innerHTML += createBackBtn_fn(); // 1 set

    content_div.innerHTML += `
    <div class="input-file-row">
        <label class="input-file">
            <input type="file" name="file[]" multiple id="i-f" class="i-f" onchange="inputOnChangee(this)">		
            <span>Выберите файлы</span>
        </label>
        <input type ="button" value="Отправить" id="send-file-btn" onclick="callAnimateOnElement(send_file)">
    </div>`;

    document.getElementById("content__results").innerHTML = `<div class="input-file-list" id="input-file-list"></div>`;

}

function send_file()
{

    let input_file = document.getElementById("i-f");
    if(input_file.files.length == 0) return alert("Сначала добавьте файлы");

    let size_files = 0;
    for(let file of input_file.files) size_files += file.size;
    if(size_files > 20_971_520) return alert("Не более 20 МБ");

    for(let file of input_file.files) if(file.type != "audio/mpeg") return alert("Только формат mp3");


    document.getElementById("content__animation").innerHTML = "<span class='loader'></span>";
    document.getElementById("content__results").innerHTML = "";

    
    let formData = new FormData();
    console.log(input_file.files);
    
    // throw "dail";
    for(let i = 0; i < input_file.files.length; i++)
    {
        formData.append(i, input_file.files[i]);
    }

    fetch("http://83.222.11.85:7771/back/file/create.php",
        {
            method: "POST",
            body: formData
        }
    )
    .then(res => res.json())
    .then( data =>
    {
        console.log(data);
        document.getElementById("content__results").innerHTML = "";
        document.getElementById("content__animation").innerHTML = "";
        document.getElementById("back-btn").click();
    })
}

function inputOnChangee(e)
{
    let input_file = document.getElementById("i-f");
    let ind = 0;
    document.getElementById("input-file-list").innerHTML = "";
    for (let file of input_file.files) 
    {
        document.getElementById("input-file-list").innerHTML += 
        `
        <div class="input-file-element">
            <div class="input-file-name">${file.name}</div>
        </div>
        `;
        ind++;
    }
    // <div class="input-file-del" onclick="delFile(this)" data-index="${ind}"><i class="fa fa-ban" aria-hidden="true"></i></div>

}

function delFile(e)
{
    let input_files = document.getElementById("i-f");
    let arr = Array.from(input_files);

    arr.splice(e.getAttribute("data-index"), 1) ;
}
