AOS.init();
window.load=doShowAll();
window.onload=search();

const ele = document.getElementsByClassName('side-scroll');
ele.scrollTop = 100;
ele.scrollLeft = 150;

let pos = { top: 0, left: 0, x: 0, y: 0 };

const mouseMoveHandler = function(e) {
    // How far the mouse has been moved
    const dx = e.clientX - pos.x;
    const dy = e.clientY - pos.y;

    // Scroll the element
    ele.scrollTop = pos.top - dy;
    ele.scrollLeft = pos.left - dx;
};

//search function

// document.getElementById("searchButton").addEventListener("click", function() {
//     var input, filter,shopctg, card, target, txtValue, ctgvalue;
//     input = document.getElementById("search");
//     filter = input.value.toUpperCase();
//     shopctg = document.getElementsByClassName("shopctg");
//     for(var i = 0;i<shopctg.length;i++)
//     {
//         card = shopctg[i].getElementsByClassName("card");
//         ctgvalue = 0;
//         for(var j = 0;j<card.length;j++)
//         {
//             target = card[j].getElementsByClassName("card-title")[0];
//             txtValue = target.textContent || target.innerText;
//             if(txtValue.toUpperCase().indexOf(filter)>-1)
//             {
//                 card[j].style.display = "";
//             }else{
//                 card[j].style.display = "none";
//                 ctgvalue++;
//             }
//         }
//         if(ctgvalue == card.length)
//         {
//             shopctg[i].style.display = "none";
//         }else{shopctg[i].style.display = "";}
//     }
// });


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

function filter(input)
{
    var ctg, target, card;
    card = document.getElementsByClassName("row mx-auto")[0].getElementsByClassName("col");
    for(var i = 0;i<card.length;i++)
    {
        ctg = card[i].getElementsByClassName("card-category")[0];
        target = ctg.textContent || target.innerText;
        if(target == input)
        {
            card[i].classList.remove("hide");
        }else{
            card[i].classList.add("hide");
        }
    }
}

function wcqib_refresh_quantity_increments() {
    jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
        var c = jQuery(b);
        c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
    })
}
String.prototype.getDecimals || (String.prototype.getDecimals = function() {
    var a = this,
        b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
    return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
}), jQuery(document).ready(function() {
    wcqib_refresh_quantity_increments()
}), jQuery(document).on("updated_wc_div", function() {
    wcqib_refresh_quantity_increments()
}), jQuery(document).on("click", ".plus, .minus", function() {
    var a = jQuery(this).closest(".quantity").find(".qty"),
        b = parseFloat(a.val()),
        c = parseFloat(a.attr("max")),
        d = parseFloat(a.attr("min")),
        e = a.attr("step");
    b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
});
// When the user scrolls the page, execute myFunction
window.onscroll = function() { myFunction() };

// Get the header
var header = document.getElementById("fixedScreen");

// Get the offset position of the navbar
var sticky = header.offsetTop;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}
$(document).ready(function() {
    var mokData = [
        { category: "Material", id: '1', name: 'Brakedown of machine' },
        { category: "Material", id: '2', name: 'Brakedown of machine' },
        { category: "Tool", id: '3', name: 'Brakedown of machine' },
        { category: "Tool", id: '4', name: 'Brakedown of line' },
        { category: "Tool", id: '5', name: 'Brakedown of machine' },
        { category: "Tool", id: '6', name: 'Brakedown of line' },
        { category: "Tool", id: '7', name: 'Brakedown of machine' },
        { category: "Tool", id: '8', name: 'Brakedown of line' }
    ];
    /*<img src="Paper product/Paper Product-9.jpg" class="card-img-top" alt="Wax Paper" height="auto" width="auto">
                                        <div class="card-body">
                                            <h5 class="card-title">Reynolds</h5>
                                            <p class="card-text">Reynolds Wax Paper Sandwich Bag 50pcs</p>
                                            <p style="font-size: small; float: right;"> RM 6.99/each</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="quantity buttons_added" style="float: left;">
                                                <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                                                    value="+" class="plus">
                                            </div>
                                            <button type="button" class="btn btn-success" style="float: right;">Add to cart</button>
                                        </div>*/

    $.each(mokData, function(i) {

        //var templateString = '<article class="card"><h2>' + mokData[i].category + '</h2><p>' + mokData[i].name + '</p><p>' + mokData[i].id + '</p><button id="tes">Start</button></article>';
        //$('#test12').append(templateString);

    })

    for (var i = 0; i < 3; i++) {

        for (j = 0; j < 4; j++) {
            var templateString = '<div class="card"><img src="Paper product/Paper Product-9.jpg" class="card-img-top" alt="Wax Paper" height="auto" width="auto"> <div class="card-body"> <h5 class="card-title">Reynolds</h5><p class="card-text">Reynolds Wax Paper Sandwich Bag 50pcs</p><p style="font-size: small; float: right;"> RM 6.99/each</p></div><div class="card-body"><div class="quantity buttons_added" style="float: left;"><input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"value="+" class="plus"></div><button type="button" class="btn btn-success" style="float: right;">Add to cart</button></div></div>';
            $('#test12').append(templateString + '&nbsp');
        }

    }

    $("#test12");
});

// list functionality

function shoppingListClick(){
    window.location.href="../src/shoplist.html";
}

function CheckBrowser() {
    if ('localStorage' in window && window['localStorage'] !== null) {
        // We can use localStorage object to store data.
        return true;
    } else {
            return false;
    }
}

function doShowAll() {
    if (CheckBrowser()) {
        var key = "";
        var list = "<tr><th>Shopping List</th><th> </th></tr>\n";
        var i = 0;
        for (i = 0; i <= localStorage.length-1; i++) {
            key = localStorage.key(i);
            list += "<tr><td>" + key + "</td>\n<td>"
                    + localStorage.getItem(key) + "</td></tr>\n";
        }
        //If no item exists in the cart.
        document.getElementById('list').innerHTML = list;
    } else {
        alert('Cannot save shopping list as your browser does not support HTML 5');
    }
}

function searchFunc(){
    input = document.getElementById("search");
    var search= input.value;
    console.log(search);
    var newURL="../src/search.html?search="+search;
    // newURL=encodeURIComponent(newURL); should have encoding but it doesn't work yet
    window.location.href=newURL;
}
