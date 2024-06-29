import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import bootstrap5Plugin from '@fullcalendar/bootstrap5';
import interactionPlugin from '@fullcalendar/interaction';
import 'bootstrap-icons/font/bootstrap-icons.min.css';
import { AjaxAction, HandleFormSubmit, confirmation, initDatepicker, reloadDatatable, showToast } from '../lib/utils'


let calendarEl = document.getElementById('calendar');
let calendar = new Calendar(calendarEl, {
    plugins: [ dayGridPlugin, timeGridPlugin, listPlugin, bootstrap5Plugin, interactionPlugin ],
    themeSystem: 'bootstrap5',
    initialView: 'dayGridMonth',
    headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listWeek'
    },
    dateClick: (ev) => {
        const el = document.createElement('button')
        el.setAttribute('data-action', window.location.origin + `/hari-libur/create?tanggal-awal=${ev.dateStr}&tanggal_akhir=${ev.dateStr}`)
        el.innerText = 'Tambah';

        (new AjaxAction(el))
        .onSuccess(res => {
            initDatepicker();

            (new HandleFormSubmit())
            .onSuccess(res => {
                calendar.refetchEvents()
            })
            .init()
        })
        .execute()

    }
});
calendar.render();