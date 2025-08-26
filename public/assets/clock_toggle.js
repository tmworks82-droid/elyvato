
    
    $(document).ready(function(){


        $(function () {
        
          $('#switch-s1').on('change', function () {
            const isActive = $(this).is(':checked') ? 1 : 0;
        
            $.ajax({
              url: window.toggleClockUrl,
              method: 'POST',
              data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                is_active: isActive
              }
            })
            .done(res => console.log(res))
            .fail(xhr => {
              console.warn('Status:', xhr.status);
              console.error(xhr.responseText);
            });
          });
        });

    })
