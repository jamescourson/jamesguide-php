<html>
    <head>
        <?php
            include '../../include/header.php';
            include '../../scripts/auth.php';
        ?>
    </head>

    <body>
        <?php echo '<form method="post" action="/scripts/edit/guide.php?id=' . $_GET['id'] . '" class="form">'; ?>
            Title: <input name="title"></input><br>
            Description: <input name="desc"></input><br><br>
            <button type="submit" value="Save">Save</button>
        </form>
    </body>
</html>