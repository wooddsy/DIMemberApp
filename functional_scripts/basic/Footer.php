    
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- Bootstrap core JavaScript -->
    <!-- <script src="<?php echo $appDir; ?>/View/vendor/jquery/jquery.slim.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="<?php echo $appDir; ?>/View/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- custom scripts -->
    <script src="<?php echo $appDir; ?>/View/js/global.js"></script>

    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

</body>

</html>