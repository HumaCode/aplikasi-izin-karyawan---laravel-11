import $ from 'jquery'
import iziToast from 'izitoast'
import 'izitoast/dist/css/izitoast.min.css'
import 'bootstrap-datepicker'
import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'
import Swal from 'sweetalert2'
import select2 from 'select2'
import 'select2/dist/css/select2.min.css'
import 'select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.min.css'

const modalEl = $('#modalAction')


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
    }
})

export function reloadDatatable(id) {
    window.LaravelDataTables[id]?.ajax.reload(null, false);
}

export function confirmation(cb, configs = {})
{
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger",
            confirmButton: 'btn btn-success mx-2', 
            cancelButton: 'btn btn-danger mx-2'
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Yakin?",
        text: "Kamu akan menghapus data ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus saja!",
        cancelButtonText: "Tidak, Batalkan!",
        reverseButtons: true,
        ...configs
    }).then((result) => {
        if (result.isConfirmed) {
            if (cb && cb(result)) {
            }
            swalWithBootstrapButtons.fire({
                title: "Berhasil",
                text: "Data berhasil dihapus.",
                icon: "success"
            });
        } else if (
          /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
            title: "Hapus Dibatalkan",
            text: "Datanya Gak jadi di hapus boss :)",
            icon: "error"
        });
    }});
}

export function initSelect2(selector = '.select2', options = {}) {
    select2($)
    const _select = $(selector) 
    _select.select2({
        placeholder: _select.data('placeholder'),
        theme: 'bootstrap-5',
        dropdownParent: _select.parents('.modal-content')
    })
}

export function initDatepicker(selector = '.date', options = {}) {

    const date = $(selector).datepicker({
                    autoclose: true,
                    todayHighlight: false,
                    assumeNearbyYear: true,
                    defaultViewDate:true,
                    ...options
                });

    return date
}

export function showToast(type =  'success', message = 'Berhasil Menyimpan Data.') {
    iziToast[type]({
        title: 'Info', 
        message,
        position: 'topRight',
    })
}

class AjaxOption {
    successCb = null
    runDefaultSuccessCb = true 
    
    errorCb = null
    runDefaultErrorCb = true 

    onSuccess(cb, runDefault = true) {
        this.successCb = cb
        this.runDefaultSuccessCb = runDefault 
        return this
    }

    onError(cb, runDefault = true) {
        this.errorCb = cb
        this.runDefaultErrorCb = runDefault 
        return this
    }
}

export class AjaxAction extends AjaxOption{
    options = {}
    constructor(el) {
        super()
        this.el = $(el)
        this.label = this.el.html()
    }

    setOption(_option) {
        this.options = _option
        return this
    }

    execute() {
        $.ajax({
            url: this.el.data('action'),
            method: this.el.data('method') ?? 'get',
            ...this.options,
            beforeSend: () => {
                this.el.attr('disabled', true)
                this.el.html('Loading...')
            },
            success: res => {
                if (this.runDefaultSuccessCb) {
                    modalEl.html(res)
                    modalEl.modal('show')
                }

                this.successCb && this.successCb(res)
            },
            error: err => {
                if (this.runDefaultErrorCb) {
                    
                }

                this.errorCb && this.errorCb(err)
            }, 
            complete: () => {
                this.el.attr('disabled', false)
                this.el.html(this.label)
            }
        })
    }
}

export class HandleFormSubmit extends AjaxOption{
    dataTableId = null
    constructor(formId = '#formAction') {
        super()
        this.formId         = $(formId)
        this.button         = this.formId.find('button[type="submit"]')
        this.buttonLabel    = this.button.html()
    }

    reloadDatatable(id) {
        this.dataTableId = id
        return this
    }

    init() {
        const _this = this

        this.formId.on('submit', function(e) {
            e.preventDefault()

            $.ajax({
                url: _this.formId.attr('action'),
                method: _this.formId.attr('method'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: () => {
                    _this.button.attr('disabled', true).html('Loading...')
                },  
                success: res => {
                    if (_this.runDefaultSuccessCb) {
                        // console.log(res);
                        modalEl.modal('hide')

                    }

                    showToast(res?.status)
                    _this.successCb && _this.successCb(res)

                    if (_this.dataTableId) {
                        window.LaravelDataTables[_this.dataTableId].ajax.reload(null, false)
                    }
                },
                error: err => {
                    if (_this.runDefaultErrorCb) {
                        $('.is-invalid').removeClass('is-invalid')
                        $('.invalid-feedback').remove()

                        const message = err.responseJSON?.message
                        const errors = err.responseJSON?.errors

                        showToast('error', message)
                        if (errors) {
                            let i = 0
                            for (let [key, value] of Object.entries(errors)) {
    
                                let input = $(`[name="${key}"]`)

                                if (!input.length) {
                                    input = $(`[name="${key}[]"]`)
                                }

                                if (i === 0) {
                                    input.focus()
                                }
                                input.addClass('is-invalid').parents('.form-wrapper').append(`<div class="invalid-feedback">${value}</div>`)
                            
                                i++
                            }
                        }

                    }

                    _this.errorCb && _this.errorCb(res)
                    _this.button.attr('disabled', false).html(_this.buttonLabel)
                },  
                complete: () => {
                    _this.button.attr('disabled', false).html(_this.buttonLabel)
                }
            })
        })
    }
}