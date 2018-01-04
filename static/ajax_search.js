$("#myform").submit( function(event) {
	return event.preventDefault();
});
$("button#search_b").click( function() {
    var query = $("input#query").val();
    $.ajax({
        type: "POST",
        url: "ajax_q.php",
        data: "query="+query,
        success: function(query){
        	$("#search_result").html(query);
    	},
    });
});



$(document).on('click', '.click-page', function () {
    var page = parseInt($(this).attr('id'));
    var query = $("input#query").val();
	$.ajax({
        type: "POST",
        url: "ajax_q.php",
        data: {query:query, page:page },
        success: function(query){
        	$("#search_result").html(query);
    	},
    });
});



$("input#live_query").keyup( function() {
    var query = $(this).val();
    $.ajax({
        type: "POST",
        url: "ajax_q.php",
        data: "query="+query,
        success: function(query){
        	$("#search_result").html(query);
    	},
    });
});

$("input#live_query_map").keyup( function() {
    var query = $(this).val();
    if (query) {
    $.ajax({
        type: "POST",
        url: "ajax_q_map.php",
        data: "query="+query,
        success: function(query){
            myMap.destroy();
            myMap = new ymaps.Map ("map", {
                center: [55.76, 37.64],
                zoom: 2
            });
            myMap.controls
            // Кнопка изменения масштаба.
            .add('zoomControl', { left: 5, top: 5 })
            // Список типов карты
            .add('typeSelector')
            // Стандартный набор кнопок
            .add('mapTools', { left: 35, top: 5 });
                $("#search_result").html(query);
        },
    });
    };
});
$(document).on('click', '.click-page-map', function () {
    var page = parseInt($(this).attr('id'));
    var query = $("input#live_query_map").val();
    $.ajax({
        type: "POST",
        url: "ajax_q_map.php",
        data: {query:query, page:page },
        success: function(query){
            myMap.destroy();
            myMap = new ymaps.Map ("map", {
                center: [55.76, 37.64],
                zoom: 2
            });
            myMap.controls
            // Кнопка изменения масштаба.
            .add('zoomControl', { left: 5, top: 5 })
            // Список типов карты
            .add('typeSelector')
            // Стандартный набор кнопок
            .add('mapTools', { left: 35, top: 5 });   
            $("#search_result").html(query);
        },
    });
});