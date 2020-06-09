

var submitQuery = function() {
    var str_query = $('#user_query').val();
    $.ajax({
        type: "POST",
        url: "http://51.83.44.173/api/enlecs2/",
        data: JSON.stringify(str_query),
        contentType: "application/json",
        headers: { 'Access-Control-Allow-Origin': '*' },
        success: function(data) {
            var api_response = eval(data);
            interpretAPIResponse(api_response);
        },
        failure: function(message) {
            console.log(message);
        }
    });
};

var interpretAPIResponse = function(api_response) {
    response = api_response.replace(/\'/g,'\"');
    $('#raw_result').html(response);
    json_response = JSON.parse(response);
    $.each(json_response, function(i,first_cat) {
        console.log(first_cat);
        var html = '<div class="col-md-4">';
        html += '<div class="panel panel-default">';
        html += '<div class="panel-heading">';
        if (typeof first_cat === "object") {
            $.each(first_cat, function(first, second_cat) {
                html += first;
                html += '</div>';
                html += '<div class="panel-body">';
                $.each(second_cat, function(second, cat) {
                    html += '<ul>';
                    html += '<li>'+cat+'</li>';
                    html += '</ul>';
                });
                html += '</div>';
                html += '</div>';
            });
        }
        else {
            html += first_cat;
            html += '</div>';
            html += '</div>';
            html += '</div>';
        }
        $('#first_cat').append(html);
    });
}

$(document).ready(function() {
    $('#submit_query').click(submitQuery);
});
