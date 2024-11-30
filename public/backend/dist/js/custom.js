$(document).ready(function() {
    $(".number").keyup(function () {
        const input = $(this).val();

        if (!isNaN(input) && $.isNumeric(input)) {
            return;
        } else {
            const newInput = input.slice(0, -1);
            $(this).val(newInput);
        }
    });
})
