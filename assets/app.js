jQuery(document).ready(function($) {
  window.do_ajax = function(url, type, data, success) {
      $.ajax({
          url: url,
          type: type,
          dataType: "JSON",
          data: data,
          success: success,
      });
  }

  $(document).on('click', '.popup button, [cancel-delete]', () => {
    $('.popup').fadeOut();
  })
  
})