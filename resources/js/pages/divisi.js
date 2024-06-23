import  $ from 'jquery'
import '../vendor/datatable'
import { AjaxAction, HandleFormSubmit, confirmation, initDatepicker, reloadDatatable, showToast } from '../lib/utils'


$('.main-content').on('click', '.action-delete', function(e) {
    confirmation(res => {
        (new AjaxAction(this))
        .onSuccess(res => {
            showToast(res.status, res.message)
            reloadDatatable('divisi-table')
        }, false).execute();
    })
});

$('.main-content').on('click', '.action', function(e) {

    if (!this.dataset.action) {
        throw new Error('data attribute action must provide!!')
    }

    (new AjaxAction(this))
    .onSuccess(function(res) {

        (new HandleFormSubmit())
        .onSuccess(res => {

        })
        .reloadDatatable('divisi-table')
        .init()
    })
    .execute()

})