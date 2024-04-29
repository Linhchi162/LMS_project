document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.querySelector('.book-search');
    var searchResults = document.querySelector('.book3');
    var searchButton = document.querySelector('.Search-button');

    searchButton.addEventListener('click', function () {
        var query = searchInput.value.trim();
        if (query.length > 0) {
            searchBooks(query);
        } else {
            searchResults.innerHTML = '';
        }
    });

    function searchBooks(query) {
        var url = 'https://www.googleapis.com/books/v1/volumes?q=' + query;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                var booksJSON = [];
                data.items.forEach(book => {
                    var id = book.id;
                    var title = book.volumeInfo.title;
                    var authors = book.volumeInfo.authors ? book.volumeInfo.authors.join(', ') : 'Unknown Author';
                    var thumbnail = book.volumeInfo.imageLinks ? book.volumeInfo.imageLinks.thumbnail : '';
                    var description = book.volumeInfo.description ? book.volumeInfo.description : 'No description available';
                    var isbn = book.volumeInfo.industryIdentifiers ? book.volumeInfo.industryIdentifiers.find(identifier => identifier.type === 'ISBN_10') : '';
                    isbn = isbn ? isbn.identifier : 'N/A';

                    var bookJSON = {
                        id: id,
                        title: title,
                        authors: authors,
                        thumbnail: thumbnail,
                        description: description,
                        isbn: isbn
                    };

                    booksJSON.push(bookJSON);
                });
                console.log(booksJSON); // In ra dữ liệu JSON vào console để kiểm tra
                displayResults(data.items);
            })
            .catch(error => console.error('Error:', error));
    }

    function getValidId(str) {
        // Loại bỏ các ký tự không hợp lệ từ id
        return str.replace(/[^a-zA-Z0-9-_]/g, '_');
    }

    function displayResults(books) {
        searchResults.innerHTML = '';

        books.forEach(book => {
            var id = book.id;
            var title = book.volumeInfo.title;
            var authors = book.volumeInfo.authors ? book.volumeInfo.authors.join(', ') : 'Unknown Author';
            var thumbnail = book.volumeInfo.imageLinks ? book.volumeInfo.imageLinks.thumbnail : '';
            var description = book.volumeInfo.description ? book.volumeInfo.description : 'No description available';
            var isbn = book.volumeInfo.industryIdentifiers ? book.volumeInfo.industryIdentifiers.find(identifier => identifier.type === 'ISBN_13') : '';
            isbn = isbn ? isbn.identifier : 'N/A';

            var bookElement = document.createElement('div');
            bookElement.classList.add('book');
            bookElement.innerHTML = `
                <div class="book-left">
                    <img class="book-cover" src="${thumbnail}" alt="Book Cover" width="120px" height="160px">
                    <button data-id="${id}" class="add-book-button">
    Add book
</button>
                </div>
                <div class="book-right">
                    <div class="book-name">${title}</div>
                    <div class="book-author">${authors}</div>
                    <div class="book-isbn">ISBN: ${isbn}</div>
                    <div class="book-description">${description}</div>
                </div>
            `;
            searchResults.appendChild(bookElement);

            var addButton = bookElement.querySelector(`[data-id="${id}"]`);
            addButton.addEventListener('click', function () {
                // Thực hiện hành động khi người dùng nhấp vào nút "Add book"
                // Ví dụ: Hiển thị thông báo hoặc thêm sách vào danh sách sách đã thêm
                console.log('Add book button clicked for:', id);
            });
        });
    }
});
