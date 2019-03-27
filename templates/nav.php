<!-- ######################     Main Navigation   ########################## -->
<nav>
    <ol>
        <?php
        // This sets a class for current page so you can style it differently
        
        print '<li ';
        if ($PATH_PARTS['filename'] == 'index') {
            print ' class="activePage" ';
        }
        print '><a href="index.php">Home</a></li>';
       
        print '<li ';
        if ($PATH_PARTS['filename'] == '') {
            print ' class="activePage" ';
        }
        print '><a href="">Inactive</a></li>'; //Inactive placeholder links
       
        print '<li ';
        if ($PATH_PARTS['filename'] == '') {
            print ' class="activePage" ';
        }
        print '><a href="">Inactive</a></li>';
        
        print '<li ';
        if ($PATH_PARTS['filename'] == '') {
            print ' class="activePage" ';
        }
        print '><a href="">Inactive</a></li>';
        
        print '<li ';
        if ($PATH_PARTS['filename'] == '') {
            print ' class="activePage" ';
        }
        print '><a href="">Inactive</a></li>';
        
        print '<li ';
        if ($PATH_PARTS['filename'] == '') {
            print ' class="activePage" ';
        }
        print '><a href="">Inactive</a></li>';

        ?>
    </ol>
</nav>
<!-- #################### Ends Main Navigation    ########################## -->

