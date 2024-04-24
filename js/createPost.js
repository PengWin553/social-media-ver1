// CREATE POST
$("#btn-submit-post").click(function() {
    var formData = new FormData($("#createPostForm")[0]);
    $.ajax({
      url: "../php/create-post.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
    }).done(function(data) {
      let result = JSON.parse(data);
      if (result.res == "success") {
        location.reload();
      }
    })
  });