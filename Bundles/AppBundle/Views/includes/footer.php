
      </div>
    </div>

      <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
      <script>
          $('li.has-sub-menu > a').on('click', function (event) {
              event.preventDefault();
              var $elem = $(this).parent();

              if ($elem.hasClass('active')) {
                  $elem.removeClass('active');
              } else {
                  $('li.has-sub-menu').removeClass('active');
                  $elem.addClass('active');
              }
          });

          $('.os-tabs-controls .nav-link').click(function(e){
              e.preventDefault();
              $('.nav-link').removeClass('active');
              $(this).addClass('active');

              var id = $(this).attr('href');
              $('.tab-element').hide();
              $(id).show();
          });
      </script>
  </body>
</html>
