<!DOCTYPE html>
<html>

<head>
    <title>book</title>
    <link rel="stylesheet" href="css/bookDetail.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho&display=swap" rel="stylesheet">
    <script src="functions.js"></script>
</head>

<body>
    <div class="header">
        <div class="start">logo</div>
        <div class="middle">
            <img class="find" src="img/icons8-search-48.png" width="18" height="18">
            <input class="enterSpace" type="text" placeholder="Search for name or author...">
        </div>
        <div class="end">
            <div class="ava_menu no-select">
                <div>
                    <img class="ava" src="img/81nq+ewtkcL._AC_UF1000,1000_QL80_.jpg">
                </div>
                <div class="account_name">
                    Account name
                </div>
                <img class="drop_down_menu" src="img/icons8-expand-arrow-64.png" width="25px" height="25px">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="menu">
            <button class="home" onclick="goToHome()">
                <img src="img\icons8-home-96.png" width="30" height="30">
                Home
            </button>
            <button class="bookshelf" onclick="goToBookshelf()">
                <img src="img/icons8-bookshelf-96.png" width="30" height="30">
                Bookshelf
            </button>
            <button class="wishlist" onclick="goToWishlist()">
                <img src="img/icons8-bookmark-96.png" width="30" height="30">
                Wishlist
            </button>
            <div>
                <button class="log_out_button" onclick="logOut()">
                    <img src="img/icons8-log-out-96.png" width="30" height="30">
                    Logout
                </button>
            </div>
        </div>
        <div class="main_board">
            <div class="white_container ">
                <div class="white_container2"></div>
                <div class="top">
                    <button class="borrow-button">
                        +
                    </button>
                    <button class="bookmark-button">
                        <img src="img/icons8-bookmark-96.png" width="30px" height="30px">
                    </button>
                    <img class="book_cover" src="img/81nq+ewtkcL._AC_UF1000,1000_QL80_.jpg">
                    <div class="right-column">
                        <div class="genre">
                            <img src="img/icons8-book-96.png" width="25" height="25">
                            <p class="genre-text">
                                Novel
                            </p>
                        </div>
                        <p class="book-name">
                            DUNE
                        </p>
                        <p class="author">
                            Frank Herbert
                        </p>
                        <p class="isbn">
                            Release year:
                        <p class="isbn-number">
                            1965
                        </p>
                        </p>
                        <p style ="display: inline-block;">
                            Instock:
                        </p>
                        <p class="Instock-number"
                         style ="display: inline-block;">
                            3
                        </p>
                        <p style="font-size: 16px;">
                            Description
                        </p>
                        <p class="description no-text-cursor">
                            Herbert's evocative, epic tale is set on the desert planet Arrakis,
                            the focus for a complex political and military struggle with galaxy-wid
                            repercussions. Arrakis is the source of spice, a mind enhancing drug which
                            makes interstellar travel possible, and therefore the most valuable substance
                            in the galaxy. When Duke Atreides and his family take up court there, they
                            fall into a trap set by his rival, Baron Harkonnen. The Duke is poisoned,
                            but his wife and her son Paul escape to the vast and arid deserts of Arrakis,
                            which have given it the name Dune. They join the Fremen, natives of the planet
                            who have learnt to live in this harsh and complex ecosystem. But learning to
                            survive is not enough - Paul's destiny was mapped out long ago and his mother
                            is committed to seeing it fulfilled.
                        </p>
                    </div>
                </div>
                <div class="bottom" >
                    <p style="color: rgb(16, 134, 134);
                     font-weight: 700;">
                        COMMENT
                    </p>

                    <input class="commentBar" type="text" placeholder="Write your comments here...">
                    <button class="add-cmt">
                        <img src="img/icons8-send-48.png" width="40px" height="40px">
                    </button>
                    <div class="comments">
                        <div class="comment-section">
                            <div class="cmt-ava">
                            </div>
                            <p class="cmt-name">
                                Linh chee
                            </p>
                            <div class="comment">
                                HAY!
                            </div>
                        </div>
                        <div class="comment-section">
                            <div class="cmt-ava">
                            </div>
                            <p class="cmt-name">
                                Linh chee
                            </p>
                            <div class="comment">
                                kkkkkkk!
                            </div>
                        </div>
                        <div class="comment-section">
                            <div class="cmt-ava">
                            </div>
                            <p class="cmt-name">
                                Linh chee
                            </p>
                            <div class="comment">
                                KHÔNG HAY!
                            </div>
                        </div>
                    </div>
                </div>

                
                </div>
            </div>

        </div>
    </div>
    </div>
</body>

</html>