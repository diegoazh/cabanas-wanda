import axios from 'axios'

export const http =  axios.create({
    baseURL: 'http://homestead.app/api/',
    timeout: 5000,
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    },
});