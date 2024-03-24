function renderBook(bookData) {
    const bookDiv = document.createElement("div");
    bookDiv.classList.add("book");

    const img = document.createElement("img");
    img.classList.add("book_cover");
    img.src = bookData.imageSrc;
    img.width = "120";
    img.height = "160";

    const nameDiv = document.createElement("div");
    nameDiv.classList.add("name");
    nameDiv.textContent = bookData.name;

    const authorDiv = document.createElement("div");
    authorDiv.classList.add("author");
    authorDiv.textContent = bookData.author;

    bookDiv.appendChild(img);
    bookDiv.appendChild(nameDiv);
    bookDiv.appendChild(authorDiv);

    return bookDiv;
}

export function renderLib(divID, bookData) {
    for (let i = 0; i < 5; i++) {
        let bookElement = renderBook(bookData[0]);
        document.getElementById(divID).appendChild(bookElement);
    }
}

export function renderLibAll(divID, bookData) {
    for (let i = 0; i < bookData.length; i++) {
        let bookElement = renderBook(bookData[0]);
        document.getElementById(divID).appendChild(bookElement);
    }
}