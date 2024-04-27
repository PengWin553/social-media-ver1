// REGISTER
$("#btn-signup").click(function () {
    // save the data from the modal inside the variables
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var dob_month = $("#month").val();
    var dob_day = $("#day").val();
    var dob_year = $("#year").val();
    const female = document.getElementById("female");
    const male = document.getElementById("male");
    const custom = document.getElementById("custom");

    if(female.checked){
      var gender = $("#female").val();
    }else if(male.checked){
      var gender = $("#male").val();
    }else if(custom.checked){
      var gender = $("#custom").val();
    }
    
    var gmail = $("#email").val();
    var password = $("#password").val();
    if (first_name.trim().length > 0) {
        $.ajax({
            url: "php/signup.php",
            method: "POST",
            data: {
                first_name: first_name,
                last_name: last_name,
                dob_month: dob_month,
                dob_day: dob_day,
                dob_year: dob_year,
                gender: gender,
                gmail: gmail,
                password: password
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.res === "success") {
                    alert("Successfully created account. Please login.");
                    location.reload();
                }
            }
        });
    } else {
        alert("Please enter your name.");
    }
});