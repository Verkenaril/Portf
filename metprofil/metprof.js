$(document).ready(function(){
	  $( ".cart-svg" ).eq(0).click(function(){
	    $( "#cart__list" ).eq(0).slideToggle();});
	  });

let item_incart_btn=document.getElementsByClassName("incart-btn");
let cart_list=document.getElementById("cart__list");
let incart_count=document.getElementById("incart-count");

let cart_item=document.getElementsByClassName("cart__item");
let cart_summa=document.getElementById("cart__summa");
let cart_summa_p=document.getElementById("cart__summa_p");
let get_price;
for(let i=0; i<item_incart_btn.length; i++)
    {
        item_incart_btn[i].addEventListener("click", inCart); 
    }
function inCart(t)
{
    let getParent=t.currentTarget.parentElement;
    
//    let new_item_cart=document.createElement("div");
//    new_item_cart.setAttribute("class", "cart__item");
    
    
    let copy_getParent=getParent.cloneNode(true);
    cart_list.appendChild(copy_getParent);
    copy_getParent.setAttribute("class", "cart__item");

    copy_getParent.children[0].children[0].setAttribute("class", "cart__item_img");
    
    copy_getParent.children[1].setAttribute("class", "cart__item_name");
    
     copy_getParent.children[4].innerHTML=copy_getParent.getElementsByTagName("input")[0].value;
    
    copy_getParent.children[5].innerHTML="<span>Убрать</span>";
    
    copy_getParent.children[5].setAttribute("class", "delete-btn");
    //--------счётчик-----------
    incart_count.textContent=+incart_count.textContent+1;
    
     copy_getParent.children[5].addEventListener("click", deleteItem);
       
    get_price=+copy_getParent.children[3].children[0].textContent;
    
   //--------сумма-----------
    cart_summa_p.textContent=+cart_summa_p.textContent+get_price*copy_getParent.children[4].textContent;
    
    function deleteItem(e)
    {
        let a=e.currentTarget.parentElement;
        let count_item_cart=a.getElementsByClassName("item-count")[0].textContent;
       
       let price_item_cart=a.getElementsByClassName("span-price")[0].textContent;
        
        cart_summa_p.textContent=+cart_summa_p.textContent-count_item_cart*price_item_cart;
                                                           

        incart_count.textContent=+incart_count.textContent-1;
        cart_list.removeChild(copy_getParent);
    }
}
let filtres_price=document.getElementsByClassName("filtres__price")[0];

let filtres_price_input=document.getElementsByClassName("filtres__price_input");
let span_price=document.getElementsByClassName("span-price");
let item=document.getElementsByClassName("item");

for(let i=0; i<filtres_price_input.length; i++)
{   
    filtres_price_input[i].addEventListener("click", setFilters);
}

//------------------фильтр по цене----------
let first;
let second;
let click_checkbox;
let get_range;
function setFilters(t)
{
    click_checkbox=t.currentTarget;
    
    
    if(!click_checkbox.hasAttribute("checked"))
        {
            click_checkbox.setAttribute("checked", "");
        }
    else
        {
            click_checkbox.removeAttribute("checked");
        }
    get_range=click_checkbox.nextSibling.getElementsByTagName("span");
    first=+get_range[0].textContent;
    second=+get_range[1].textContent;
    for(let l=0; l<span_price.length; l++)
        {
            if(!item[l].hasAttribute("style"))
                {
                    $(".item").eq(l).fadeOut();
                }
    
            if(Number(span_price[l].textContent)>=first && Number(span_price[l].textContent)<=second)
            {   
                $(".item").eq(l).fadeToggle();
            }
        }
function monitorCheckbox()
    {
        let countFalse=0;
        for(let i=0; i<filtres_price_input.length; i++)
        {   
            if(!filtres_price_input[i].hasAttribute("checked"))
                {
                    countFalse++;
                }
            switch (+countFalse)
                {
                    case 5:
                    test();
                    break;
                }
        }
    }
monitorCheckbox();
function test()
    {
        for(let k=0; k<item.length; k++)
        {
            setTimeout(function () {item[k].removeAttribute("style")}, 500);
        }
    }
}
let reset_price=document.getElementById("reset-price");
reset_price.addEventListener("click", resetPrice);

function resetPrice()
{
    for(let k=0; k<item.length; k++)
        {
            item[k].removeAttribute("style");
        }
    for(let i=0; i<filtres_price_input.length; i++)
        {
            filtres_price_input[i].checked=false;
            filtres_price_input[i].removeAttribute("checked");
        }
}

let toggle_menu=document.getElementById("toggle-menu");
toggle_menu.addEventListener("click", toggleMenu);

function toggleMenu()
{
    $("#header").slideToggle();
}

let toggle_filtres=document.getElementById("toggle-filtres");
toggle_filtres.addEventListener("click", toggleFiltres);

function toggleFiltres()
{
    $(".filters").slideToggle();
}
