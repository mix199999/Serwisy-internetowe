function changeBodyBackground(color) {
    document.body.style.backgroundColor = color;
}
document.getElementById("Colorsubmit").addEventListener("click", function() {
    let color = document.getElementById("favcolor").value;
    changeBodyBackground(color);
    console.log(color);
});
