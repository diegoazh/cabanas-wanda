import { http, handlingXhrErrors } from '../../axios/app-axios'

export default {
    getReportRentals(cntx, payload) {
        return new Promise((resolve, reject) => {
            http.get('reports/rentals')
                .then(response => {
                    cntx.commit('setRentals', response.data.rentals);
                    resolve(cntx.state.data.dataReports);
                })
                .catch(error => {
                   let err = handlingXhrErrors(error);
                    err.useSwal = true;
                   reject(err);
                });
        })
    }
}