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