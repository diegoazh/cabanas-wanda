import { http, handlingXhrErrors } from '../../axios/app-axios'

export default {
    sendFinalLiquidation(cntx, payload) {
        return new Promise((resolve, reject) => {
            http.post('liquidation/final', payload)
                .then(response => {
                    resolve({
                        title: '¡Excelente!',
                        message: response.data.message,
                        useSwal: true
                    });
                })
                .catch(error => {
                    let messages = handlingXhrErrors(error);
                    messages.useSwal = true;
                    reject(messages);
                });
        });
    }
}