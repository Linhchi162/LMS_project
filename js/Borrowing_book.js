import { renderLibAll } from "./render.js";

document.addEventListener("DOMContentLoaded", function() {
    let bookData = [
        {
        imageSrc: "../img/81nq+ewtkcL._AC_UF1000,1000_QL80_.jpg",
        author: "author",
        name: "name"
        }
    ]
    renderLibAll("borrowing-book", bookData);
});
