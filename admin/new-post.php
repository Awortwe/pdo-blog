<?php require_once('./includes/header.php'); ?>
<?php 
  if(!isset($_COOKIE['_ua_'])){
    header("Location: sign-in.php");
  }
?>
    <div class="fluid-container">
        <?php  require_once('./includes/navigation.php'); ?>          

        <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2 pt-3">
            <h2 class="pb-3">Add New Post</h2>
            <?php 
                if(isset($_POST['create-post'])){
                    $post_title = $_POST['post_title'];
                    $post_cat_id = $_POST['cat_id'];
                    $post_status = $_POST['post_status'];
                    $post_content = $_POST['post_content'];
                    $post_date = date('j F Y');
                    $post_author = "Awortwe Enock";
                    $post_image = $_FILES['post_image']['name'];
                    $post_temp_image = $_FILES['post_image']['tmp_name'];
                    move_uploaded_file("{$post_temp_image}", "../img/{$post_image}");
                    if(empty($post_title) || empty($post_status) || empty($post_cat_id) || empty($post_content)){
                        echo "<div class='alert alert-danger'>Fields cannot be empty!!!</div>";
                    }else{
                        $sql = "INSERT INTO posts (post_title, post_des, post_image, post_date, post_author, 
                        post_cat_id, post_status)
                        VALUES(:title, :des, :image, :date, :author, :cat_id, :status)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            ':title' => $post_title,
                            ':des' => $post_content,
                            ':image' => $post_image,
                            ':date' => $post_date,
                            ':author' => $post_author,
                            ':cat_id' => $post_cat_id,
                            ':status' => $post_status
                        ]);
                        echo "<div class='alert alert-success'>Post Created Successfully!! <a href='index.php'>Go Back</a></div>";
                    }

                }
            ?>
            <form action="new-post.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="post-title">Post Title</label>
                    <input type="text" name="post_title" class="form-control" id="post-title" placeholder="Enter post title">
                </div>
                <div class="form-group">
                    <label for="category">Select Category</label>
                    <select name="cat_id" class="form-control" id="category">
                        <?php 
                            $sql1 = "SELECT * FROM categories";
                            $stmt1 = $pdo->prepare($sql1);
                            $stmt1->execute();
                            while($cat = $stmt1->fetch(PDO::FETCH_ASSOC)){
                                $cat_id = $cat['cat_id'];
                                $cat_title = $cat['cat_title']; ?>
                                <option value="<?= $cat_id; ?>"><?= $cat_title; ?></option>
                            <?php }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Post Status</label>
                    <select name="post_status" class="form-control" id="category">
                        <option>Published</option>
                        <option>Draft</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="post-image">Upload post image</label>
                    <input type="file" name="post_image" class="form-control-file" id="post-image">
                </div>
                <div class="form-group">
                    <label for="post-content">Post Content</label>
                    <textarea name="post_content" class="form-control" id="post-content" rows="6" placeholder="Your post content"></textarea>
                </div>
                <button type="submit" name="create-post" class="btn btn-primary">Submit</button>
            </form>
        </section>

    </div>
<?php require_once('./includes/footer.php'); ?>