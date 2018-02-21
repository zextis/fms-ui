    <!-- jQuery, loaded in the recommended protocol-less way -->
    <!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var url = "<?php echo URL; ?>";
    </script>

    <!-- VENDOR JAVASCRIPT FILES -->
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>
    <script>
        window.jQuery || document.write('<script src="<?php echo URL; ?>vendors/js/jquery.min.js">\x3C/script>')
    </script>
    <!-- /JQuery -->

    <!-- ListJs -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script>
        window.List || document.write('<script src="<?php echo URL; ?>vendors/js/list.min.js">\x3C/script>')
    </script>
    <!-- /ListJs -->

    <!-- ORIGINAL JAVASCRIPT FILES -->
    <script src="<?php echo URL; ?>resources/js/main.js"></script>
    <script src="<?php echo URL; ?>resources/js/request_list.js"></script>
</body>
</html>
