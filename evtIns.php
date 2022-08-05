<?php require_once "header.php" ?>

<link rel="stylesheet" href="">
<link href="static/libs/calendar/css/mobiscroll.jquery.min.css" rel="stylesheet" />
<div class="cont-g">
    <center>
        <h2>Calendario de eventos</h2>
    </center>
    <div id="demo-desktop-month-view" style="height:100%"></div>
</div>

<?php require_once "footer.php" ?>
<script src="static/libs/calendar/js/mobiscroll.jquery.min.js"></script>
<script>
    mobiscroll.setOptions({
    locale: mobiscroll.localeEs,
    theme: 'ios',
    themeVariant: 'light',
    clickToCreate: false,
    dragToCreate: false,
    dragToMove: false,
    dragToResize: false,
    eventDelete: false
});

$(function () {

    var inst = $('#demo-desktop-month-view').mobiscroll().eventcalendar({
        view: {
            calendar: { labels: true }
        },
        onEventClick: function (event, inst) {
            mobiscroll.toast({
                message: event.event.title
            });
        }
    }).mobiscroll('getInst');

    $.getJSON('controllers/getInfo.php',{tipo:'getEvents'}, function (events) {
        inst.setEvents(events);
        console.log(events);
    }, 'jsonp');

    });
</script>