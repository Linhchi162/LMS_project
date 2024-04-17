import { renderLib } from './render.js';

document.addEventListener("DOMContentLoaded", function() {
    let bookData1 = [
        {
        id: 1,
        imageSrc: "../img/81nq+ewtkcL._AC_UF1000,1000_QL80_.jpg",
        author: "author",
        name: "name"
        }
    ]

    let bookData2 = [
        {
        id: 1,
        imageSrc: "../img/81nq+ewtkcL._AC_UF1000,1000_QL80_.jpg",
        author: "author",
        name: "name"
        }
    ]

    renderLib("borrowing-book-small", bookData1);
    renderLib("borrowed-book-small", bookData2);
});