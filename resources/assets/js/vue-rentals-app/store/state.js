export default {
    data: {
        isAdmin: false,
        user: {},
        deal: false,
        closedDeal: false,
        cottages: [],
        toRentals: [],
        countries: []
    },
    lastQueryData: {
        query: 0,
        simple: false,
        dateFrom: '',
        dateTo: '',
    },
    xhr: {
        token: '',
        queryFinished: true
    },
    frmCmp: {
        isForCottage: false,
        configForAdmin: {
            locale: 'es',
            format: 'DD/MM/YYYY',
            minDate: moment(moment().format('DD/MM/YYYY') + ' 00:00 AM', 'DD/MM/YYYY hh:mm A'),
            maxDate: moment().add(2, 'Y')
        },
        configForUser: {
            locale: 'es',
            format: 'DD/MM/YYYY',
            minDate: moment(moment().add(2, 'd').format('DD/MM/YYYY') + ' 00:00 AM', 'DD/MM/YYYY hh:mm A'),
            maxDate: moment().add(2, 'Y')
        },
    },
};