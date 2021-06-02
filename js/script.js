//To store the shopping list name's text edit area element
var thetextlist = document.getElementsByClassName("thetext");
// var editorlist = document.getElementsByClassName("editor");

//add event listener of toggleEditor() and doEdit() for every shopping list.
for (var i = 0; i < thetextlist.length; i++) {
    thetextlist[i].addEventListener('dblclick', toggleEditor);
}

//toggle the edit shopping list text area for editing
function toggleEditor(ev) {
    ev.target.style.display = 'none';
    ev.target.nextElementSibling.style.display = 'inline';
}


//control the quantity "add" button, "minus button" and the input number area shown
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

$('main').on('change', '.qty', function(e) {
    var PID = $(this).parent().find(".ProID").val();
    var LID = $(this).parent().find(".ListID").val();
    var product_description = $(this).parent().find(".ProDescription").val();
    var qty = parseInt($(this).val());
    var priceText = $(this).parent().parent().prev().find("small").text();
    var price = parseFloat(priceText.substr(7, priceText.length - 1));
    var parent = $(this).parent().parent().parent().parent().parent().next();
    var previousPriceText = $(this).parent().parent().next().html();
    var previousPrice = parseFloat(previousPriceText.substr(3, previousPriceText.length - 1));
    var totalAddedPrice = (qty * price) - previousPrice;
    if (isNaN(qty)) {
        swal("Please input a value!!!!!", { icon: "warning" });
        qty = (previousPrice / price).toFixed(0);
        $(this).val(qty);
        return;
    }
    if (qty == 0) {
        confirmDeleteItem(PID, LID, product_description);
        qty = (previousPrice / price).toFixed(0);
        $(this).val(qty);
        return;
    }


    $(this).parent().parent().next().html("RM " + (qty * price).toFixed(2));
    calculate(parent, totalAddedPrice);
    $.ajax({
        url: 'editQuantity.php',
        data: { quantity: $(this).val(), ListID: LID, ProID: PID, },
        method: "POST"
    })
});

//automatically change the subtotal price and total price in the shopping list
//when user click on "minus" button on the left of input number area
$('main').on('click', '.minus', function() {
    var qty = parseInt($(this).next().val()) - 1;
    var priceText = $(this).parent().parent().prev().find("small").text();
    var price = parseFloat(priceText.substr(7, priceText.length - 1));
    var parent = $(this).parent().parent().parent().parent().parent().next();
    if (qty == 0)
        return;
    $(this).parent().parent().next().html("RM " + (qty * price).toFixed(2));
    calculate(parent, -price);
});

//automatically change the subtotal price and total price in the shopping list
//when user click on "plus" button on the right of input number area
$('main').on('click', '.plus', function() {
    var qty = parseInt($(this).prev().val()) + 1;
    var priceText = $(this).parent().parent().prev().find("small").text();
    var price = parseFloat(priceText.substr(7, priceText.length - 1));
    var parent = $(this).parent().parent().parent().parent().parent().next();
    if (qty == 0)
        return;
    $(this).parent().parent().next().html("RM " + (qty * price).toFixed(2));
    calculate(parent, price);
});

//automatically re-calculate the total price when the quantity is change
function calculate(parent, price) {
    var totalTag = parent.find(".totalItemPrice");
    var totalText = totalTag.text();
    var total = parseFloat(totalText.substr(3, totalText.length - 1));
    totalTag.html("RM " + (price + total).toFixed(2));
}

function confirmDeleteList(Lid, Lname) {
    console.log("Hello" + Lname);
    swal({
            title: "Are you sure?",
            text: "Once deleted, \"" + Lname + "\" will not able to be recovered!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("Your \"" + Lname + "\" list has been deleted!", {
                    icon: "success"
                });
                location.href = "deleteShoppingList.php?id=" + Lid;
                return true;
            } else {
                return false;
            }
        });

}

function confirmDeleteItem(Pid, Lid, product_description) {
    swal({
            title: "Are you sure?",
            text: "Are you sure you want to delete " + product_description + " ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("The item has been deleted!", {
                    icon: "success"
                });
                location.href = "deleteShoppingList.php?Product_id=" + Pid + "&List_id=" + Lid;
            } else {
                return;
            }
        });
}