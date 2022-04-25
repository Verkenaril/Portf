
let headPhones=document.getElementById("headPhones");
let miniViews=document.getElementsByClassName("mini-Views");
let roundCol=document.getElementsByClassName("roundCol");

//-------------------------------------------

let model_1_mini=[ 
	["pic/mini/model_1_1_mini_blue.png", "pic/mini/model_1_2_mini_blue.png"], 
	[ "pic/mini/model_1_1_mini_red.png", "pic/mini/model_1_2_mini_red.png"],
	[ "pic/mini/model_1_1_mini_black.jpg", "pic/mini/model_1_2_mini_black.jpg"],
	[ "pic/mini/model_1_1_mini_green.png", "pic/mini/model_1_2_mini_green.png"],
	[ "pic/mini/model_1_1_mini_yellow.png", "pic/mini/model_1_2_mini_yellow.png"],
	["pic/mini/Net_mini.jpg", "pic/mini/Net_mini.jpg"]
];
let model_1_big=[ 
	["pic/model_1_1_blue.png", "pic/model_1_2_blue.png"], ["pic/model_1_1_red.png", "pic/model_1_2_red.png"],
	["pic/model_1_1_black.png", "pic/model_1_2_black.png"],
	["pic/model_1_1_green.png", "pic/model_1_2_green.png"],
	["pic/model_1_1_yellow.png", "pic/model_1_2_yellow.png"],
	["pic/Net.png", "pic/Net.png"]
];
let model_2_mini=[ 
	["pic/mini/model_2_1_mini_blue.jpg", "pic/mini/model_2_2_mini_blue.jpg"], 
	["pic/mini/Net_mini.jpg", "pic/mini/Net_mini.jpg"],
	[ "pic/mini/model_2_1_mini_black.jpg", "pic/mini/model_2_2_mini_black.jpg"],
	["pic/mini/Net_mini.jpg", "pic/mini/Net_mini.jpg"],
	["pic/mini/Net_mini.jpg", "pic/mini/Net_mini.jpg"],
	[ "pic/mini/model_2_1_mini_white.jpg", "pic/mini/model_2_2_mini_white.jpg"]
];
let model_2_big=[ 
	["pic/model_2_1_blue.png", "pic/model_2_2_blue.png"], ["pic/Net.png", "pic/Net.png"],
	["pic/model_2_1_black.png", "pic/model_2_2_black.png"],
	["pic/Net.png", "pic/Net.png"],
	["pic/Net.png", "pic/Net.png"],
	["pic/model_2_1_white.png", "pic/model_2_2_white.png"]
];
let model_3_big=[ 
	["pic/model_3_1_blue.png", "pic/model_3_2_blue.png"], ["pic/Net.png", "pic/Net.png"],
	["pic/model_3_1_black.png", "pic/model_3_2_black.png"],
	["pic/Net.png", "pic/Net.png"],
	["pic/Net.png", "pic/Net.png"],
	["pic/model_3_1_white.png", "pic/model_3_2_white.png"]
];
let model_3_mini=[ 
	["pic/mini/model_3_1_mini_blue.jpg", "pic/mini/model_3_2_mini_blue.jpg"], 
	["pic/mini/Net_mini.jpg", "pic/mini/Net_mini.jpg"],
	[ "pic/mini/model_3_1_mini_black.jpg", "pic/mini/model_3_2_mini_black.jpg"],
	["pic/mini/Net_mini.jpg", "pic/mini/Net_mini.jpg"],
	["pic/mini/Net_mini.jpg", "pic/mini/Net_mini.jpg"],
	["pic/mini/model_3_1_mini_white.jpg", "pic/mini/model_3_2_mini_white.jpg"]
];

let AllModelsBig=[ model_1_big, model_2_big, model_3_big ];
let AllModelsMini=[model_1_mini, model_2_mini, model_3_mini];


let IdColors= [
	"0px 0px 0px 4px #000925, 0px 0px 0px 7px #2573c8", "0px 0px 0px 4px #000925, 0px 0px 0px 7px #c72711", "0px 0px 0px 4px #000925, 0px 0px 0px 7px white", "0px 0px 0px 4px #000925, 0px 0px 0px 7px #4a904c", "0px 0px 0px 4px #000925, 0px 0px 0px 7px #fbf22f", "0px 0px 0px 4px #000925, 0px 0px 0px 7px white"
];



let sliderPic=document.getElementsByClassName("slider_pic");

for (let m=0; m<sliderPic.length; m++)
{	
	sliderPic[m].addEventListener("click", changeModel)	
	function changeModel()
	{	
		headPhones.style.opacity=0;
		for (let v=0; v<roundCol.length; v++)
			{
				roundCol[v].style.boxShadow="";
				roundCol[v].setAttribute("class", "roundCol");
			}
		
		for (let n=0; n<sliderPic.length; n++)
			{
				sliderPic[n].setAttribute("class", "slider_pic");
			}
	
		sliderPic[m].setAttribute("class", "slider_pic active-item");
		roundCol[2].style.boxShadow=IdColors[2];
		roundCol[2].setAttribute("class", "roundCol active-color");
		
				
		$("#item__main-pic").fadeOut(150, function () {
		headPhones.setAttribute("src", AllModelsBig[m][2][0]) });
		
		
			
		$(".mini-Views").eq(0).fadeOut(150, function () {
		miniViews[0].setAttribute("src", AllModelsMini[m][2][0])  } );
		$(".mini-Views").eq(1).fadeOut(150, function () {
		miniViews[1].setAttribute("src", AllModelsMini[m][2][1])  } );
        
        $(".mini-Views").eq(0).fadeIn(350);
	$(".mini-Views").eq(1).fadeIn(350);
        $("#item__main-pic").fadeIn(350);
	setTimeout(function(){headPhones.style.opacity=100;}, 700);	
	}

}



let colors=[
	"blue", "red", "black", "green", "yellow", "white"
];



for (let c=0; c<roundCol.length; c++)
{	
roundCol[c].addEventListener("click", changeColor);

	function changeColor()
	{
		if(sliderPic[0].getAttribute("class")=="slider_pic active-item")
		{	
		if(roundCol[c].getAttribute("id")==colors[c]  )
		{
			headPhones.style.opacity=0;
			for(let k=0; k<miniViews.length; k++)
				{	
					miniViews[k].setAttribute("src", model_1_mini[c][k]);
				}
				$("#item__main-pic").fadeOut(150, function ()
					{ headPhones.setAttribute("src", model_1_big[c][0]) });	
					$("#item__main-pic").fadeIn(350);
					setTimeout(function(){headPhones.style.opacity=100;}, 700);
				}
		}
		else if(sliderPic[1].getAttribute("class")=="slider_pic active-item")
		{
			if(roundCol[c].getAttribute("id")==colors[c])
			{
			headPhones.style.opacity=0;	
			for(let k=0; k<miniViews.length; k++)
				{	
					miniViews[k].setAttribute("src", model_2_mini[c][k]);
				}
			$("#item__main-pic").fadeOut(150, function () {
			headPhones.setAttribute("src", model_2_big[c][0]) });	
			$("#item__main-pic").fadeIn(350);
			setTimeout(function(){headPhones.style.opacity=100;}, 700);
			}
		}
		else if (sliderPic[2].getAttribute("class")=="slider_pic active-item")
		{
			if(roundCol[c].getAttribute("id")==colors[c])
			{
			headPhones.style.opacity=0;
			for(let k=0; k<miniViews.length; k++)
				{	
			miniViews[k].setAttribute("src", model_3_mini[c][k]);
				}
			$("#item__main-pic").fadeOut(150, function () {
			headPhones.setAttribute("src", model_3_big[c][0]) });	
			$("#item__main-pic").fadeIn(350);
			setTimeout(function(){headPhones.style.opacity=100;}, 700);
			}
		}	
		
		for (let v=0; v<roundCol.length; v++)
			{
				roundCol[v].style.boxShadow="";
				roundCol[v].setAttribute("class", "roundCol");
			}
		roundCol[c].style.boxShadow=IdColors[c];
		roundCol[c].setAttribute("class", "roundCol active-color");

	}
}




miniViews[0].addEventListener("click", changeViewFirst);
function changeViewFirst()
{	
    
	for (let q=0; q<roundCol.length; q++)
	{
		for (let i=0; i<sliderPic.length; i++)
		{
		if(sliderPic[i].getAttribute("class")=="slider_pic active-item" && roundCol[q].getAttribute("class")=="roundCol active-color")
		   {
           		headPhones.style.opacity=0;
			$("#headPhones").fadeOut(150, function () { headPhones.setAttribute("src", AllModelsBig[i][q][0]) });
			$("#headPhones").fadeIn(150);
            		setTimeout(function(){headPhones.style.opacity=100;}, 700);
		   }
		}
	}	
}

miniViews[1].addEventListener("click", changeViewSecond);
function changeViewSecond()
{
	for (let q=0; q<roundCol.length; q++)
	{	
		for (let i=0; i<sliderPic.length; i++)
		{
		if(sliderPic[i].getAttribute("class")=="slider_pic active-item" && roundCol[q].getAttribute("class")=="roundCol active-color")
		   {
            		headPhones.style.opacity=0;
		    	$("#headPhones").fadeOut(150, function () { headPhones.setAttribute("src", AllModelsBig[i][q][1]);});
		 	$("#headPhones").fadeIn(150);
            		setTimeout(function(){headPhones.style.opacity=100;}, 700);
		   }
		}
	}
}


let cart=document.getElementById("cart");
cart.addEventListener("click", cartOpen);

function cartOpen()
{
	$("#cart_list").toggle(200);
	$("#close_").toggle(200);
}

let closeCart=document.getElementById("close_");
closeCart.addEventListener("click", closeCartFync);
function closeCartFync()
	{
		$("#cart_list").toggle(200);
		$("#close_").toggle(200);
	}

let model_1_info=["MMM-ZZZ", "100500руб"];

let model_2_info=["LLL-ZZZ", "200500руб"];

let model_3_info=["RRR-ZZZ", "300500руб"];

let models_info=[ model_1_info, model_2_info, model_3_info ];


let btn_addToCart=document.getElementById("add_to_cart");
btn_addToCart.addEventListener("click", ToCart);

let countInCart=document.getElementById("count_in_cart");

let testTraslate=document.getElementsByClassName("mini-Views");

let testDiv=document.getElementById("testDiv");

function ToCart ()

{


if(headPhones.getAttribute("src")=="pic/Net.png")
{
//-------------------------------------
}
	
else 
{

	let newimg = testTraslate[0].cloneNode();
	newimg.setAttribute("id", "imgForTranslate");
	testDiv.prepend(newimg);

	countInCart.innerHTML=Number(countInCart.innerHTML)+1;

	for (let q=0; q<roundCol.length; q++)
	{		
		for (let i=0; i<sliderPic.length; i++)
		{
		if(sliderPic[i].getAttribute("class")=="slider_pic active-item" && roundCol[q].getAttribute("class")=="roundCol active-color")
			{
		
			let new_item=document.createElement("div");
			new_item.setAttribute("class", "cart_item");
			document.getElementById("cart_list").append(new_item);

			let new_img=document.createElement("img");
			new_img.setAttribute("src", AllModelsMini[i][q][0]);
			new_img.setAttribute("class", "in_cart_pic");
			new_item.append(new_img);

			let name_model=document.createElement("div");
			name_model.setAttribute("class", "name_model");
			name_model.textContent="Название: "+models_info[i][0];
			new_item.append(name_model);

			let item_price=document.createElement("div");
			item_price.setAttribute("class", "price");
			item_price.textContent="Цена: "+models_info[i][1];
			new_item.append(item_price);

			let del_btn=document.createElement("button");
			del_btn.setAttribute("class", "del_btn");
			del_btn.textContent="Убрать";
			new_item.append(del_btn);
			
			//удаление эл-та анимации
			function del_img()
				{
					newimg.remove();
				}
			setTimeout(del_img, 1000);
				
		
			let cartList=document.getElementById("cart_list");
	
			del_btn.addEventListener("click", delElem);
			function delElem()
				{
					countInCart.innerHTML=Number(countInCart.innerHTML)-1;
					
					cartList.removeChild(new_item);
				}
			}	
		}
	}
}				

}


		
//------------------------------------------

$(".slider-item").slick({vertical: true,
						verticalSwiping: true,
						 slidesToShow: 2,
						 infinite: false,
						 prevArrow:"<button type='button' class='slick-btn slick-prev'></button>",
						 nextArrow:"<button type='button' class='slick-btn slick-next'></button>"
						});
