    <footer class="page-footer" style="z-index: -1;">
        <div class="footer-copyright text-center py-3" id="footer-content">

            © 2018 Copyright:
            <p>Alle rettigheter tilhører New Home Inc.</p>
        </div>
    </footer>
    <!--Bootstrap Links -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
    <script>
        var root = document.compatMode=='BackCompat'? document.body : document.documentElement;

        if(root.scrollHeight > root.clientHeight){
            document.getElementById('footer-content').style = "bottom:0; left: 40%; color:white; margin-top:5%;";
        }else{
            document.getElementById('footer-content').style = "position:fixed; bottom:0; margin-top: 10%; left: 40%; color:white;";
        }

        $(document).scrollLeft(1);
    </script>
</body>

</html>