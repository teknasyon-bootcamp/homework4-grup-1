<?php

//imports this file to leverage its functionalities and attributes
require_once "post.class.php";

// Get all posts in my list 
$posts = Post::All();

// Defines necessary variables for my post list and sets its default values
$action = '';
$postId = '';
$title = '';
$content = '';
//get the value of action variable which was given in the url
if(isset($_GET['action'])){ //isset function checks whether a variable is declared and is different than null. 
    $action = $_GET['action']; 
}
if(isset($_REQUEST['post'])){
    $postId = $_REQUEST['post']; 
}
if(isset($_POST['title'])){
    $title = $_POST['title'];
}
if(isset($_POST['content'])){
    $content = $_POST['content']; 
}
/**
 * Performs create new post, update and delete existing post 
 * using the value of action variable in the url    
 */
switch ($action) {
    case 'edit' :   
        $post = Post::find($postId);
        $post->title = $title;
        $post->content = $content;
        $post->update();
        
        // Sends a raw http header to the browser in a raw form
        header("Refresh:0; url=manage.php");  
        break;
    case 'create':
        $post = new Post;
        $post->title = $title;
        $post->content = $content;
        $post->create();
        header("Refresh:0; url=manage.php");
        break;
    case 'delete':
        $post = Post::find($postId);
        $post->delete();
        header("Refresh:0; url=manage.php");
        break;
}
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
            <a class="navbar-brand" style="color:blue; width:120%; height:50px; background-color:#b0e0e6; right: 0px;"  href="manage.php">Welcome</a>
        </div>
    </nav>
    <div class="col-md-3"></div>
    <div class="col-md-12 well well-sm"> 
        <h3 class="text-primary">POSTS</h3>
        <hr style="border-top:1px dotted #ccc;" />
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Add</button>
        
        <br /><br />
        <table class="table table-bordered">
            <thead class="alert-info">
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <!-- List created posts -->
                <?php foreach($posts as $post) :  ?>
                <tr>
                    <td><?=$post->title?></td>
                    <td><?=$post->content?></td>
                    <!-- Creates update and delete buttons which are having given values on the right side of the page-->
                    <td><button class="btn btn-warning" type="button" data-toggle="modal" data-target="#update_<?=$post->id?>"><span class="glyphicon glyphicon-edit"></span>Update</button>
                    <a href="?action=delete&post=<?=$post->id?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Delete</a></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <?php foreach($posts as $post) : ?>
    <div class="modal fade" id="update_<?= $post->id ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="manage.php?action=edit&post=<?= $post->id ?>" method="POST">
                    <div class="modal-header">
                        <h3 class="modal-title">Update</h3>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" 
                                       class="form-control" 
                                       value="<?= $post->title ?>" 
                                       name="title"/>
                                      
<!-- A hidden field let us include data that cannot be seen or modified 
    when the form is submitted. 
-->
                             <input type="hidden" 
                                       class="form-control" 
                                       value="<?= $post->id ?>" 
                                       name="id" />
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea rows="5" cols= "20" type="text" class="form-control" name="content"><?=$post->content?></textarea>                         
                                
                            </div>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" name="guncelle"><span class="glyphicon glyphicon-update"></span> Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Exit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach ?>
 
    <!-- Add Modal -->
    <div class="modal fade" id="form_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="manage.php?action=create" method="POST">
                    <div class="modal-header">
                        <h3 class="modal-title">Add</h3>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title"/>
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea type="text" class="form-control" name="content" rows="5" cols="20"> 
                                
                                </textarea><!--Converted from input to textarea control-->
                            </div>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" name="save">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Exit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

