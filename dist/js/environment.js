$(function () {
   $('.remove').click(function (){
       let id = $(this).attr("data-song-id");
        window.location.replace('?remove=' + id);
   });

   $('#order-by-select').change(function () {
      let value = $(this).val();
      window.location.replace('?orderby=' + value);
   });

   /* Input form select */
   $('#select-artist').change(function () {
       $('#artist').val($(this).val());
   });
    $('#select-album').change(function () {
        $('#album').val($(this).val());
    });
    $('#select-song').change(function () {
        $('#song').val($(this).val());
    });
});