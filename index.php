<?php
/*try{
    $pdo=new PDO("mysql:host=mariadb;dbname=default","root","root");
  }catch(PDOException $e){
    echo "veritabanı hatası: {$e->getMessage()}";
    exit(1);
  }
  echo "Baglanti kuruldu";//post.class.php*/
 
  //$posts=$pdo->query("select*from posts");

  //$control=false;
  require_once "post.class.php";
  $posts=Post::All();

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
 
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Welcome</a>
        </div>
    </nav>
    <div class="col-md-3"></div>
    <div class="col-md-6 well">
        <h3 class="text-primary">POSTS </h3>
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
                <!-- Eklenen Kayıtların Listelenmesi -->


                <?php
                    if(isset($_GET["post"])){
                        //var_dump($post);
                        $id=$_GET["post"];
                        $post=Post::find($id);
                        
                        echo '<td>'. $post->title .'</td>';
                        echo'<td>'.$post->content.'</td>';
                        
                    }
                    else{
                        foreach($posts as $post) {
                            echo "<tr>";
                            echo '<td>';
                            echo '<a class="navbar-brand" href=index.php?post='. $post->id.'>'. $post->title ."</a>";
                            echo '</td>';
                            echo'<td>'.$post->content.'</td>';
                            echo "</tr>";
                        }
                       
                    }
                    
                    ?>
            </tbody>
        </table>
    </div>
</body>