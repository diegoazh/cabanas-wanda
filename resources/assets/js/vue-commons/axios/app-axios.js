import axios from 'axios'

export const http =  axios.create({
    baseURL: 'http://homestead.app/api/',
    timeout: 5000,
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    },
});

export function handlingXhrErrors(error) {
    if (error.response) {
        // The request was made and the server responded with a status code
        // that falls out of the range of 2xx
        return {
            title: error.response.data.title ? error.response.data.title : 'ERROR ' + error.response.status,
            message: error.response.data.error
        };
    } else if (error.request) {
        // The request was made but no response was received
        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
        // http.ClientRequest in node.js
        console.log('Info', error.request);
        return {
            title: 'Se produjo un error',
            message: 'No hemos recibido respuesta desde el servidor.'
        };
    } else {
        // Something happened in setting up the request that triggered an Error
        console.log('Error', error.message);
        return {
            title: 'Se produjo un error',
            message: 'Algo ocurrio generando la petición al servidor.'
        }
    }
}