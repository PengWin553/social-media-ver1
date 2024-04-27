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
                        
                        let profileImgStyle = (item.user_id !== userData.user_id) ? 'style="margin-left: 2.7em; margin-top: -0.1em; width: 51px;"' : '';
                        let resultBox = `
                            <div class="resultBox">
                                <div class=".card-columns">
                                    <div class="card">
                                        <div class="parent-container" >
                                            <div class="post-profile-container" >
                                                <img src="../default_images/default facebook photo.jpg" class="default-image card-img-top" alt="Profile Picture" ${profileImgStyle}>
                                                <p class="post-user-name">${fullName}</p>
                                                <p class="post-user-id">${item.user_id} </p>
                                            </div>
                                            ${optionsHtml}
                                        </div>
                                        <div class="card-body" style="padding: 0;">
                                            <p class="card-text" style="padding-left: 0.6em; margin-top: 25px;">${item.text_input}</p>
                                            ${item.picture_url ?
                                                `
                                                <div class="image-container">
                                                    <img src="${item.picture_url}" class="post-image card-img-top" alt="Post Image">
                                                </div>
                                                `
                                                : ''
                                            }
                                            <div class="bottom-options-container" style="border-top: 1px solid grey;">
                                                <div class="like-button"><i class='bx bxs-like' ></i> <span>Like</span> </div>
                                                <div class="comment-button open-comments-modal" id="${item.post_id}"><i class='bx bxs-comment'></i> <span>Comment</span> </div>
                                                <div class="share-button"><i class='bx bxs-share'></i><span> </span>Share</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        resultBoxes.append(resultBox);
                        displayedPostIds.push(item.post_id); // Add the post ID to the list of displayed posts
                    }
                });
            } else {
                alert("Failed to load product data.");
            }
        } catch (error) {
            console.error("Error parsing JSON:", error);
            // alert("An unexpected error occurred. Please try again later.");
        }
    }).fail(function(xhr, status, error) {
        console.error("An error occurred while fetching product data:", error);
        // alert("An error occurred while fetching product data. Please try again later.");
    });
}

loadData();
