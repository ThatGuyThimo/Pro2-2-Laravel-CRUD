let categorys = []

const searchbar = document.getElementById("searchbar");
const searchBTN = document.getElementById("searchBTN");
const searchForm = document.getElementById("searchForm");

searchBTN.onclick = (e) => {
    e.preventDefault()
    getBlogs()
}

// searchForm.onclick = (e) => {
// 	// e.preventDefault()
//     // updateSelectedCategory(e.target)
//     // getBlogs()
// }

function updateSelectedCategory(value) {
    // console.log(value.checked)
    const label = document.getElementById(value.name + "LBL")
    if(value.checked) {
        categorys.push(value.name)
        label.style.backgroundColor = "green"
    } else {
        let arrayIndex = categorys.indexOf(value.name)
        categorys.splice(arrayIndex, 1)
        label.style.backgroundColor = ""
    }
    // console.log(categorys)
}

function getBlogs() {
    let csrf = document.querySelector('meta[name="_token"]').content;

    let data = new FormData()

    // console.log(categorys)

    data.append("categorys", JSON.stringify(categorys))
    data.append("search", searchbar.value)

    // console.log(data)

    // const url = window.location.href.split("?")[0] + '/getBlogData'
    // console.log(url)

    let xmlhttp = new XMLHttpRequest()

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // console.log(this.responseText)
            const response = JSON.parse(this.responseText)
            // console.log(response)
            const table = document.getElementById("content")
            table.innerHTML = ""
            response.forEach(element => {
                const row = document.createElement("div")
                if (element.status == 1) {

                } else {
                    row.innerHTML = `
                        <div class="m-2 bg-white rounded border-2 border-black p-2">
                        <p class="text-2xl">${element.title}</p>
                        <p class="text-sm">${element.category}</p>
                        <p>${element.content}</p>
                        <a href="/laravel/public/details?id=${element.id}"><button class="p-2 m-1 transition-all duration-300 bg-blue-500 hover:bg-blue-700 rounded text-white">Details</button></a>
                    </div>
                    `
                }
                table.appendChild(row)
            });
        }
    }
    xmlhttp.open("POST", window.location.href.split("/")[0] + '/laravel/public/getBlogData', true)
    xmlhttp.setRequestHeader('X-CSRF-Token', csrf)
    xmlhttp.send(data)
    // $.ajax({
    //     url: url,
    //     method: 'POST',
    //     data: data,
    //     dataType: 'JSON',
    //     contentType: false,
    //     cache: false,
    //     processData: false,
    //     success:function(response)
    //     {

    //         console.log(response)

    //         // const row

    //         // $(table).find('tbody').prepend(row);


    //         // $(form).trigger("reset");
    //         // $(modal).modal('hide');
    //     },
    //     error: function(response) {
    //     }
    // });
}