let slider_company_wrapper = document.getElementById("slider-company__wrapper");

let coordX_start;
let coordX_end;
let mob_coordX_end;
let mob_coordX_start;
let translate_slider = 0;

function fn_slider(e)
{
    coordX_end = e.clientX - coordX_start;
    slider_company_wrapper.style.transform = `translateX(${translate_slider + coordX_end}px)`;
}
slider_company_wrapper.addEventListener("mousedown", function(e) 
{
    coordX_start = e.clientX;
    

    slider_company_wrapper.addEventListener("mousemove", fn_slider);
});

slider_company_wrapper.addEventListener("mouseup", function(e)
{
    translate_slider = translate_slider + coordX_end;
    slider_company_wrapper.removeEventListener("mousemove", fn_slider);
});

// -------------------touch

function fn_mob_slider(e)
{
    mob_coordX_end = e.targetTouches[0].clientX - mob_coordX_start;
    slider_company_wrapper.style.transform = `translateX(${translate_slider + mob_coordX_end}px)`;
}
slider_company_wrapper.addEventListener("touchstart", function(e) 
{

    mob_coordX_start = e.targetTouches[0].clientX;
    slider_company_wrapper.addEventListener("touchmove", fn_mob_slider);
});

slider_company_wrapper.addEventListener("touchend", function(e)
{
    translate_slider = translate_slider + mob_coordX_end;
    slider_company_wrapper.removeEventListener("touchmove", fn_mob_slider);
});

