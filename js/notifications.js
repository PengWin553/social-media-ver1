function loadDoc() {
    setInterval(function() {
        fetch("../php/fetch-notifications.php")
            .then(response => response.json())
            .then(data => {
                var countElement = document.getElementById("noti_number");
                var contentElement = document.getElementById("noti_content");

                if (data.count > 0) {
                    countElement.innerHTML = data.count;
                    countElement.style.display = 'inline-block';
                    contentElement.innerHTML = data.notifications;
                } else {
                    countElement.style.display = 'none';
                    contentElement.innerHTML = '<p>No new notifications</p>';
                }
            })
            .catch(error => console.error('Error:', error));
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
            fetch("../php/mark_notifications_seen.php", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: ''
            })
            .then(response => {
                // Hide the notification count after marking as seen
                var countElement = document.getElementById("noti_number");
                countElement.style.display = 'none';
            })
            .catch(error => console.error('Error:', error));
        }
    };
});
