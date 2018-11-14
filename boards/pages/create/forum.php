<html>
    <head>
        <?php
            include '../../include/header.php';
            include '../../scripts/auth.php';
        ?>
    </head>

    <body>
        <?php echo '<form method="post" action="../../scripts/post/createForum.php?parent=' . $_GET['id'] . '" class="form">'; ?>
            Name: <input name="name"></input><br>
            Description: <input name="desc"></input><br><br>
            <button type="submit" value="Create Forum">Create Forum</button>
        </form>
    </body>
</html>