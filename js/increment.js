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

function addtocart()
{
    const login=JSON.parse(localStorage.getItem('user'));
    if(login===null){
	console.log('not work')
        swal("You have to sign in first", "It will switch to sign in page in 2 seconds");
        setTimeout(function(){window.location.href='signin.html'}, 2000);
    }
    else{
        swal("Do you want to add this item?",{
            buttons:{
                customise: {
                    text: "Add to cart",
                    value: "customise",
                },
                cancel: "cancel",
            },
        }).then((value) => {
            switch(value){
                case "customise":
                    swal("Choose your cart",{
                        buttons:{
                            1: {
                                text: "Shopping List 1",
                                value: "1",
                            },
                            2: {
                                text: "Shopping List 2",
                                value: "2",
                            },
                            3: {
                                text: "Shopping List 3",
                                value: "3",
                            },
                            cancel: "cancel",
                        }
                    }).then((value) =>{
                        switch(value){
                            case "1":
                                swal('Your item has been added to Shopping List '+ value,"Take me home!", "success");
                                break;

                            case "2":
                                swal('Your item has been added to Shopping List '+ value,"Take me home!", "success");
                                break;

                            case "3":
                                swal('Your item has been added to Shopping List '+ value,"Take me home!", "success");
                                break;
                            
                            default:
                                swal("See you next time :)");
                        }
                    });
                    break;
                
                default: 
                    swal("See you next time :)");
            }
        });
    }
}
