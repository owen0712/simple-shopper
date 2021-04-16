AOS.init();

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

document.getElementById("searchButton").addEventListener("click", function() {
    var input, filter,shopctg, card, target, txtValue, ctgvalue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    shopctg = document.getElementsByClassName("shopctg");
    for(var i = 0;i<shopctg.length;i++)
    {
        card = shopctg[i].getElementsByClassName("card");
        ctgvalue = 0;
        for(var j = 0;j<card.length;j++)
        {
            target = card[j].getElementsByClassName("card-title")[0];
            txtValue = target.textContent || target.innerText;
            if(txtValue.toUpperCase().indexOf(filter)>-1)
            {
                card[j].style.display = "";
            }else{
                card[j].style.display = "none";
                ctgvalue++;
            }
        }
        if(ctgvalue == card.length)
        {
            shopctg[i].style.display = "none";
        }else{shopctg[i].style.display = "";}
    }
});
