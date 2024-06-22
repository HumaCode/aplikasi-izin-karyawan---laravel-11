import  $ from 'jquery'
import '../vendor/datatable'
import { AjaxAction, HandleFormSubmit, initDatepicker } from '../lib/utils'


$('.main-content').on('click', '.action', function(e) {

    if (!this.dataset.action) {
        throw new Error('data attribute action must provide!!')
    }

    (new AjaxAction(this))
    .onSuccess(function(res) {

        initDatepicker();

        // modal atasan
        $('.add-atasan').on('click', function() {
            (new AjaxAction(this))
            .onSuccess(res => {

                const modalEl = $('#modalSearch')
                modalEl.html(res)
                modalEl.modal('show');

                // saat tabel atasan di klik
                $('#listatasan-table').on('click', 'tr', function() {
                    // console.log(this);
                    modalEl.modal('hide')

                    const atasan = `<tr>
                                        <td>${this.dataset.nama}</td>
                                        <td>${this.dataset.email}</td>
                                        <td>
                                            <input class="form-control" placeholder="Level Atasan" name="atasan[${this.dataset.id}]">
                                        </td>
                                    </tr>`;

                    $('#listAtasan').prepend(atasan);
                });

            }, false)
            .execute();
        });

        (new HandleFormSubmit())
            .onSuccess(res => {

            })
            .reloadDatatable('user-table')
            .init()
    })
    .execute()

})