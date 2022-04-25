let presentation_slider_btn_left=document.getElementsByClassName("presentation__slider-btn_larr");
let presentation_slider_btn_right=document.getElementsByClassName("presentation__slider-btn_rarr");
let slider_img=document.getElementsByClassName("presentation_slider-img");

let slider_dot=document.getElementsByClassName("presentation__slider-dot");

slider_dot[0].addEventListener("click", choice_dot_one);
function choice_dot_one()
{
	Dots.remove_active_dot();
	Dots.zero_dot();
}
slider_dot[1].addEventListener("click", choice_dot_two);
function choice_dot_two()
{
	Dots.remove_active_dot();
	Dots.first_dot();
}
slider_dot[2].addEventListener("click", choice_dot_three);
function choice_dot_three()
{
	Dots.remove_active_dot();
	Dots.second_dot();
}
slider_dot[3].addEventListener("click", choice_dot_four);
function choice_dot_four()
{
	Dots.remove_active_dot();
	Dots.third_dot();
}


presentation_slider_btn_left[0].addEventListener("click", previous);
presentation_slider_btn_right[0].addEventListener("click", next);

let Dots=
	{
		zero_dot()
		{
			slider_img[0].setAttribute("class", "presentation_slider-img position_one");
			slider_img[1].setAttribute("class", "presentation_slider-img position_two");
			slider_img[2].setAttribute("class", "presentation_slider-img position_three");
			slider_img[3].setAttribute("class", "presentation_slider-img position_four");
			
			slider_dot[0].setAttribute("class", "presentation__slider-dot active-dot");
		},
		first_dot()
		{
			slider_img[0].setAttribute("class", "presentation_slider-img position_two_minus");
			slider_img[1].setAttribute("class", "presentation_slider-img position_one");
			slider_img[2].setAttribute("class", "presentation_slider-img position_two");
			slider_img[3].setAttribute("class", "presentation_slider-img position_three");
			
			slider_dot[1].setAttribute("class", "presentation__slider-dot active-dot");
		},
		second_dot()
		{
			slider_img[0].setAttribute("class", "presentation_slider-img position_three_minus");
			slider_img[1].setAttribute("class", "presentation_slider-img position_two_minus");
			slider_img[2].setAttribute("class", "presentation_slider-img position_one");
			slider_img[3].setAttribute("class", "presentation_slider-img position_two");
			
			slider_dot[2].setAttribute("class", "presentation__slider-dot active-dot");
		},
		third_dot()
		{
			slider_img[0].setAttribute("class", "presentation_slider-img position_four_minus");
			slider_img[1].setAttribute("class", "presentation_slider-img position_three_minus");
			slider_img[2].setAttribute("class", "presentation_slider-img position_two_minus");
			slider_img[3].setAttribute("class", "presentation_slider-img position_one");
			
			slider_dot[3].setAttribute("class", "presentation__slider-dot active-dot");
		},
		for_Prev_arr_one()
		{
			slider_img[0].setAttribute("class", "presentation_slider-img position_three_minus");
			slider_img[1].setAttribute("class", "presentation_slider-img position_two_minus");
			slider_img[2].setAttribute("class", "presentation_slider-img position_one");
			slider_img[3].setAttribute("class", "presentation_slider-img position_two");
			
			slider_dot[2].setAttribute("class", "presentation__slider-dot active-dot");
		},
		for_Prev_arr_two()
		{
			slider_img[0].setAttribute("class", "presentation_slider-img position_two_minus");
			slider_img[1].setAttribute("class", "presentation_slider-img position_one");
			slider_img[2].setAttribute("class", "presentation_slider-img position_two");
			slider_img[3].setAttribute("class", "presentation_slider-img position_three");
			
			slider_dot[1].setAttribute("class", "presentation__slider-dot active-dot");
		},
		remove_active_dot()
		{
			for(let i=0; i<slider_dot.length; i++)
			{
				slider_dot[i].setAttribute("class","presentation__slider-dot");
			}
		}
	};

let NextSlide=
	{
		functNext()
		 {
			switch(slider_img[0].getAttribute("class"))
			{
			case "presentation_slider-img position_one":
			Dots.remove_active_dot();	
			Dots.first_dot();	
			break;
				
			case "presentation_slider-img position_two_minus":
			Dots.remove_active_dot();
			Dots.second_dot();
			break;	
			
			case "presentation_slider-img position_three_minus":
			Dots.remove_active_dot();		
			Dots.third_dot();
			break;	
				
			default: ;
			}
	;}
};

let PreviousSlide=
	{
		functPrev()
		{
			switch(slider_img[0].getAttribute("class"))
			{
			case "presentation_slider-img position_four_minus":
			Dots.remove_active_dot();		
			Dots.for_Prev_arr_one();
			break;
				
			case "presentation_slider-img position_three_minus":
			Dots.remove_active_dot();		
			Dots.for_Prev_arr_two();
			break;

			case "presentation_slider-img position_two_minus":
			Dots.remove_active_dot();		
			Dots.zero_dot();
			break;	
			
			default: ;
			}
	;}
};

function next()
{
	NextSlide.functNext();
}

function previous()
{
	PreviousSlide.functPrev();
}

<<<<<<< HEAD
//let catalog_btn=document.getElementsByClassName("header__btn");
//let header_catalog=document.getElementsByClassName("header__catalog");
//
//catalog_btn[0].addEventListener("click", open_catalog);
//
//function open_catalog()
//{
//	if(header_catalog[0].style.display=="none")
//		{
//			header_catalog[0].style.display="block";
//			catalog_btn[0].setAttribute("class"," header__btn header__btn-click");
//		}
//	else
//	{
//		header_catalog[0].style.display="none";
//		catalog_btn[0].setAttribute("class"," header__btn");
//	}
//}
=======
// let catalog_btn=document.getElementsByClassName("header__btn");
// let header_catalog=document.getElementsByClassName("header__catalog");

// catalog_btn[0].addEventListener("click", open_catalog);

// function open_catalog()
// {
// 	if(header_catalog[0].style.display=="none")
// 		{
// 			header_catalog[0].style.display="block";
// 			catalog_btn[0].setAttribute("class"," header__btn header__btn-click");
// 		}
// 	else
// 	{
// 		header_catalog[0].style.display="none";
// 		catalog_btn[0].setAttribute("class"," header__btn");
// 	}
// }
>>>>>>> a4631aaf99435758013a3a3b952cbaa107d196fb

let person_icon_btn=document.getElementsByClassName("person-icon");

let person_menu=document.getElementsByClassName("header__person-menu");

person_icon_btn[0].addEventListener("click", open_person_menu);

function open_person_menu()
{
	if(person_menu[0].style.display=="none")
	{
		person_menu[0].style.display="block";
	}
	else
	{
		person_menu[0].style.display="none";
	}
}

let info_icon_btn=document.getElementsByClassName("header__info-icon");

let info_menu=document.getElementsByClassName("header__info-menu");

info_icon_btn[0].addEventListener("click", open_info_menu);

function open_info_menu()
{
	if(info_menu[0].style.display=="none")
		{
			info_menu[0].style.display="block";
		}
	else
		{
			info_menu[0].style.display="none";
		}
}


let brends__slider_btn_larr=document.getElementsByClassName("brends__slider-btn_larr");

let brends__slider_btn_rarr=document.getElementsByClassName("brends__slider-btn_rarr");

let brends__slider_part_one=document.getElementsByClassName("popular-brends__slider-part-one");

let brends__slider_part_two=document.getElementsByClassName("popular-brends__slider-part-two");

brends__slider_btn_larr[0].addEventListener("click", brends_btn_previuos);

brends__slider_btn_rarr[0].addEventListener("click", brends_btn_next);

function brends_btn_previuos()
	{
		if(brends__slider_part_one[0].getAttribute("class")=="popular-brends__slider-part-one position__popular-brends__one")
			{
				brends__slider_part_one[0].setAttribute("class", "popular-brends__slider-part-one");
				brends__slider_part_two[0].setAttribute("class", "popular-brends__slider-part-two position__popular-brends__two");
			}
	
	}

function brends_btn_next()
{
	if(brends__slider_part_one[0].getAttribute("class")=="popular-brends__slider-part-one")
		{
			brends__slider_part_one[0].setAttribute("class", "popular-brends__slider-part-one position__popular-brends__one");
			brends__slider_part_two[0].setAttribute("class", "popular-brends__slider-part-two");
		}
}
