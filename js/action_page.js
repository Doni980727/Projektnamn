$(document).ready(function () {
    $('#in').click(function () {
            $.post("./action_page.php", $("form").serialize());
        
    });
});