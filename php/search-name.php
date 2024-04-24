<?php
require_once 'connection.php';

if (isset($_POST['query'])) {
  $inpText = $_POST['query'];
  $sql = 'SELECT first_name, last_name FROM userInfo_table WHERE first_name LIKE :first_name';
  $stmt = $connection->prepare($sql);
  $stmt->execute(['first_name' => '%' . $inpText . '%']);
  $result = $stmt->fetchAll();

  if ($result) {
    foreach ($result as $row) {
      // The link will lead you to the search-results-page with the user you are seeing
      echo '<a href="search-results-page.php?query=' . urlencode($inpText) . '" class="list-group-item list-group-item-action border-1" style="background: yellow; width: 250px; text-align: left; background: white; border-radius: 5px;">' . $row['first_name'] . ' ' . $row['last_name'] . '</a>';
    }
  } else {
    echo '<p class="list-group-item border-1" style="background: yellow; width: 250px; text-align: left; background: white; border-radius: 5px; padding: 3px 5px;">No Record</p>';
  }
}
?>
