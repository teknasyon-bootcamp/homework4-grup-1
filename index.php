<?php

/* 
imports this file to use functions of Post class which inherits from DB class 
which database operations were performed
*/
require_once "post.class.php";

// Get all posts 
$posts = Post::All(); 

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Posts</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
    #more {display: none;}
    </style>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
            <div class="container-fluid pt-3"> <!-- .pt-3 means "add a top padding of 16px":-->
                <p class="text-success">Welcome</p></a>
            </div>  
        </div>
    </nav>
    
    <div class="col-md-3"></div>
    <div class="col-md-6 well">
        <h3 class="text-primary">POSTS</h3>
        <hr style="border-top:1px dotted #ccc;" />
        <br /><br />
        <table class="table table-bordered">
            <thead class="alert-info">
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                </tr>
            </thead>
            <tbody>
                <!-- List created posts -->
                <?php
                //Show related post if there is a given specific get request
                if (isset($_GET["post"])) {

                    $id = $_GET["post"]; // Set given value in the post to id variable

                    $post = Post::find($id); 
                    
                    if(is_null($post)){                          
                        echo "Yazı Bulanamadı";
                    }
                    else {
                        echo '<td>' . $post->title . '</td>';
                        echo '<td>' . $post->content . '</td>';
                    }                          
                    
                } else {
                    // Show all posts if there isn't any specific get request
                    foreach ($posts as $post) {
                        $contentFirstPart = substr($post->content, 0, 100);
                        $contentSecondPart = substr($post->content, 100, strlen($post->content));
                        echo "<tr>";
                        echo '<td>';
                        echo '<a class="navbar-brand" href=index.php?post=' . $post->id . '>' . $post->title . "</a>";
                        echo '</td>';
                        echo '<td>';
                        echo "<p>$contentFirstPart<span id='dots'>...</span><span id='more'>$contentSecondPart</span></p>
                        <a href='#' onclick='myFunction()' id='myBtn'>Read more</a>";
                        echo '</td>';
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}
</script>
</body>