<title>Contact</title>

<body>
    <?php include("header.php"); ?>

		<div class="container">
  <form action="/action_page.php">

    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name..">

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name..">

    <label for="country">Book</label>
    <select id="country" name="country">
      <option value="Ps.I love you">Ps.I love you</option>
      <option value="Harry Potter">Harry Potter</option>
      <option value="The notebook">The notebook</option>
    </select>

    <label for="subject">Subject</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

    <input type="submit" value="Submit">

  </form>
</div>


</body>
  <footer>
    <?php include("footer.php"); ?>
  </footer>
</html>