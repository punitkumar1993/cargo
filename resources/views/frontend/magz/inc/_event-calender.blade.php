@section('styles')
<link rel="stylesheet" href="{{ asset('themes/magz/css/fullcalender.min.css')}}">
@endsection
<aside>
    <div id='calendar'></div>  
</aside>
@section('scripts')
<script src="{{ asset('themes/magz/js/fullcalender.min.js')}}"></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: '{!! route("events.list") !!}'
    });
    calendar.render();
  });

</script>
@endsection