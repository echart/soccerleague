      </div>
    </main>
    <!--JS-->
    <script src="<?=$this->tree?>assets/js/jquery.js"></script>
    <script type="text/javascript">
      $('.menu-mobile').on('click', function(){
        $(this).toggleClass("change");
        $('.navbar').toggleClass('navbar-open');
        $('.content').toggleClass('hidden');
      })
      $(document).ready(function(){
        $('.navbar').height($(document).height());
      })
    </script>
    <? $this->loadJSFiles(); ?>
</body>
</html>
<? Connection::getInstance()->disconnect();?>
