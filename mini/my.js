let my_char = document.getElementsByClassName("char");
let img_dir= document.getElementsByClassName("img-char");
let img_spell=document.getElementsByClassName("spell");
document.addEventListener("keydown", controls);

let count_flask=document.getElementById("count-flask");
let count_shield=document.getElementById("count-shield");
let trink_flask=document.getElementsByClassName("effect-heal");
let effect_shield=document.getElementsByClassName("effect-shield");




let char=
    {
        damage: 5,
        speed: 8,  
        flask: 50
    };

function controls(e)
{
    
    console.log(e);// показывает события клавы и коды кнопок
    
    
    
    if(event.code=="KeyD")
        {
            function rightMove()
            {
               img_dir[0].setAttribute("class", "img-char right-side");
               img_dir[0].setAttribute("src", "");
               my_char[0].setAttribute("class", "char walk right-side");
               my_char[0].style.left=my_char[0].offsetLeft+char.speed+"px";
               
            
            }
            rightMove();
        }
    
    if(event.code=="KeyA")
        {
            function leftMove()
            {
                img_dir[0].setAttribute("src", "");
                img_dir[0].setAttribute("class", "img-char"); 
               my_char[0].setAttribute("class", "char walk");
  
               my_char[0].style.left=my_char[0].offsetLeft-char.speed+"px";
                
              
            }
            leftMove();
        }
  
    let random_char_damage=Math.round(Math.random()*10)+char.damage;
    if(event.code=="Digit1")
    {
        if(img_dir[0].getAttribute("class")=="img-char right-side")
        {
            img_dir[0].setAttribute("src", "img/kick.png"); 
        }
        else
        {
            img_dir[0].setAttribute("class", "img-char");
                img_dir[0].setAttribute("src", "img/kick.png");
        }    
    }   
}  

let a=150;
let b;

document.addEventListener("keyup", useSpell);
function useSpell()
{
    let random_char_damage=Math.round(Math.random()*10)+char.damage;
    
    if(event.code=="Digit1")
    {
        
        if(hp_enemy.textContent-random_char_damage<=0)
            {
                hp_enemy.textContent=0;
                health_enemy.style.width=0+"px";
                enemy_char[0].style.display="none";
                cancelAnimationFrame(aggro);
            }
        if((enemy_char[0].offsetLeft-my_char[0].offsetLeft)<150 && (my_char[0].offsetLeft-enemy_char[0].offsetLeft)<140)
        {
        b=a-a*(100*random_char_damage/hp_enemy.textContent)/100;
        a=b;
            
        hp_enemy.textContent=hp_enemy.textContent-random_char_damage;
        health_enemy.style.width=b+"px"; 
        console.log(random_char_damage);   
        }
    }
    
    if(event.code=="Digit2" && hp_char.textContent<150)
        {
            let random_flask=Math.round(Math.random()*10) + char.flask;
            switch (+count_flask.textContent)
                {
                    case 3:    
                    case 2:
                    case 1:
                       health.style.width=+hp_char.textContent+char.flask+"px";
                        hp_char.textContent=+hp_char.textContent+char.flask;
                        trink_flask[0].setAttribute("class", "effect-heal trink-flask");
                        setTimeout(function (){trink_flask[0].setAttribute("class", "effect-heal");}, 999);
                      
                         count_flask.textContent=+count_flask.textContent-1;
                        console.log(random_flask);
                        break;
                }   
        }
   
    if(event.code=="Digit3")
        {
            switch (+count_shield.textContent)
                {
            case 4: 
            case 3: 
            case 2:            
            case 1:
            enemy.damage=Math.round(Math.random()*10)+5;
                        effect_shield[0].setAttribute("class", "effect-shield use-shield");
                       
                        setTimeout(function(){ enemy.damage=Math.round(Math.random()*10)+30; 
                                              
                                             effect_shield[0].setAttribute("class", "effect-shield");}, 6000);
                        count_shield.textContent=count_shield.textContent-1;
                        
           break; 
                }
            
        }
        if(img_dir[0].getAttribute("class")=="img-char right-side")
            {
              
            my_char[0].setAttribute("class", "char");
                
             img_dir[0].setAttribute("src", "img/stay.png");
            img_dir[0].setAttribute("class", "img-char right-side");
             
           
            }
        else
            {
               
                my_char[0].setAttribute("class", "char");
                
                img_dir[0].setAttribute("src", "img/stay.png");
                img_dir[0].setAttribute("class", "img-char");
                
            }
        
}






let enemy_char=document.getElementsByClassName("enemy-char");
let dir;// если dir внутри, то не работает
let hp_enemy=document.getElementById("hp-enemy");
let health_enemy=document.getElementById("health-enemy");
let enemy=
    {
        noAgroSpeed: 1,
        aggroSpeed: 2,
        attackSpeed:3000,
        damage: 60
    };

document.addEventListener("DOMContentLoaded", enemyMove);



function enemyMove()

{
    
    if(enemy_char[0].offsetLeft==500)
        {
            dir=1;
        }
    else if(enemy_char[0].offsetLeft==800)
        {
            dir=-1;
        }
    if(dir==1)
    {
        enemy_char[0].style.left=enemy_char[0].offsetLeft+enemy.noAgroSpeed+"px";
        enemy_char[0].setAttribute("class", "enemy-char enemy-walk right-side");
    }
    else
    {
        enemy_char[0].style.left=enemy_char[0].offsetLeft-enemy.noAgroSpeed+"px";
        enemy_char[0].setAttribute("class", "enemy-char enemy-walk");
    }
    let noAggro = requestAnimationFrame(enemyMove); 
    
    
    if((enemy_char[0].offsetLeft-my_char[0].offsetLeft)<350)
    {
        cancelAnimationFrame(noAggro);
        followTarget();
        attackTarget();
    }   
}

let aggro;
function followTarget()
{
    
    aggro = requestAnimationFrame(followTarget);

    if((enemy_char[0].offsetLeft-my_char[0].offsetLeft)>130)
    {
        enemy_char[0].style.left=enemy_char[0].offsetLeft-enemy.aggroSpeed+"px";
        enemy_char[0].setAttribute("class", "enemy-char enemy-walk");
    }
  
    if((my_char[0].offsetLeft-enemy_char[0].offsetLeft)>50)
    {
        enemy_char[0].style.left=enemy_char[0].offsetLeft+enemy.aggroSpeed+"px";
        enemy_char[0].setAttribute("class", "enemy-char enemy-walk right-side");
    }
    
}

        
let health=document.getElementById("health");
let hp_char=document.getElementById("hp-char");
let valhalla=document.getElementsByClassName("valhalla");

function attackTarget()
{
    setTimeout(function() 
        {
        if(enemy_char[0].getAttribute("class")=="enemy-char enemy-walk" || enemy_char[0].getAttribute("class")=="enemy-char enemy-attack")
        {
            enemy_char[0].setAttribute("class", "enemy-char enemy-attack");
        }
        else
        {
            enemy_char[0].setAttribute("class", "enemy-char enemy-attack right-side");      
        }   
        }, 2000);

    let random_damage=Math.round(Math.random()*10)+enemy.damage;
    
  
    if((enemy_char[0].offsetLeft-my_char[0].offsetLeft)<150 && (my_char[0].offsetLeft-enemy_char[0].offsetLeft)<140)
    {
        hp_char.textContent=hp_char.textContent-random_damage;
        health.style.width=hp_char.textContent+"px"; 
        console.log(random_damage);
    }
    

    setTimeout(function()
        {
        if((hp_char.textContent-random_damage)>=0) 
            {
                attackTarget();
            }
        else
            {
            hp_char.textContent=0;
            health.style.width=0+"px";
            my_char[0].setAttribute("class", "char");
            img_dir[0].setAttribute("src", "img/dead.gif");
            enemy_char[0].setAttribute("class", "enemy-char enemy-stop");
            valhalla[0].setAttribute("class", "valhalla valhalla-anim");
            img_dir[0].setAttribute("class", "dead");   
            document.removeEventListener("keydown", controls);
            document.removeEventListener("keyup", useSpell);    
        
            }
        }, enemy.attackSpeed);
}
