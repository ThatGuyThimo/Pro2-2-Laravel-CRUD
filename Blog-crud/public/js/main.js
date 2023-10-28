function updateSelectedCategory(value) {
    const label = document.getElementById(value.name + "LBL")
    if(value.checked) {
        label.style.backgroundColor = "green"
    } else {
        label.style.backgroundColor = ""
    }
}