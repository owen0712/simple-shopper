function shoppingListClick(){
    window.location.href="../src/shoplist.html";
}

function searchFunc(){
    input = document.getElementById("search");
    var search= input.value;
    console.log(search);
    var newURL="../src/search.html?search="+search;
    window.location.href=newURL;
}

document.getElementById("search").addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        searchFunc();
    }
});