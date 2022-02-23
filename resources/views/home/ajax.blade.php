<script>
    $(document).ready(function() {
        $('#app-get_lucky').on('click', function () {
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('fun',['link' => $link])}}',
                data: '{{$link}}',
                dataType: 'json',
                success: function (response) {
                    if (response.status) console.log( response);
                    $('#fun-result').text('Summa = ' + response.ammount +"; Status = "+ (response.status ? "WIN" : "LOSE")+";  Random = "+ response.random);
                },
                error: function(response) {

                    var errors = response.responseJSON;
                    console.log(errors);
                }
            });
        });
    });


    $(document).ready(function() {
        $('#app-get_history').on('click', function () {
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('history',['link' => $link])}}',
                data: '{{$link}}',
                dataType: 'json',
                success: function (response) {
                    if (response){
                        console.log( response);
                        let table = document.getElementById('history_tbody');
                        let i=0;
                        $('#history_tbody').html('');
                           $.each(response, function(index,element){
                               let tr = document.createElement('tr');
                               i++;
                               table.append(tr);
                               tr.appendChild(document.createElement('td')).append(i);
                               tr.appendChild(document.createElement('td')).append(element.ammount);
                               tr.appendChild(document.createElement('td')).append((element.win)? "WIN":"LOSE");
                               tr.appendChild(document.createElement('td')).append(element.random);
                               tr.appendChild(document.createElement('td')).append(element.hash);
                           });
                    }
                    $('#history-result').text(response);
                },
                error: function(response) {

                    var errors = response.responseJSON;
                    console.log(errors);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#app-deactivate_link').on('click', function () {
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('deactivate',['link' => $link])}}',
                data: '{{$link}}',
                dataType: 'json',
                success: function (response) {
                    if (response){
                        console.log( response);
                    }
                    $('#deactivate-result').text(response);
                },
                error: function(response) {

                    var errors = response.responseJSON;
                    console.log(errors);
                }
            });
        });
    });
</script>
