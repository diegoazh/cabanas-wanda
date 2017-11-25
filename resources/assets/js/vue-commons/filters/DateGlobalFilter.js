import moment from 'moment';

export const DateArgFilter = function (value, formatIn = 'YYYY-MM-DD HH:mm:ss', formatOut = 'DD/MM/YYYY HH:mm:ss') {
    if (!value || typeof value !== 'string' || typeof formatIn !== 'string' || typeof formatOut !== 'string') {
        console.error('Los argumentos de DateArgFilter deben ser de tipo string.');
        return;
    }

    return moment(value, formatIn).format(formatOut);
};