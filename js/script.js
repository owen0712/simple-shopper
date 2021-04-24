var thetextlist = document.getElementsByClassName("thetext");
var editorlist = document.getElementsByClassName("editor");
var removeitem = document.getElementsByClassName("remove");
for (var i = 0; i < thetextlist.length; i++) {
    thetextlist[i].addEventListener('dblclick', toggleEditor);
}
for (var i = 0; i < editorlist.length; i++) {
    editorlist[i].children[1].addEventListener('click', doEdit);
}

function toggleEditor(ev) {
    var subject = ev.target.innerHTML;
    ev.target.nextElementSibling.children[0].value = subject;
    ev.target.style.display = 'none';
    ev.target.nextElementSibling.style.display = 'inline';
}

function doEdit(ev) {
    var subject = ev.target.previousElementSibling.value;
    var accept = true;
    for (let index = 0; index < thetextlist.length; index++) {

        if (thetextlist[index].textContent == subject) {
            accept = false;
            break;
        }
    }
    if (subject == ev.target.parentElement.previousElementSibling.textContent)
        accept = true;
    if (!accept) {
        swal("Shopping List Name" + subject + " is duplicate. Please reenter.");
    } else {
        swal("The list name is successfully edited!", {
            icon: "success",
        });
        ev.target.parentElement.previousElementSibling.innerHTML = subject;
        ev.target.parentElement.previousElementSibling.style.display = 'inline';
        ev.target.parentElement.style.display = 'none';
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

var list = ["Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten"];

var addList = document.getElementById("myInput");
addList.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        newElement();
    }
});

function newElement() {

    if (list.length == 10) {
        $("#accordionExample").children().remove();
    }
    if (list[0] == null) {
        swal("You can have only have maximum 10 list.");
        return;
    }

    var inputValue = document.getElementById("myInput").value;
    var accept = true;
    for (let index = 0; index < thetextlist.length; index++) {
        if (thetextlist[index].textContent == inputValue) {
            accept = false;
            break;
        }
    }
    if (inputValue === '') {
        swal("You must write something!");
    } else if (!accept) {
        swal("\"" + inputValue + "\" is duplicated, please reenter!");
        return;
    } else {
        var number = list.pop(0);
        let markup = `        
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading${number}">
                <button class="accordion-button collapsed accordion-item-list" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${number}" aria-expanded="false" aria-controls="collapse${number}">
                    <p type="button" class="btn btn-outline-danger deleteList" style="border:none; padding: 0 5px 5px 5px; margin-bottom: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="black" class="bi bi-trash-fill" viewBox="0 0 16 16">                                
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg>                            
                    </p>
                    &nbsp;
                    <h6 class="thetext" >${inputValue}</h6>
                    <div class="editor">
                        <input class="ta1" name="ta1" style="margin-bottom: 5px; border-radius: 3px; width:150px;">
                        <input style="padding: none;" name="submit" id="submit" type="button" value="Edit List Name"  />
                    </div>
            </button>
            </h2>
            <div id="collapse${number}" class="accordion-collapse collapse" aria-labelledby="heading${number}" data-bs-parent="#accordionExample">
                <div class="accordion-body scroll-section">
                    <div class="small-container">
                        <h3 class="text-center"> It is an Empty Shopping List </h3>
                        <p class="text-muted text-center">Add item from <a class="backIndex" style="text-decoration:none;" href="./index.html"> HOME</a> page.</p>
                    </div>
                </div>
            </div>
        </div><br>`;
        $("#accordionExample").append(markup);
        swal({
            title: "Added Succesfully",
            text: "\"" + inputValue + "\" is added succesfully.",
            icon: "success",
        });
        thetextlist = document.getElementsByClassName("thetext");
        editorlist = document.getElementsByClassName("editor");
        thetextlist[thetextlist.length - 1].addEventListener('dblclick', toggleEditor);
        editorlist[editorlist.length - 1].children[1].addEventListener('click', doEdit);
    }
    document.getElementById("myInput").value = "";


    for (i = 0; i < close.length; i++) {
        close[i].onclick = function() {
            var div = this.parentElement;
            div.style.display = "none";
        }
    }

}

function addListId(targetId) {
    list.push(targetId.substring(7, targetId.length));
}

$('body').on('click', '.deleteList', function() {
    swal({
            title: "Are you sure?",
            text: "Once deleted, \"" + $(this).next().text() + "\" will not able to be recovered!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("Your \"" + $(this).next().text() + "\" list has been deleted!", {
                    icon: "success",
                });
                let parent = $(this).parent().parent().parent().parent();
                addListId($(this).parent().parent().attr("id"));
                $(this).parent().parent().parent().next().remove();
                $(this).parent().parent().parent().remove();
                if (list.length == 10) {
                    parent.append(`<h1 class="text-center">Create a new list and manage it.</h1>`);
                }
            } else {
                return;
            }
        });

});

$('main').on('click', '.remove', function() {
    swal({
            title: "Are you sure?",
            text: "Are you sure you want to delete this item?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("The item has been deleted!", {
                    icon: "success",
                });
                let grandParent = $(this).parent().parent().parent().parent().parent().parent();
                let parentRow = $(this).parent().parent().parent().parent();
                let PreviousRow = $(this).parent().parent().parent().parent().prev();
                let priceText = parentRow.children().last().text();
                let price = parseFloat(priceText.substr(3, priceText.length - 1)) * -1;
                calculate(grandParent.parent(), price);
                parentRow.remove();
                if (PreviousRow.parent().children().length == 1) {
                    PreviousRow.parent().parent().next().remove();
                    PreviousRow.parent().remove();
                    grandParent.append(`<h3 class="text-center"> It is an Empty Shopping List </h3>
        <p class="text-muted text-center">Add item from <a class="backIndex" style="text-decoration:none;" href="./index.html"> HOME</a> page.</p>`);
                }
            } else {
                return;
            }
        });

});

$('main').on('change', '.qty', function() {
    var qty = parseInt($(this).val());
    var priceText = $(this).parent().parent().prev().find("small").text();
    var price = parseFloat(priceText.substr(7, priceText.length - 1));
    var parent = $(this).parent().parent().parent().parent().parent().next();
    if (qty == 0)
        return;
    var previousPriceText = $(this).parent().parent().next().html();
    var previousPrice = parseFloat(previousPriceText.substr(3, previousPriceText.length - 1));
    var totalAddedPrice = (qty * price) - previousPrice;


    $(this).parent().parent().next().html("RM " + (qty * price).toFixed(2));
    calculate(parent, totalAddedPrice);
});

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

function calculate(parent, price) {
    var totalTag = parent.find(".totalItemPrice");
    var totalText = totalTag.text();
    var total = parseFloat(totalText.substr(3, totalText.length - 1));
    totalTag.html("RM " + (price + total).toFixed(2));
}