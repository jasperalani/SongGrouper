$(function(){$(".remove").click(function(){let e=$(this).attr("data-song-id");window.location.replace("?remove="+e)}),$("#order-by-select").change(function(){let e=$(this).val();window.location.replace("?orderby="+e)})});