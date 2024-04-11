function renderBook(bookData) {
    const bookDiv = document.createElement("div");
    bookDiv.classList.add("book");

    const img = document.createElement("img");
    img.classList.add("book_cover");
    img.src = bookData.imageSrc;
    img.width = "120";
    img.height = "160";
    img.loading = "lazy";
    img.alt = bookData.id

    const nameDiv = document.createElement("div");
    nameDiv.classList.add("name");
    nameDiv.title = bookData.name;
    nameDiv.textContent = bookData.name;

    const authorDiv = document.createElement("div");
    authorDiv.classList.add("author");
    authorDiv.textContent = bookData.author;

    bookDiv.addEventListener("click", function () {
        window.location.href = `bookDetail.html?id=${bookData.id}`;
    });

    bookDiv.appendChild(img);
    bookDiv.appendChild(nameDiv);
    bookDiv.appendChild(authorDiv);

    return bookDiv;
}

function renderComment(comment_data) {
    const commentDiv = document.createElement("div");
    commentDiv.classList.add("comment-section");

    const avatar = document.createElement('div');
    avatar.classList.add("cmt-ava");

    const info = document.createElement('div');
    info.classList.add("info");

    const cmt_name = document.createElement('div');
    cmt_name.classList.add("cmt-name");
    cmt_name.textContent = comment_data.username;

    const cmt = document.createElement("div");
    cmt.classList.add("comment");
    cmt.textContent = comment_data.comment;

    info.appendChild(cmt_name);
    info.appendChild(cmt);
    commentDiv.appendChild(avatar);
    commentDiv.appendChild(info);

    return commentDiv;
}

export function renderLib(divID, bookData) {
    for (let i = 0; i < 5; i++) {
        let bookElement = renderBook(bookData[0]);
        document.getElementById(divID).appendChild(bookElement);
    }
}

export function renderLibAll(divID, bookData) {
    for (let i = 0; i < bookData.length; i++) {
        let bookElement = renderBook(bookData[i]);
        document.getElementById(divID).appendChild(bookElement);
    }
}

export function renderComments(divID, commentData) {
    for (let i = 0; i < commentData.length; i++) {
        let commentElement = renderComment(commentData[i]);
        document.getElementById(divID).appendChild(commentElement);
    }
    document.getElementById(divID).appendChild(commentElement);
} 