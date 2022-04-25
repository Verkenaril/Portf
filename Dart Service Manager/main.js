$(".qwe").slick
				(
					{
						vertical: true,
						verticalSwiping: true,
						slidesToShow: 2,
						prevArrow:'<button type="button" class="slick-prev"></button>' ,
						nextArrow:'<button type="button" class="slick-next"></button>'
					}
				);


let fotoPerson=document.getElementsByClassName("fotoPer");
let infoPerson=document.getElementsByClassName("person");



for (let n=0; n<fotoPerson.length; n++)
{
	fotoPerson[n].addEventListener("mouseover", vis);
	
	function vis ()
	{
//		$(".person").eq(n).fadeIn(200);
		infoPerson[n].style.visibility="visible";
	}
	
	fotoPerson[n].addEventListener("mouseout", hid);
	function hid ()
	{
//		$(".person").eq(n).fadeOut(200);
		infoPerson[n].style.visibility="hidden";
	}
}

let firstName=document.getElementsByClassName("first_name");
let lastName=document.getElementsByClassName("last_name");
let emailAdr=document.getElementsByClassName("email");
let numberTel=document.getElementsByClassName("tel");
let sendBtn=document.getElementsByClassName("send");


let RegName_First_Last=/[A-Za-z]{1,}/;
let RegEmail=/[A-Za-z]{1,}\@[a-z]{1,}\.[a-z]{1,5}/;
let RegNumber=/\d-\d{3}-\d{3}-\d{2}-\d{2}/;

sendBtn[0].addEventListener("click", checkField);

function checkField() 
{
	if(firstName[0].value!=firstName[0].value.match(RegName_First_Last))
	{
		firstName[0].setAttribute("class", "first_name nosuccess");
	}
	else
	{
		firstName[0].setAttribute("class", "first_name");
	}
	if(lastName[0].value!=lastName[0].value.match(RegName_First_Last))
	{
		lastName[0].setAttribute("class", "last_name nosuccess");
	}
	else
	{
		lastName[0].setAttribute("class", "last_name");
	}
	
	if(emailAdr[0].value!=emailAdr[0].value.match(RegEmail))
	{
		emailAdr[0].setAttribute("class", "email nosuccess");
	}
	else
	{
		emailAdr[0].setAttribute("class", "email");
	}
	if(numberTel[0].value!=numberTel[0].value.match(RegNumber))
	{
		numberTel[0].setAttribute("class", "tel nosuccess");
	}
	else
	{
		numberTel[0].setAttribute("class", "tel");
	}
	
	
}
