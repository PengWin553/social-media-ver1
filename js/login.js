// LOGIN
$("#btn-login").click(function () {
    // Save the data from the modal inside variables
    var gmail = $("#login-email").val();
    var password = $("#login-password").val();
  
    if (gmail.trim().length > 0) {
      $.ajax({
        url: "php/login.php",
        method: "POST",
        data: {
          gmail: gmail,
          password: password,
        },
        success: function (data) {
          var result = JSON.parse(data);
          if (result.res === "success") {
            console.log('Successfully logged in.');
            // alert('Hello, ' + result.first_name + ' ' + result.last_name + '!'); 
            // Redirect to home page or perform any other action on successful login
            window.location.href = 'php/news-feed.php'; // Redirect to profile page
          } else {
            console.error('Login failed:', result.message);
            alert("Login failed. Please check your credentials.");
          }
        },
        error: function (xhr, status, error) {
          console.error('Error occurred during login:', error);
          alert("An error occurred during login. Please try again later.");
        }
      });
    } else {
      alert("Error: Please enter your email.");
    }
  });