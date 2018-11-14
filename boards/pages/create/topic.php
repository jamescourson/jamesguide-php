<html>
    <head>
        <?php
            include '../../include/header.php';
            include '../../scripts/auth.php';
        ?>
    </head>

    <body>
        <?php echo '<form method="post" action="../../scripts/post/postTopic.php?parent=' . $_GET['id'] . '" class="form">'; ?>
            Title:<input type="text" name="title"><br>
            Content:<textarea name="content" cols=50 rows=4 placeholder="Compose..."></textarea><br><br>
            <button type="submit" value="Post">Post</button>
        </form>
    </body>
</html>