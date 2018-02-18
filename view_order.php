<?php require('dbcon.php'); ?>
<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if(isset($_GET["id"])){
    $order_details = "select name, surname, email, phone, comment from Orders where id = ".$_GET["id"];
    $result = $conn->query($order_details);
    echo "<b>Order details:</b><br/>";
    while ($row = $result->fetch_assoc()) {
      echo "name: ".$row["name"]."<br/>";
      echo "surname: ".$row["surname"]."<br/>";
      echo "email: ".$row["email"]."<br/>";
      echo "phone: ".$row["phone"]."<br/>";
      echo "comment: ".$row["comment"]."<br/>";
    }

    echo "<br/>";
    echo "<b>Books:</b><br/>";

    // $book_details = "select b.id as book_id, b.name as book_name, a.name as author_name, a.surname as author_surname, g.name as genre from Book b left join Author a on a.id = b.author_id left join Genre g on g.id = b.genre_id left join Orders_Book ob on ob.order_id = ".$_GET["id"]." order by a.name, g.name, b.name;";
    $book_details = "select b.id as book_id, b.name as book_name, a.name as author_name, a.surname as author_surname, g.name as genre from Orders_Book ob left join Book b on ob.book_id = b.id left join Author a on a.id = b.author_id left join Genre g on g.id = b.genre_id where ob.order_id = ".$_GET["id"]." order by a.name, g.name, b.name;";
    $result = $conn->query($book_details);
    while ($row = $result->fetch_assoc()) {
        echo "<i>".$row["author_name"]." ".$row["author_surname"]."</i> "."<b>".$row["book_name"]."</b> "."(".$row["genre"].")"."<br/>";
    }
  }
}
?>
</body>
</html>
