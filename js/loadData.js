function loadData() {
    $.ajax({
      url: "../php/posts.php"
    }).done(function(data) {
      try {
        let result = JSON.parse(data);
        if (result.res === "success") {
          let resultBoxes = $("#resultBoxes");
          let userData = result.data; // Store user data object
          let fullName = userData.first_name + " " + userData.last_name;
          userData.result.forEach(item => { // Iterate over result array
            let resultBox = `
              <div class="resultBox" >
                <div class=".card-columns">
                  <div class="card">
  
                    <div class="parent-container" >
                      <div class="post-profile-container" >
                        <img src="../default_images/default facebook photo.jpg" class="default-image card-img-top" alt="Profile Picture">
                        <p class="post-user-name"> <b>  ${fullName} </b></p>
                        <p class="post-user-id">${userData.user_id} </p>
                      </div>
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
                          <i class='bx bx-x'" id="delete-post"></i> 
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <p class="card-text" style="margin-top: -14px; margin-left: -0.66em;">${item.text_input}</p>
                      </div>
                        ${item.picture_url ?
                        
                          `
                            <div class="image-container">
                              <img src="${item.picture_url}" class="post-image card-img-top" alt="Post Image">
                            </div>
                          `
                          
                          : ''}
                      
                        <div class="bottom-options-container">
                          <div class="like-button"><i class='bx bxs-like' ></i> <span>Like</span> </div>
                          <div class="comment-button open-comments-modal" id="${item.post_id}"><i class='bx bxs-comment'></i> <span>Comment</span> </div>
                          <div class="share-button"><i class='bx bxs-share'></i><span> </span>Share</div>
                        </div>

                    </div>
  
                </div>
  
               
              </div>`;
            resultBoxes.append(resultBox);
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