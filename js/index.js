document.addEventListener('DOMContentLoaded', function() {
    const ele = document.getElementById('side-scroll');
    ele.style.cursor = 'grab';

    let pos = { top: 0, left: 0, x: 0, y: 0 };

    const mouseDownHandler = function(e) {
        ele.style.cursor = 'grabbing';
        ele.style.userSelect = 'none';

        pos = {
            left: ele.scrollLeft,
            top: ele.scrollTop,
            // Get the current mouse position
            x: e.clientX,
            y: e.clientY,
        };

        document.addEventListener('mousemove', mouseMoveHandler);
        document.addEventListener('mouseup', mouseUpHandler);
    };

    const mouseMoveHandler = function(e) {
        // How far the mouse has been moved
        const dx = e.clientX - pos.x;
        const dy = e.clientY - pos.y;

        // Scroll the element
        ele.scrollTop = pos.top - dy;
        ele.scrollLeft = pos.left - dx;
    };

    const mouseUpHandler = function() {
        ele.style.cursor = 'grab';
        ele.style.removeProperty('user-select');

        document.removeEventListener('mousemove', mouseMoveHandler);
        document.removeEventListener('mouseup', mouseUpHandler);
    };

    // Attach the handler
    ele.addEventListener('mousedown', mouseDownHandler);
});

document.addEventListener('DOMContentLoaded', function() {
    const ele = document.getElementById('side-scroll2');
    ele.style.cursor = 'grab';

    let pos = { top: 0, left: 0, x: 0, y: 0 };

    const mouseDownHandler = function(e) {
        ele.style.cursor = 'grabbing';
        ele.style.userSelect = 'none';

        pos = {
            left: ele.scrollLeft,
            top: ele.scrollTop,
            // Get the current mouse position
            x: e.clientX,
            y: e.clientY,
        };

        document.addEventListener('mousemove', mouseMoveHandler);
        document.addEventListener('mouseup', mouseUpHandler);
    };

    const mouseMoveHandler = function(e) {
        // How far the mouse has been moved
        const dx = e.clientX - pos.x;
        const dy = e.clientY - pos.y;

        // Scroll the element
        ele.scrollTop = pos.top - dy;
        ele.scrollLeft = pos.left - dx;
    };

    const mouseUpHandler = function() {
        ele.style.cursor = 'grab';
        ele.style.removeProperty('user-select');

        document.removeEventListener('mousemove', mouseMoveHandler);
        document.removeEventListener('mouseup', mouseUpHandler);
    };

    // Attach the handler
    ele.addEventListener('mousedown', mouseDownHandler);
});

function addtocart()
{
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
