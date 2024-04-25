<header>
    <nav>
        <div class="topnav">
            <div class="the-left-side">
             
                    <!-- <a href="profile-page.php" class="no-styles"> -->
                        <i class='bx bxl-facebook-circle facebook-icon'  id="facebookIcon">
                            
                        </i>
                    <!-- </a> -->

                <form action="details.php" method="post" class="search-bar-form">
                    <!-- <input type="text" placeholder="Search Facebook" name="search" id="search" class="search-bar"> -->

                     <!-- Search Bar -->
                    <div class="search-bar-container">
                        <i class='bx bx-search-alt search-icon'></i>
                        <input type="text" placeholder="Search Facebook" name="search" id="search" class="search-bar">
                    </div>

                    <div class="col-md-5">
                    <div class="show-results" id="show-list">
                        <!-- Here autocomplete list will be display -->
                    </div>
                </div>
                </form>

                

            </div>

            <div class="right-side">
                <div class="dropdown">
                    <!-- <span class="logoutBtn">Logout</span> -->
                    <img src="../default_images/default facebook photo.jpg" alt="profile picture" class="small-profile extra-small-profile">
                    <div class="dropdown-content logoutBtn">
                        <a href="logout.php" class="logout-press">
                            <p>Logout</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
document.getElementById("facebookIcon").addEventListener("click", function() {
    window.location.href = "news-feed.php";
});

document.getElementById("btnLogout").addEventListener("click", function() {
    window.location.href = "logout.php";
});
</script>
