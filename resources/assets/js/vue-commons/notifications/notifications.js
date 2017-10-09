import VueNotifications from 'vue-notifications'
import iziToast from 'izitoast'
import 'izitoast/dist/css/iziToast.min.css'
import swal from 'sweetalert'

function toastIziSwal ({title, message, type, timeout, cb, useSwal}) {
    if (type === VueNotifications.types.warn) type = 'warning';

    if (useSwal) {
        return swal(title, message, type);
    } else {
        return iziToast[type]({title, message, timeout})
    }
}

export const optionsIzi  = {
    success: toastIziSwal,
    error: toastIziSwal,
    info: toastIziSwal,
    warn: toastIziSwal
};