function shoppingListClick(){
    const login=JSON.parse(localStorage.getItem('user'));
    if(login===null){
	window.location.href='../src/signin.html';
    }
    else{
    	window.location.href="../src/shoplist.html";
    }
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