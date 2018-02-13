import { http, handlingXhrErrors} from '../../axios/app-axios'
import moment from 'moment'

export default {
    createNewPromotion(cntx, payload) {
        return new Promise((resolve, reject) => {
            http.post('promotion/store', payload, {
                params: token,
            })
        });
    }
}