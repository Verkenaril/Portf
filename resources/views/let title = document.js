let title = document.getElementsByClassName("product-card-description__title")[0].innerHTML;
let spec_title_guarantee = document.getElementsByClassName("product-characteristics__spec-title")[0].innerHTML;
let spec_value_guarantee = document.getElementsByClassName("product-characteristics__spec-value")[0].innerHTML;
let spec_title_country = document.getElementsByClassName("product-characteristics__spec-title")[1].innerHTML;
let spec_value_country = document.getElementsByClassName("product-characteristics__spec-value")[0].innerHTML;

let spec_title_type = document.getElementsByClassName("product-characteristics__spec-title")[2].innerHTML;
let spec_value_type = document.getElementsByClassName("product-characteristics__spec-value")[2].innerHTML;
let spec_title_model = document.getElementsByClassName("product-characteristics__spec-title")[3].innerHTML;
let spec_value_model = document.getElementsByClassName("product-characteristics__spec-value")[3].innerHTML;
let spec_title_release = document.getElementsByClassName("product-characteristics__spec-title")[4].innerHTML;
let spec_value_release = document.getElementsByClassName("product-characteristics__spec-value")[4].innerHTML;

let spec_title_color_back_panel = document.getElementsByClassName("product-characteristics__spec-title")[5].innerHTML;
let spec_value_color_back_panel = document.getElementsByClassName("product-characteristics__spec-value")[5].innerHTML;
let spec_title_color_edge = document.getElementsByClassName("product-characteristics__spec-title")[6].innerHTML;
let spec_value_color_edge = document.getElementsByClassName("product-characteristics__spec-value")[6].innerHTML;
let spec_title_color_default = document.getElementsByClassName("product-characteristics__spec-title")[7].innerHTML;
let spec_value_color_default = document.getElementsByClassName("product-characteristics__spec-value")[7].innerHTML;

let spec_title_range_frequency_2G = document.getElementsByClassName("product-characteristics__spec-title")[8].innerHTML;
let spec_value_range_frequency_2G = document.getElementsByClassName("product-characteristics__spec-value")[8].innerHTML;
let spec_title_range_frequency_3G = document.getElementsByClassName("product-characteristics__spec-title")[9].innerHTML;
let spec_value_range_frequency_3G = document.getElementsByClassName("product-characteristics__spec-value")[9].innerHTML;
let spec_title_support_frequency_4G = document.getElementsByClassName("product-characteristics__spec-title")[10].innerHTML;
let spec_value_support_frequency_4G = document.getElementsByClassName("product-characteristics__spec-value")[10].innerHTML;
let spec_title_range_frequency_4G = document.getElementsByClassName("product-characteristics__spec-title")[11].innerHTML;
let spec_value_range_frequency_4G = document.getElementsByClassName("product-characteristics__spec-value")[11].innerHTML;
let spec_title_support_frequency_5G = document.getElementsByClassName("product-characteristics__spec-title")[12].innerHTML;
let spec_value_support_frequency_5G = document.getElementsByClassName("product-characteristics__spec-value")[12].innerHTML;
let spec_title_SIM_format = document.getElementsByClassName("product-characteristics__spec-title")[13].innerHTML;
let spec_value_SIM_format = document.getElementsByClassName("product-characteristics__spec-value")[13].innerHTML;
let spec_title_quantity_SIM = document.getElementsByClassName("product-characteristics__spec-title")[14].innerHTML;
let spec_value_quantity_SIM = document.getElementsByClassName("product-characteristics__spec-value")[14].innerHTML;
let spec_title_screen_diagonal = document.getElementsByClassName("product-characteristics__spec-title")[15].innerHTML;
let spec_value_screen_diagonal = document.getElementsByClassName("product-characteristics__spec-value")[15].innerHTML;
let spec_title_screen_resolution = document.getElementsByClassName("product-characteristics__spec-title")[16].innerHTML;
let spec_value_screen_resolution = document.getElementsByClassName("product-characteristics__spec-value")[16].innerHTML;
let spec_title_matrix_technology = document.getElementsByClassName("product-characteristics__spec-title")[17].innerHTML;
let spec_value_matrix_technology = document.getElementsByClassName("product-characteristics__spec-value")[17].innerHTML;
let spec_title_matrix_type = document.getElementsByClassName("product-characteristics__spec-title")[18].innerHTML;
let spec_value_matrix_type = document.getElementsByClassName("product-characteristics__spec-value")[18].innerHTML;
let spec_title_screen_refresh_rate = document.getElementsByClassName("product-characteristics__spec-title")[19].innerHTML;
let spec_value_screen_refresh_rate = document.getElementsByClassName("product-characteristics__spec-value")[19].innerHTML;
let spec_title_pixel_density = document.getElementsByClassName("product-characteristics__spec-title")[20].innerHTML;
let spec_value_pixel_density = document.getElementsByClassName("product-characteristics__spec-value")[20].innerHTML;
let spec_title_quantity_color = document.getElementsByClassName("product-characteristics__spec-title")[21].innerHTML;
let spec_value_quantity_color = document.getElementsByClassName("product-characteristics__spec-value")[21].innerHTML;

let spec_title_corpus_type = document.getElementsByClassName("product-characteristics__spec-title")[22].innerHTML;
let spec_value_corpus_type = document.getElementsByClassName("product-characteristics__spec-value")[22].innerHTML;
let spec_title_corpus_material = document.getElementsByClassName("product-characteristics__spec-title")[23].innerHTML;
let spec_value_corpus_material = document.getElementsByClassName("product-characteristics__spec-value")[23].innerHTML;

let spec_title_operating_system = document.getElementsByClassName("product-characteristics__spec-title")[24].innerHTML;
let spec_value_operating_system = document.getElementsByClassName("product-characteristics__spec-value")[24].innerHTML;
let spec_title_operating_system_version = document.getElementsByClassName("product-characteristics__spec-title")[25].innerHTML;
let spec_value_operating_system_version = document.getElementsByClassName("product-characteristics__spec-value")[25].innerHTML;
let spec_title_model_processor = document.getElementsByClassName("product-characteristics__spec-title")[26].innerHTML;
let spec_value_model_processor = document.getElementsByClassName("product-characteristics__spec-value")[26].innerHTML;
let spec_title_quantity_core = document.getElementsByClassName("product-characteristics__spec-title")[27].innerHTML;
let spec_value_quantity_core = document.getElementsByClassName("product-characteristics__spec-value")[27].innerHTML;
let spec_title_max_frequency_processor = document.getElementsByClassName("product-characteristics__spec-title")[28].innerHTML;
let spec_value_max_frequency_processor = document.getElementsByClassName("product-characteristics__spec-value")[28].innerHTML;
let spec_title_config_processor = document.getElementsByClassName("product-characteristics__spec-title")[29].innerHTML;
let spec_value_config_processor = document.getElementsByClassName("product-characteristics__spec-value")[29].innerHTML;
let spec_title_techno_process = document.getElementsByClassName("product-characteristics__spec-title")[30].innerHTML;
let spec_value_techno_process = document.getElementsByClassName("product-characteristics__spec-value")[30].innerHTML;
let spec_title_graphics_accelerator = document.getElementsByClassName("product-characteristics__spec-title")[31].innerHTML;
let spec_value_graphics_accelerator = document.getElementsByClassName("product-characteristics__spec-value")[31].innerHTML;


document.getElementsByClassName("button-ui button-ui_white button-ui_md product-characteristics__expand")[0].click();
let el_spec = document.getElementsByClassName("product-characteristics__spec");
let el_title = document.getElementsByClassName("product-characteristics__spec-title");
let el_value = document.getElementsByClassName("product-characteristics__spec-value");
let arr = [];

setTimeout(function()
{
    for(let i = 0; i < el_spec.length; i++)
        {
            arr.push([el_title[i].innerText, el_value[i].innerText]);
        }
        fetch("http://127.0.0.1:8000/api/addsmart",
            {
                method: "POST",
                body: JSON.stringify(arr),
                headers: {"content-type" : "application/json"}
            }
        )
        .then(res => res.json())
        .then(data => console.log(data))
}, 300)


../storage/ebook/5/eccacaa9215038634067fcb503b2bcf71a81f2d23cfe98d13da871c9e4a4ab90.jpg.webp