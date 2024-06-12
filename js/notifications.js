function loadDoc() {
    setInterval(function() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                var countElement = document.getElementById("noti_number");
                var contentElement = document.getElementById("noti_content");

                if (response.count > 0) {
                    countElement.innerHTML = response.count;
                    countElement.style.display = 'inline-block';
                    contentElement.innerHTML = response.notifications;
                } else {
                    countElement.style.display = 'none';
                    contentElement.innerHTML = '<p>No new notifications</p>';
                }
            }
        };
        xhttp.open("GET", "../php/fetch-notifications.php", true);
        xhttp.send();
    }, 1000);
}

document.addEventListener('DOMContentLoaded', (event) => {
    loadDoc();

    let clickCount = 0;

    document.getElementById("noti_icon").onclick = function() {
        clickCount++;
        var contentElement = document.getElementById("noti_content");

        if (clickCount === 1) {
            contentElement.style.display = "block";
        } else if (clickCount === 2) {
            contentElement.style.display = "none";
            clickCount = 0; // Reset click count

            // Send AJAX request to mark notifications as seen
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../php/mark_notifications_seen.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();

            // Hide the notification count after marking as seen
            var countElement = document.querySelector(".count");
            countElement.style.display = 'none';
        }
    };
});