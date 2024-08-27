let data;
let career_vacancy_html = document.getElementById("career__vacancy");
let career_search = document.getElementById("career__search-input");

function renderVacancy()
{
    for(let i = 0; i < data.length; i++)
    {
    career_vacancy_html.innerHTML += temlplate_html(i);
    }
}
function temlplate_html(i)
{ 
return `
<div class="vacancy__element">
        <p>Вакансия: ${data[i].name}</p>
        <p>Город: ${data[i].city}</p>
        <p>Зарплата: ${data[i].reward} руб</p>
        <a class="vacancy__telefon" href="tel:8-800-77-07-999">8-800-77-07-999</p>
</div>
`;
}


career_search.addEventListener("input", keyupfn);	

function keyupfn()
{
	let q = new RegExp(`${career_search.value}`, "i");
	let buffarr = [];
    career_vacancy_html.innerHTML = "";
	for(let i = 0; i < data.length; i++)
	{
        console.log(data[i].name.match(q));
		if(data[i].name.match(q) != null)
		{
			buffarr.push(data[i]);
            career_vacancy_html.innerHTML += temlplate_html(i);
            
		}
	}
}

// async function go()
// {
//     let res = await fetch("http://127.0.0.1:8000/api/vacancies",
//     {
//     mode: 'no-cors',
//     method: "GET",
//     });
    
//     let a = res.json();
//     a.then(res => console.log(res));
// }
// go()


function vacancies_fn()
{
fetch("http://127.0.0.1:8000/api/vacancies",
{
mode: 'no-cors',
method: "GET",
})
.then(response => response.json())
.then(vacancies => 
    {
        data = vacancies;
        renderVacancy();
    });
}
vacancies_fn()