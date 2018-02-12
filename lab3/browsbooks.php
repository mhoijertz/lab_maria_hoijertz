<!DOCTYPE html>
<html>

<head>
	<title>Browse Books</title>
	<link rel="stylesheet" href="css/main.css">
</head>
            
<body>
		<?php include("header.php"); ?>
</body>
            <form action="browsbooks.php" method="POST">
	            <fieldset>
	            	<legend>BOOKS:</legend>
	                <table>
	                    <tbody>
	                    	  Title: <br>
	                          <INPUT type="text" id="searchtitle" name="searchtitle" value="">
	                          
                              Author:
	                          <INPUT type="text" id="searchauthor" name="searchauthor" value="">
	                         
	                          <INPUT type="submit" name="submit" value="Search">
	                    </tbody>
	                </table>
	            </fieldset>    
        	</form>

		<fieldset>
			<legend>BOOK LIST</legend>

      
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
                
                $searchtitle = htmlentities($searchtitle);
                $searchauthor = htmlentities($searchauthor);
                


                # Open the database
                @ $db = new mysqli('localhost', 'root', 'root', 'lab');

                if ($db->connect_error) {
                    echo "could not connect: " . $db->connect_error;
                    printf("<br><a href=index.php>Return to home page </a>");
                    exit();
                }

                # Build the query. Users are allowed to search on title, author, or both

                $query = " SELECT bookid, author, title, onloan FROM books";
                if ($searchtitle && !$searchauthor) { // Title search only
                    $query = $query . " where title like '%" . $searchtitle . "%'";
                }
                if (!$searchtitle && $searchauthor) { // Author search only
                    $query = $query . " where author like '%" . $searchauthor . "%'";
                }
                if ($searchtitle && $searchauthor) { // Title and Author search
                    $query = $query . " where title like '%" . $searchtitle . "%' and author like '%" . $searchauthor . "%'"; // unfinished
                }

                //echo "Running the query: $query <br/>"; # For debugging
                 

                # Here's the query using bound result parameters
                    // echo "we are now using bound result parameters <br/>";
                    $stmt = $db->prepare($query);
                    $stmt->bind_result($bookid, $author, $title, $onloan);
                    $stmt->execute();

                    echo '<table bgcolor="#fff" cellpadding="6">';
                    echo '<td> ID </td> <td>Title</td> <td>Author</td> <td>Reserved?</td> </b> <td>Reserve</td> </b>';
                    while ($stmt->fetch()) {
                        if(onloan == 0)
                            $onloan="NO";
                        else $onloan="YES";
                        echo "<tr>";
                        echo "<td> $bookid </td> <td> $title </td><td> $author </td> <td> $onloan </td>";
                        echo '<td><a href="reserveBook.php?bookid=' . urlencode($bookid) . '"> Reserve </a></td>';
                        echo "</tr>";
                    }
                    echo "</table>";
             ?>
            
        </fieldset>
	<footer>
		<?php include("footer.php"); ?>
	</footer>
</html>
