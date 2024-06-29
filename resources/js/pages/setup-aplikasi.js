import  $ from 'jquery'
import '../vendor/datatable'
import { AjaxAction, HandleFormSubmit, confirmation, initDatepicker, initSelect2, reloadDatatable, showToast } from '../lib/utils'



$('.main-content').on('click', '[data-action]', function(e) {

    if (this.dataset.method == 'delete') {
        confirmation(res => {
            (new AjaxAction(this))
            .onSuccess(res => {
                showToast(res.status, res.message)
                reloadDatatable('setupaplikasi-table')
            }, false)
            .execute()
        })

        return
    };

    (new AjaxAction(this))
    .onSuccess(function(res) {

        initSelect2();

        (new HandleFormSubmit())
        .onSuccess(res => {

        })
        .reloadDatatable('setupaplikasi-table')
        .init()
    })
    .execute()

})