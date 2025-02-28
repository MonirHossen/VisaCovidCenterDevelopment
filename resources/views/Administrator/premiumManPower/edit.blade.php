@extends('Administrator.layouts.master')

@push('title')
    Premium Man Power Add
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/center-part/css/calender_14.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/center-part/css/third-party-calendar/calendar.css') }}">
@endpush

@section('content')
    <div class="container container-bg-color my-3 ">
        <div class="card-body shadow " style="margin-bottom: 120px;">
            <div class="container">
                <div class="row">
                    <h1 class="cal-header">Edit Premium Manpower Schedule for {{ Carbon\Carbon::parse($manPowerSchedule->date)->format('Y-m-d') }}</h1>
                    
                    <form action="">
                        <div class="cal-slot row ">
                            <div class="cal-morning-slot">
                                <p class="morning">Morning Slot</p>
                                <div class="cal-morn-in">
                                    <input type="hidden" name="id" value="{{ $manPowerSchedule->id }}" id="id">
                                    <input type="time" class="cal-morn-in-left" min="01:00" max="12:00" id="morningSlotStart" onchange="setMorningSlotTime()" @if ($manPowerSchedule) value="{{ $manPowerSchedule->morning_starting_time }}" @endif
                                        name="morningSlotStart"> -
                                    <input type="time" class="cal-morn-in-left" min="10:00" max="15:00" id="morningSlotEnd" onchange="setMorningSlotTime()" @if ($manPowerSchedule) value="{{ $manPowerSchedule->morning_ending_time }}" @endif name="morningSlotEnd">
                                </div>
                                @php
                                    if ($manPowerSchedule) {
                                        $morning_starting_time = \Carbon\Carbon::createFromFormat('H:i', $manPowerSchedule->morning_starting_time);
                                        $morning_ending_time = \Carbon\Carbon::createFromFormat('H:i', $manPowerSchedule->morning_ending_time);
                                        $morning_slot_minutes = $morning_starting_time->diffInMinutes($morning_ending_time);
                                    }
                                @endphp
                                <p class="cal-footer">Working period: <span
                                        id="totalMorningSlotTime">{{ $morning_slot_minutes ?? '' }}</span> Minutes</p>
                            </div>

                            <div class="cal-day-slot">
                                <p class="day">Day Slot</p>
                                <div class="cal-day-in">
                                    <input type="time" class="cal-morn-day-right" min="13:00" max="18:00" id="daySlotStart" onchange="setDaySlotTime()" @if ($manPowerSchedule) value="{{ $manPowerSchedule->day_starting_time }}" @endif
                                        name="daySlotStart"> -
                                    <input type="time" class="cal-morn-day-right" min="16:00" max="24:00"  id="daySlotEnd" onchange="setDaySlotTime()" @if ($manPowerSchedule) value="{{ $manPowerSchedule->day_ending_time }}" @endif
                                        name="daySlotEnd">
                                </div>
                                @php
                                    if ($manPowerSchedule) {
                                        $day_starting_time = \Carbon\Carbon::createFromFormat('H:i', $manPowerSchedule->day_starting_time);
                                        $day_ending_time = \Carbon\Carbon::createFromFormat('H:i', $manPowerSchedule->day_ending_time);
                                        $day_slot_minutes = $day_starting_time->diffInMinutes($day_ending_time);
                                    }
                                @endphp
                                <p class="cal-footer">Working period: <span
                                        id="totalDaySlotTime">{{ $day_slot_minutes ?? '' }}</span> Minutes</p>

                            </div>
                        </div>
                        <div class="cal-min-slot row">
                            <ul class="total">
                                <li class="cal-min-l">Total minutes</li>
                                @php
                                    if ($manPowerSchedule) {
                                        $totalDayMinutes = $morning_slot_minutes + $day_slot_minutes;
                                        $totalManMinutePerDay = $totalDayMinutes * get_total_volenteers();
                                    }
                                @endphp
                                <li class="cal-min-r totalMinute" id="totalMinute">{{ $totalDayMinutes ?? '' }}</li>
                            </ul>
                            <ul class="total">
                                <li class="cal-min-l">Total man minutes per day</li>
                                <li class="cal-min-r totalManMinutePerDay" id="totalManMinutePerDay">
                                    {{ $totalManMinutePerDay ?? '' }}</li>
                            </ul>
                        </div>
                        <div class="cal-service-slot row">
                            <table class="t-cal">
                                <tr class="cal-mx-x">
                                    <td class="cal-x-y">
                                        <p class="p-mx"> <b>Service</b> </p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mx"> <small>Estimated time</small><br><b>Per Process</b> </p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mx"><b>Number of Volunteer</b> </p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mx"> <small>Max service</small><br><b>Per day</b> </p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mx"> <small>Avaiable service</small><br><b>Per day</b> </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cal-x-y">
                                        <p class="p-mx"> PCR </p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mxx"><input type="number" class="cal-min-t"
                                                onchange="setMaxPcrService()" id="timeForPcr" @if ($manPowerSchedule) value="{{ $manPowerSchedule->pcr_time }}" @endif
                                                name="timeForPcr"> <small class="s-cx">min</small></p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mxx"><input type="number" class="cal-min-t"
                                                onchange="setMaxPcrService()" id="volunteerForPcr" @if ($manPowerSchedule) value="{{ $manPowerSchedule->volunteer_for_pcr }}" @endif
                                                name="volunteerForPcr"></p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mx" id="max-pcr-serve">
                                            @if ($manPowerSchedule)
                                                {{ get_max_service_per_day($totalDayMinutes, $manPowerSchedule->pcr_time, $manPowerSchedule->volunteer_for_pcr) }}
                                            @endif
                                        </p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mx" id="available-pcr-serve">
                                                {{ get_available_service_per_day($center->space) }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cal-x-y">
                                        <p class="p-mx"> Vaccine </p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mxx"> <input type="number" class="cal-min-t"
                                                onchange="setMaxVaccineService()" id="timeForVaccine"
                                                @if ($manPowerSchedule) value="{{ $manPowerSchedule->vaccine_time }}" @endif name="timeForVaccine"> <small
                                                class="s-cx">min</small></p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mxx"> <input type="number" class="cal-min-t"
                                                onchange="setMaxVaccineService()" id="volunteerForVaccine"
                                                @if ($manPowerSchedule) value="{{ $manPowerSchedule->volunteer_for_vaccine }}" @endif name="volunteerForVaccine"></p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mx" id="max-vaccine-serve">
                                            @if ($manPowerSchedule)
                                                {{ get_max_service_per_day($totalDayMinutes, $manPowerSchedule->vaccine_time, $manPowerSchedule->volunteer_for_vaccine) }}
                                            @endif
                                        </p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mx" id="available-vaccine-serve">
                                                {{ get_available_service_per_day($center->space) }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cal-x-y">
                                        <p class="p-mx"> Booster </p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mxx"> <input type="number" class="cal-min-t"
                                                onchange="setMaxBoosterService()" id="timeForBooster"
                                                @if ($manPowerSchedule) value="{{ $manPowerSchedule->booster_time }}" @endif name="timeForBooster"> <small
                                                class="s-cx">min</small> </p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mxx"><input type="number" class="cal-min-t"
                                                onchange="setMaxBoosterService()" id="volunteerForBooster"
                                                @if ($manPowerSchedule) value="{{ $manPowerSchedule->volunteer_for_booster }}" @endif name="volunteerForBooster"></p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mx" id="max-booster-serve">
                                            @if ($manPowerSchedule)
                                                {{ get_max_service_per_day($totalDayMinutes, $manPowerSchedule->booster_time, $manPowerSchedule->volunteer_for_booster) }}
                                            @endif
                                        </p>
                                    </td>
                                    <td class="cal-x-y">
                                        <p class="p-mx" id="available-booster-serve">
                                                {{ get_available_service_per_day($center->space) }}
                                        </p>
                                    </td>
                                </tr>
                                <tr class="cal-mx-x-p">
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <p class="p-mx">Want to service per day </p>
                                    </td>
                                    <td></td>
                                    <td>
                                        <p class="p-mx y-s" id="wantToServePerDay"></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="cal-save">
                            <button class="cal-x-btn schedule-save-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/center-part/js/third-party-calendar/calendar.js') }}"></script>
    <script>
        $(document).ready(function() {
            // schedule-save-btn clicked
            $('.schedule-save-btn').on('click', function(event) {
                event.preventDefault();

                var formData = new FormData();
                formData.append('morningSlotStart', $('#morningSlotStart').val());
                formData.append('morningSlotEnd', $('#morningSlotEnd').val());
                formData.append('daySlotStart', $('#daySlotStart').val());
                formData.append('daySlotEnd', $('#daySlotEnd').val());
                formData.append('timeForPcr', $('#timeForPcr').val());
                formData.append('timeForVaccine', $('#timeForVaccine').val());
                formData.append('timeForBooster', $('#timeForBooster').val());
                formData.append('volunteerForPcr', $('#volunteerForPcr').val());
                formData.append('volunteerForVaccine', $('#volunteerForVaccine').val());
                formData.append('volunteerForBooster', $('#volunteerForBooster').val());        
                formData.append('booster_available_set', $('#max-booster-serve').text());               
                formData.append('vaccine_available_set', $('#max-vaccine-serve').text());               
                formData.append('pcr_available_set', $('#max-pcr-serve').text());               
                formData.append('id', $('#id').val());               
                // var dksjfos = "{{ url('administrator/premium/update') }}"+"/"+$('#id').val();

                // alert(dksjfos);
                $.ajax({
                    method: 'POST',
                    url: "{{ url('administrator/premium/update') }}"+"/"+$('#id').val(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.type == 'success') {
                            Swal.fire({
                                icon: res.type,
                                title: 'Updated !',
                                text: res.message,
                                // footer: 'PCR result uploaded successfully!'
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 800);
                        } else {
                            Swal.fire({
                                icon: res.type,
                                title: 'Oops...',
                                text: res.message,
                                // footer: 'Something went wrong!'
                            });
                        }
                    },
                    error: function(xhr) {
                        var errorMessage = '<div class="card bg-danger">\n' +
                            '                        <div class="card-body text-center p-5">\n' +
                            '                            <span class="text-white">';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorMessage += ('' + value + '<br>');
                        });
                        errorMessage += '</span>\n' +
                            '                        </div>\n' +
                            '                    </div>';
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            footer: errorMessage
                        });
                    },
                });
            });
        });


        // Auto wantToServePerDay Calculation
        function wantToServePerDay() {
            var maxPcrServe = parseInt(document.getElementById('max-pcr-serve').innerHTML);
            var maxVaccineServe = parseInt(document.getElementById('max-vaccine-serve').innerHTML);
            var maxBoosterServe = parseInt(document.getElementById('max-booster-serve').innerHTML);
            var wantToServePerDay = maxPcrServe + maxVaccineServe + maxBoosterServe;
            document.getElementById('wantToServePerDay').innerHTML = wantToServePerDay;
        }

        wantToServePerDay();

        function setMaxPcrService() {
            var timeForPcr = parseInt(document.getElementById('timeForPcr').value);
            var volunteerForPcr = parseInt(document.getElementById('volunteerForPcr').value);
            var totalMinute = parseInt(document.getElementById('totalMinute').innerHTML);
            var manPowerMinuteForPcr = totalMinute * volunteerForPcr;
            document.getElementById('max-pcr-serve').innerHTML = parseInt(manPowerMinuteForPcr / timeForPcr) ;
            wantToServePerDay();
            setTotalManMinutePerDay()
        }

        function setMaxVaccineService() {
            var timeForVaccine = parseInt(document.getElementById('timeForVaccine').value);
            var volunteerForVaccine = parseInt(document.getElementById('volunteerForVaccine').value);
            var totalMinute = parseInt(document.getElementById('totalMinute').innerHTML);
            var manPowerMinuteForVaccine = totalMinute * volunteerForVaccine;
            document.getElementById('max-vaccine-serve').innerHTML = parseInt(manPowerMinuteForVaccine / timeForVaccine) ;
            wantToServePerDay();
            setTotalManMinutePerDay();
        }

        function setMaxBoosterService() {
            var timeForBooster = parseInt(document.getElementById('timeForBooster').value);
            var volunteerForBooster = parseInt(document.getElementById('volunteerForBooster').value);
            var totalMinute = parseInt(document.getElementById('totalMinute').innerHTML);
            var manPowerMinuteForBooster = totalMinute * volunteerForBooster;
            document.getElementById('max-booster-serve').innerHTML = parseInt(manPowerMinuteForBooster / timeForBooster) ;
            wantToServePerDay();
            setTotalManMinutePerDay();
        }

        function setTotalManMinutePerDay() {
            var volunteerForPcr     = parseInt(document.getElementById('volunteerForPcr').value);
            var volunteerForVaccine = parseInt(document.getElementById('volunteerForVaccine').value);
            var volunteerForBooster = parseInt(document.getElementById('volunteerForBooster').value);
            var totalMinute         = document.getElementById('totalMinute').innerHTML;
            var totalVolunteer = volunteerForPcr+volunteerForVaccine+volunteerForBooster;
            document.getElementById('totalManMinutePerDay').innerHTML = totalMinute * totalVolunteer;

        }

        function setTotalMinute() {
            var totalMorningSlotTime = parseInt(document.getElementById('totalMorningSlotTime').innerHTML);
            var totalDaySlotTime = parseInt(document.getElementById('totalDaySlotTime').innerHTML);
            document.getElementById('totalMinute').innerHTML = totalMorningSlotTime + totalDaySlotTime;
            

        }

        function setMorningSlotTime() {
            var morningSlotStart = document.getElementById('morningSlotStart').value;
            var morningSlotEnd = document.getElementById('morningSlotEnd').value;

            //create minute format          
            var timeStart = new Date("01/01/2007 " + morningSlotStart).getMinutes();
            var timeEnd = new Date("01/01/2007 " + morningSlotEnd).getMinutes();
            var minuteDifferent = timeEnd - timeStart;
            var timeStart = new Date("01/01/2007 " + morningSlotStart).getHours();
            var timeEnd = new Date("01/01/2007 " + morningSlotEnd).getHours();
            var hourDifferent = timeEnd - timeStart;
            var actualMinute = (hourDifferent * 60) + minuteDifferent;
            document.getElementById('totalMorningSlotTime').innerHTML = actualMinute;
            setMaxPcrService();
            setMaxVaccineService();
            setMaxBoosterService();
            setTotalMinute();
            setTotalManMinutePerDay()

        }

        function setDaySlotTime() {
            var daySlotStart = document.getElementById('daySlotStart').value;
            var daySlotEnd = document.getElementById('daySlotEnd').value;

            //create minute format          
            var timeStart = new Date("01/01/2007 " + daySlotStart).getMinutes();
            var timeEnd = new Date("01/01/2007 " + daySlotEnd).getMinutes();
            var minuteDifferent = timeEnd - timeStart;
            var timeStart = new Date("01/01/2007 " + daySlotStart).getHours();
            var timeEnd = new Date("01/01/2007 " + daySlotEnd).getHours();
            var hourDifferent = timeEnd - timeStart;
            var actualMinute = (hourDifferent * 60) + minuteDifferent;
            document.getElementById('totalDaySlotTime').innerHTML = actualMinute;
            setMaxPcrService();
            setMaxVaccineService();
            setMaxBoosterService();
            setTotalMinute();
            setTotalManMinutePerDay()
        }
    </script>
@endpush
