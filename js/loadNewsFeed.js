function loadData() {
    $.ajax({
        url: "../php/load-relevant-posts.php"
    }).done(function(data) {
        try {
            let result = JSON.parse(data);
            if (result.res === "success") {
                let resultBoxes = $("#resultBoxes");
                let userData = result.data; // Store user data object
                let displayedPostIds = []; // Array to store IDs of displayed posts
                userData.result.forEach(item => { // Iterate over result array
                    // Check if the post ID has already been displayed
                    if (!displayedPostIds.includes(item.post_id)) {
                        let fullName = item.first_name + " " + item.last_name; // Use the name of the poster
                        let optionsHtml = "";
                        if (item.user_id === userData.user_id) {
                            optionsHtml = `
                                <div class="other-options-container">
                                    <div class="card-dropdow"> 
                                        <i class='bx bx-dots-horizontal-rounded dropdown'>
                                            <span></span>
                                            <div class="dropdown-content">
                                                <p class="btnUpdate btn-update-post" id="${item.post_id}" name="${item.text_input}">Update</p>
                                                <p class="btnDelete btn-delete-post" id="${item.post_id}">Delete</p>
                                            </div>
                                        </i>
                                    </div>
                                    <div class="card-close">
                                        <i class='bx bx-x' id="delete-post"></i> 
                                    </div>
                                </div>`;
                        }

                        let profileImgStyle = (item.user_id !== userData.user_id) ? '' : '';
                        let imagesHtml = '';

                        if (item.picture_urls && Array.isArray(item.picture_urls) && item.picture_urls.length > 0) {
                            imagesHtml = `
                                <div id="carousel-${item.post_id}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        ${item.picture_urls.map((url, index) => `
                                            <div class="carousel-item ${index === 0 ? 'active' : ''}">
                                                <img src="${url}" class="d-block w-100" alt="Post Image">
                                            </div>`).join('')}
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-${item.post_id}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-${item.post_id}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>`;
                        }

                        let resultBox = `
                            <div class="resultBox">
                                <div class=".card-columns">
                                    <div class="card">
                                        <div class="parent-container">
                                            <div class="post-profile-container">
                                                <img src="../default_images/default facebook photo.jpg" class="default-image card-img-top" alt="Profile Picture" ${profileImgStyle}>
                                                <p class="post-user-name"><b>${fullName}</b></p>
                                                <p class="post-user-id">${item.user_id}</p>
                                            </div>
                                            ${optionsHtml}
                                        </div>
                                        <div class="card-body" style="padding: 0;">
                                            <p class="card-text">${item.text_input}</p>
                                            ${imagesHtml}
                                            <div class="bottom-options-container">
                                                <div class="like-button" data-post-id="${item.post_id}" data-liked="${item.is_liked ? 'true' : 'false'}">
                                                    <i class='bx bxs-like' style="color: ${item.is_liked ? 'blue' : 'initial'}"></i> <span></span> <span class="like-count">${item.like_count || 0}</span>
                                                </div>
                                                <div class="comment-button open-comments-modal" id="${item.post_id}">
                                                    <i class='bx bxs-comment'></i> <span>Comment</span>
                                                </div>
                                                <div class="share-button">
                                                    <i class='bx bxs-share'></i><span>Share</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        resultBoxes.append(resultBox);
                        displayedPostIds.push(item.post_id); // Add the post ID to the list of displayed posts
                    }
                });

                // Initialize Bootstrap Carousel
                $('.carousel').carousel();

                // Add event listener for like buttons
                $(".like-button").click(function() {
                    let postId = $(this).data("post-id");
                    let likeCountSpan = $(this).find(".like-count");
                    let currentLikeCount = parseInt(likeCountSpan.text());
                    let isLiked = $(this).data("liked") === 'true';
                    let likeIcon = $(this).find("i");

                    // Toggle the like/unlike state and update the like count
                    if (isLiked) {
                        likeCountSpan.text(currentLikeCount - 1);
                        likeIcon.css("color", "initial");
                        $(this).data("liked", "false");
                    } else {
                        likeCountSpan.text(currentLikeCount + 1);
                        likeIcon.css("color", "blue");
                        $(this).data("liked", "true");
                    }

                    // Send the like/unlike to the backend
                    $.ajax({
                        url: "../php/toggle-like-post.php", // Your endpoint to handle the like/unlike
                        type: "POST",
                        data: { post_id: postId, is_liked: !isLiked },
                        success: function(response) {
                            console.log("Post like status changed successfully!");
                        },
                        error: function(xhr, status, error) {
                            console.error("Error changing post like status:", error);
                        }
                    });
                });

            } else {
                alert("Failed to load product data.");
            }
        } catch (error) {
            console.error("Error parsing JSON:", error);
            // alert("An unexpected error occurred. Please try again later.",);
        }
    }).fail(function(xhr, status, error) {
        console.error("An error occurred while fetching product data:", error);
        alert("An error occurred while fetching product data. Please try again later.");
    });
}

loadData();
