<template>
    <v-e-chart :options="options" :autoresize="true"/>
</template>

<script>
    import ECharts from 'vue-echarts';
    import 'echarts/lib/chart/line';
    import 'echarts/lib/chart/candlestick';
    // import 'echarts/lib/component/legend';
    import 'echarts/lib/component/tooltip';
    import 'echarts/lib/component/dataZoom';
    // import 'echarts/lib/component/legend';
    // import 'echarts/lib/component/toolbox'

    export default {
        props: ['data'],
        components: {
            'v-e-chart': ECharts
        },
        mounted() {

        },
        data() {
            return {
                range: 'all',
                tempMonth: null,
                options: {
                    grid: {
                        top: 0,
                        left: 1,
                        right: 1,
                        show: true,
                        backgroundColor: 'rgba(0,0,0,0.2)',
                        borderWidth: 0
                    },
                    tooltip: {
                        confine: true,
                        trigger: 'axis',
                        // backgroundColor: 'rgba(255,255,255,0.5)',
                        position: function (pt) {
                            return [pt[0], '10%'];
                        },
                        formatter: (params, ticket, callback) => {
                            let sorted = _.sortBy(params, function(item){
                                return -item.data[1];
                            });
                            // console.log(sorted);

                            let text = '<table><tr><td colspan="99" class="is-size-5">' + moment.utc(params[0].axisValue).local().format('L HH:mm') + '</td></tr>';

                            for (let i = 0; i < sorted.length; i++) {
                                if(sorted[i].data[1]){
                                    text += '<tr>';
                                    // text += '<td class="tw-flex tw-items-center tw-mr-2"><span class="tw-w-3 tw-h-3 tw-rounded-full tw-mr-2" style="background-color:' + sorted[i].color + '"></span><span>' + sorted[i].seriesName + '</span></td>';
                                    text += '<td>' + this.currencyString(sorted[i].data[1]) + '</td>';
                                    text += '</tr>'
                                }
                            }

                            text += '</table>';

                            return text;
                        }
                        // position: [0,0]
                    },
                    title: {
                        left: 'center',
                        text: '',
                    },
                    xAxis: {
                        type: 'time',
                        // splitNumber: this.totalXticks + 1,
                        scale: true,
                        splitLine: {
                            show: false,
                        },
                        axisTick: {
                            show: false,
                            lineStyle: {
                                color: '#fff'
                            }
                        },
                        axisLine: {
                            show: false,
                        },
                        axisLabel: {
                            // align: 'left',
                            // formatter: function (value, index) {
                            //     return value;
                            // }
                            // inside: true
                            showMinLabel: false,
                            showMaxLabel: false,
                            // backgroundColor: 'red',
                            // formatter: (value, index) => {
                            //     // Formatted to be month/day; display year only in the first label
                            //     let lemoment = moment.utc(value).local();
                            //     console.log(index);
                            //     // if(lemoment.day() === 1){
                            //         return lemoment.format('MMM');
                            //     // }
                            // },
                            formatter: function(x) {
                                let tempMonth = (moment.utc(x).locale('es')).format('MMMM');
                                if(tempMonth !== window.tempMonth){
                                    window.tempMonth = tempMonth;
                                    return tempMonth;
                                }
                                return null;
                            },
                            color: '#fff'
                        },
                    },
                    yAxis: {
                        show: true,
                        type: 'value',
                        scale: true,
                        boundaryGap: ['5%', '5%'],
                        // axisLabel: {},
                        // inverse: true,
                        axisLine: {
                            show: false,
                        },
                        axisTick:{
                            show: false,
                            inside: true,
                            lineStyle: {
                                color: '#fff'
                            }
                        },
                        axisLabel:{
                            show: true,
                            inside: true,
                            showMinLabel: false,
                            showMaxLabel: false,
                            color: 'rgba(255,255,255,0.6)'
                        },
                        splitLine:{
                            show: false,
                            lineStyle:{
                                color: 'rgba(255,255,255,0.2)'
                            }
                        }
                    },
                    dataZoom: [
                        {
                            zoomOnMouseWheel: false,
                            moveOnMouseMove: false,
                            moveOnMouseWheel: false,
                            type: 'inside',
                            start: 0,
                            startValue: moment.utc().subtract('7', 'days').valueOf(),
                            end: 100,
                        }
                    ],
                    series: this.data
                }
            }
        },
        computed: {
            totalXticks(){
                return moment.utc().diff(moment.utc(this.data[0]['data'][0][0]), 'months');
            }
        },
        methods: {
            setRange(days) {
                this.range = days;
                if (days !== 'all') {
                    this.options.dataZoom[0].start = null;
                    this.options.dataZoom[0].startValue = moment.utc().subtract(days, 'days').valueOf();
                } else {
                    this.options.dataZoom[0].start = 0;
                }

            },
            roundCurrency(value){
                let decimals = 2;

                if(value < 1){
                    decimals = 3 + Math.abs(Math.floor( Math.log(parseFloat(value)) / Math.log(10) + 1));
                }

                if(decimals > 15){
                    decimals = 15;
                }
                return parseFloat(value).toFixed(decimals).toString();
            },
            currencyString(value){
                return this.roundCurrency(value).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            },
        }
    }
</script>

<style lang="scss">
    /**
     * The default size is 600px×400px, for responsive charts
     * you may need to set percentage values as follows (also
     * don't forget to provide a size for the container).
     */
    .echarts {
        width: 100%;
        height: 400px;
        @media screen and (max-width: 768px) {
            height: 250px;
        }
    }
</style>