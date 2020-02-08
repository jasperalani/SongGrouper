$(function () {
   $('.remove').click(function (){
       let id = $(this).attr("data-song-id");
        window.location.replace('?remove=' + id);
   });

   $('#order-by-select').change(function () {
      let value = $(this).val();
      window.location.replace('?orderby=' + value);
   });
});