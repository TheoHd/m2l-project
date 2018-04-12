
      </div>
    </div>
      
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

          $('.btn-delete-trigger').click(function(e){
              e.preventDefault();

              if(confirm('Voulez-vous vraiment supprimer cette element ?')){
                  document.location.href = $(this).attr('href');
              }else{
                  return false;
              }
          })
      </script>
  </body>
</html>
