let menu_btn = document.getElementById("nav__open-close");
let menu_ul = document.getElementById("nav__ul");
let menu_elements = document.getElementsByClassName("nav__element");

menu_btn.addEventListener("click", function()
{
    if(menu_ul.getAttribute("data-state") == "false")
    {
        for(let i = 1; i < menu_elements.length; i++)
        {
            menu_elements[i].setAttribute("class", "nav__element opened");
        }
        menu_ul.setAttribute("data-state", "true");
    }
    else
    {
        for(let i = 1; i < menu_elements.length; i++)
        {
            menu_elements[i].setAttribute("class", "nav__element closed");
        }
        menu_ul.setAttribute("data-state", "false");
    }
});
