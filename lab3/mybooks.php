<!DOCTYPE html>
<html>

<head>
	<title>My Books</title>
	<link rel="stylesheet" href="css/main.css">


</head>
<body>

    <?php include("header.php"); ?>

<?php

  $searchtitle = "";
  $searchauthor = "";

  if (isset($_POST) && !empty($_POST)) {
  # Get data from form
      $searchtitle = trim($_POST['searchtitle']);
      $searchauthor = trim($_POST['searchauthor']);
  }

  //  if (!$searchtitle && !$searchauthor) {
  //    echo "You must specify either a title or an author";
  //    exit();
  //  }

  $searchtitle = addslashes($searchtitle);
  $searchauthor = addslashes($searchauthor);

  # Open the database
  @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

  if ($db->connect_error) {
      echo "could not connect: " . $db->connect_error;
      printf("<br><a href=index.php>Return to home page </a>");
      exit();
  }

  # Build the query. Users are allowed to search on title, author, or both

  $query = " SELECT bookid, author, title, onloan FROM books ";
  if ($searchtitle && !$searchauthor) { 
      $query = $query . " and title like '%" . $searchtitle . "%'";
  }
  if (!$searchtitle && $searchauthor) { 
      $query = $query . " and author like '%" . $searchauthor . "%'";
  }
  if ($searchtitle && $searchauthor) { 
      $query = $query . " and title like '%" . $searchtitle . "%' and author like '%" . $searchauthor . "%'";// unfinished
  }

  //echo "Running the query: $query <br/>"; # For debugging


    # Here's the query using an associative array for the results
  //$result = $db->query($query);
  //echo "<p> $result->num_rows matching books found </p>";
  //echo "<table border=1>";
  //while($row = $result->fetch_assoc()) {
  //echo "<tr><td>" . $row['bookid'] . "</td> <td>" . $row['title'] . "</td><td>" . $row['author'] . "</td></tr>";
  //}
  //echo "</table>";
   

  # Here's the query using bound result parameters
      // echo "we are now using bound result parameters <br/>";
      $stmt = $db->prepare($query);
      $stmt->bind_result($bookid, $author, $title, $onloan);
      $stmt->execute();
      
  //    $stmt2 = $db->prepare("update onloan set 0 where bookid like ". $bookid);
  //    $stmt2->bind_result($onloan, $bookid);
      

      echo '<table bgcolor="" cellpadding="6">';
      echo '<tr><b><td>ID</td><b> <td>Title</td> <td>Author</td> <td>Reserved?</td> </b> <td>Return</td> </b></tr>';
      while ($stmt->fetch()) {
          if($onloan==1)
              $onloan="Yes";
            else $onloan="No";
         
          echo "<tr>";
          echo "<td> $bookid </td><td> $title </td><td> $author </td><td> $onloan </td>";
          echo '<td><a href="returnBook.php?bookid=' . urlencode($bookid) . '">Return</a></td>';
          echo "</tr>";
          
      }
      echo "</table>";
    ?>


</body>
  <footer>
    <?php include("footer.php"); ?>
  </footer>
</html>
