<style>
  .search-bar-container {
            position: relative;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            margin-top: 1em;
        }

        .search-icon {
            position: absolute;
            left: 25px;
            color: #777;
            font-size: 20px;
        }

        .search-bar {
            width: calc(100% - 30px);
            margin-top: 1em;
            background: #F0F2F5;
            margin-left: 0.3em;
            font-weight: 300;
        }

</style>

<header>
    <nav>
        <div class="topnav">
            <div class="the-left-side">
             
                    <!-- <a href="profile-page.php" class="no-styles"> -->
                        <i class='bx bxl-facebook-circle facebook-icon'  id="facebookIcon">
                            
                        </i>
                    <!-- </a> -->

                <form action="details.php" method="post" style="padding: 0px;">
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
                        <a href="logout.php">
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
    window.location.href = "profile-page.php";
});

document.getElementById("btnLogout").addEventListener("click", function() {
    window.location.href = "logout.php";
});
</script>
