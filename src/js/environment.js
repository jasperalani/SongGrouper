$(function () {
    $('.remove').click(function () {
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

    $('div[style="text-align: right;position: fixed;z-index:9999999;bottom: 0;width: auto;right: 1%;cursor: pointer;line-height: 0;display:block !important;"]').hide();

    // get all folders in our .directory-list
    var allFolders = $(".directory-list li > ul");
    allFolders.each(function () {

        // add the folder class to the parent <li>
        var folderAndName = $(this).parent();
        folderAndName.addClass("folder");

        // backup this inner <ul>
        var backupOfThisFolder = $(this);
        // then delete it
        $(this).remove();
        // add an <a> tag to whats left ie. the folder name
        folderAndName.wrapInner("<a href='#' />");
        // then put the inner <ul> back
        folderAndName.append(backupOfThisFolder);

        // now add a slideToggle to the <a> we just added
        folderAndName.find("a").click(function (e) {
            $(this).siblings("ul").slideToggle("slow");
            e.preventDefault();
        });

    });

});