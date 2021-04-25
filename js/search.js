window.onload=search();

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

//search function

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

function searchFunc(){
    input = document.getElementById("search");
    var search= input.value;
    console.log(search);
    var newURL="../src/search.html?search="+search;
    // newURL=encodeURIComponent(newURL); should have encoding but it doesn't work yet
    window.location.href=newURL;
}
