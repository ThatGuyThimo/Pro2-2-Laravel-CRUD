let categorys = []

const searchbar = document.getElementById("searchbar");
const searchBTN = document.getElementById("searchBTN");

// searchBTN.onclick(() => {
//     console.log('click')
//     getBlogs()
// })

function updateSelectedCategory(value) {
    const label = document.getElementById(value.name + "LBL")
    if(value.checked) {
        categorys.push(value.name)
        label.style.backgroundColor = "green"
    } else {
        let arrayIndex = categorys.indexOf(value.name)
        categorys.splice(arrayIndex, 1)
        label.style.backgroundColor = ""
    }
    console.log(categorys)
}

function getBlogs() {

    console.log('click')

    let data = new FormData()
    data.append("categorys", categorys)
    data.append("search", searchbar.value)

    console.log(data)

    const url = window.location.href.split("?")[0] + '/getBlogData'
    console.log(url)
    $.ajax({
        url: url,
        method: 'POST',
        data: data,
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(response)
        {

            console.log(response)

            // const row

            // $(table).find('tbody').prepend(row);


            // $(form).trigger("reset");
            // $(modal).modal('hide');
        },
        error: function(response) {
        }
    });
}