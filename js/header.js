//Functions for all the functionalities in the header like redirecting to the shopping cart and the search function

//redirects to the shopping list when the button is pressed or to the sign up page if they are not logged in
function shoppingListClick(){
    const login=JSON.parse(localStorage.getItem('user'));
    if(login===null){
	window.location.href='../src/signin.html';
    }
    else{
    	window.location.href="../src/shoplist.html";
    }
}

//Passes the search term to the search page 
function searchFunc(){
    input = document.getElementById("search");
    var search= input.value;
    console.log(search);
    var newURL="../php/search.php?search="+search;
    window.location.href=newURL;
}

//Search when enter key is pressed when in the search bar
document.getElementById("search").addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        searchFunc();
    }
});