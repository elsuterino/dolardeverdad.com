require('./bootstrap');

import Vue from 'vue';
import axios from './plugins/axios';


Vue.component('main-page', require('./components/Main').default);

Vue.mixin({
    filters: {
//        formatMoney(value, currency = 'VES') {
//            this.formatMoney(value, currency)
//        },
        formatPercent(value){
            return value ? Number.parseFloat(value).toFixed(2) : null;
        }
    },
    methods: {
        formatMoney(value, currency = 'VES') {
            if(!value){
                return null;
            }

            let formatter = new Intl.NumberFormat('es-VE', {
                style: 'currency',
                currency: currency
            });

            return formatter.format(value)//.replace(/[^0-9.,]/g, '');
        }
    }
});

const app = new Vue({
    el: '#app',
});
