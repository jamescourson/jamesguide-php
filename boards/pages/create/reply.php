<html>
    <head>
        <?php
            include '../../include/header.php';
            include '../../scripts/auth.php';
        ?>
    </head>

    <body>
        <?php echo '<form method="post" action="../../scripts/post/postReply.php?parent=' . $_GET['id'] . '" class="form">'; ?>
            Content:<textarea name="content" cols=50 rows=4 placeholder="Reply..."></textarea><br><br>
            <button type="submit" value="Reply">Reply</button>
        </form>

        <h1>
            Experimental text editor
        </h1>

        <h3>
            Content written here cannot be submitted.
        </h3>

        <div class="experimental-window">
            <script src="/include/texteditor/editor.js"></script>
            <link rel="stylesheet" href="/include/texteditor/editor.css">

            <?php
                echo '<div class="window">';
                    echo '<div class="window-topbar">';
                        echo '<div class="topbar-left">';
                            echo '<button class="left-bold">b</button>';

                            echo '<button class="left-italic">i</button>';

                            echo '<button class="left-underline">u</button>';
                        echo '</div>';

                        echo '<div class="topbar-right">';
                            echo '<button class="right-color">c</button>';
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="window-content">';
                        echo '<div class="content-input">';
                            echo '<textarea class="input-box" rows=20 cols=50></textarea>';
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="window-bottombar">';
                        echo '<div class="bottombar-left">';
                            echo '<button class="left-link">Link</button>';
                            echo '<button class="left-image">Image</button>';
                        echo '</div>';

                        echo '<div class="bottombar-right">';
                            echo '<button class="right-submit">Submit</button>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            ?>
        </div>
    </body>
</html>