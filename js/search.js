window.onload=search();

//display only relevant products to the serach term based on their names or description
function search(){
    const currentURL=window.location.search;
    const urlParam= new URLSearchParams(currentURL);
    var searchName=urlParam.get('search');

    var input, filter, card, target, txtValue;
    input = document.getElementById("search");
    input.value=searchName;
    filter = input.value.toUpperCase();
    card = document.getElementsByClassName("row mx-auto")[0].getElementsByClassName("col");
    for(var i = 0;i<card.length;i++)
        {
            target = card[i].getElementsByClassName("card-text")[0];
            txtValue = target.textContent || target.innerText;
            if(txtValue.toUpperCase().indexOf(filter)>-1)
            {
                card[i].classList.remove("hide");
            }else{
                card[i].classList.add("hide");
            }
        }
}

//Fiter function that only displays the products in the category
function filter(input)
{
    var ctg, target, card;
    card = document.getElementsByClassName("row mx-auto")[0].getElementsByClassName("col");
    for(var i = 0;i<card.length;i++)
    {
        ctg = card[i].getElementsByClassName("card-category")[0];
        target = ctg.textContent || ctg.innerText;
        if(target == input)
        {
            card[i].classList.remove("hide");
        }else{
            card[i].classList.add("hide");
        }
    }
}

//function to pass serach variable to the new page
function searchFunc(root){
    input = document.getElementById("search");
    var search= input.value;
    console.log(search);
    var newURL=root+"simple-shopper/php/search.php?search="+search;
    window.location.href=newURL;
}
