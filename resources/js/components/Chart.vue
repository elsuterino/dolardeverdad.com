<template>
    <div class="relative">
        <div v-if="tooltip.open && tooltip.title"
             class="absolute bg-white text-black pointer-events-none text-xs tooltip rounded-lg bg-yellow-500 whitespace-no-wrap px-4 py-2"
             :style="`left:${tooltip.x}px; top:${tooltip.y}px`">
            <div class="relative">
                <p class="text-center text-lg text-yellow-900 font-semibold">{{ formatMoney(tooltip.title) }}</p>
                <p class="text-yellow-800">{{ tooltip.text }}</p>
                <div class="tooltip-caret"/>
            </div>
        </div>
        <svg :viewBox="`0,0,${width},${height}`" class="svg py-4">
            <g>
                <path
                    class="transition-all duration-500"
                    fill="none"
                    stroke-width="2"
                    stroke="#ecc94b"
                    stroke-linejoin="round"
                    stroke-linecap="round"
                    :d="chart"
                />
                <circle
                    v-if="tooltip.open && tooltip.title"
                    r="6"
                    :cx="tooltip.dotX"
                    :cy="tooltip.dotY"
                    fill="#ecc94b"
                    stroke="#2d3748"
                    stroke-width="3"
                />
                <rect
                    fill="none"
                    pointer-events="all"
                    :width="width"
                    :height="height"
                    class="cursor-crosshair"
                    @mousemove="onMouseMove"
                    @mouseenter="tooltip.open = true"
                    @mouseleave="tooltip.open = false"
                />
            </g>
        </svg>
    </div>
</template>

<script>
    import {
        line as d3line,
        scaleUtc as d3scaleUtc,
        scaleLinear as d3scaleLinear,
        extent as d3extent,
        curveMonotoneX as d3curveMonotoneX,
        bisector as d3bisector
    } from 'd3';

    export default {
        props: {
            chartData: Array
        },
        data() {
            return {
                width: 1000,
                height: 500,
                svg: {},
                dummyData: [],
                tooltip: {
                    open: false,
                    title: '',
                    text: '',
                    x: 0,
                    y: 0,
                    dotX: 0,
                    dotY: 0
                }
            }
        },
        watch: {
            chartData: {
                handler() {

                }
            }
        },
        computed: {
            leData() {
                return this.chartData.map(point => ({time: new Date(point.time), value: parseFloat(point.value)}));
            },
            xAxis() {
                return d3scaleUtc()
                    .domain(d3extent(this.leData, d => d.time))
                    .range([0, this.width])
            },
            yAxis() {
                return d3scaleLinear()
                    .domain(d3extent(this.leData, d => d.value))
                    .range([this.height, 0])
            },
            chart() {
                let data = this.leData;

                const line = d3line()
                    .curve(d3curveMonotoneX)
                    .defined(d => !isNaN(d.value))
                    .x(d => this.xAxis(d.time))
                    .y(d => this.yAxis(d.value))

                return line(data);
            }
        },
        methods: {
            onMouseMove(e) {
                if (!this.chartData || this.chartData.length === 0) return;

                const rect = e.target.getBoundingClientRect();

                const coords = {x: e.offsetX, y: e.offsetY}

                const actualX = this.width / rect.width * coords.x;

                const hoveredDate = this.xAxis.invert(actualX);

                const bisectDate = d3bisector(d => d.time).left;

                const i = bisectDate(this.leData, hoveredDate, 1);

                const d0 = this.leData[i - 1];

                this.tooltip.title = d0.value;
                this.tooltip.text = d0.time.toLocaleString();
                this.tooltip.dotX = this.xAxis(d0['time']);
                this.tooltip.dotY = this.yAxis(d0['value']);
                this.tooltip.x = this.xAxis(d0['time']) / this.width * rect.width;
                this.tooltip.y = this.yAxis(d0['value']) / this.height * rect.height;
            }
        },
        mounted() {

        }
    }
</script>

<style lang="scss" scoped>
    path {
        transition: all 300ms;
    }

    .tooltip {
        transform: translateX(-50%) translateY(-100%);

        .tooltip-caret {
            position: absolute;
            top: calc(100% + 0.5rem);
            left: 50%;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;

            border-top: 10px solid theme('colors.yellow.500');
            transform: translateX(-50%);

        }
    }
</style>
