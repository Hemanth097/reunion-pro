$(document).ready(function() {
    loadPollOptions();

    $('#add-option-form').submit(function(event) {
        event.preventDefault();
        var optionText = $('#option_text').val();
        $.ajax({
            url: '../add_option.php',
            type: 'POST',
            data: { option_text: optionText },
            success: function(response) {
                $('#option_text').val('');
                loadPollOptions();
            }
        });
    });

    function loadPollOptions() {
        $.ajax({
            url: '../get_poll_data.php',
            type: 'GET',
            success: function(response) {
                $('#poll-options').html('');
                var options = JSON.parse(response);
                options.forEach(function(option) {
                    $('#poll-options').append(
                        '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                        '<span>' + option.option_text + ' - <span class="badge badge-primary badge-pill">' + option.vote_count + ' votes</span></span>' +
                        '<button class="btn btn-primary vote-button" data-option-id="' + option.id + '">Vote</button>' +
                        '</li>'
                    );
                });
                $('.vote-button').click(function() {
                    var optionId = $(this).data('option-id');
                    $.ajax({
                        url: '../submit_vote.php',
                        type: 'POST',
                        data: { option_id: optionId },
                        success: function(response) {
                            loadPollOptions();
                        }
                    });
                });
            }
        });
    }
});
