document.addEventListener("DOMContentLoaded", function () {
    if (!window.dashboardData) return;

    const { currency, chartData, chartCategories } = window.dashboardData;

    const options = {
        series: [
            {
                name: "Amount",
                data: chartData,
            },
        ],
        chart: {
            type: "bar",
            height: 350,
            toolbar: { show: false },
            fontFamily: "Inter, sans-serif",
            background: "transparent",
        },
        colors: [
            function ({ value }) {
                return value > 0 ? "#10B981" : "#EF4444";
            },
        ],
        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: "55%",
                colors: {
                    ranges: [
                        { from: -10000000000, to: 0, color: "#EF4444" },
                        { from: 0, to: 10000000000, color: "#10B981" },
                    ],
                },
            },
        },
        dataLabels: { enabled: false },
        grid: {
            borderColor: "#333333",
            strokeDashArray: 4,
            yaxis: { lines: { show: true } },
        },
        xaxis: {
            categories: chartCategories,
            labels: { style: { colors: "#A1A1AA" } },
            axisBorder: { show: false },
            axisTicks: { show: false },
        },
        yaxis: {
            labels: {
                style: { colors: "#A1A1AA" },
                formatter: (val) => (Math.abs(val) / 1000000).toFixed(1) + "M",
            },
        },
        tooltip: {
            shared: true,
            intersect: false,
            custom: function ({ series, seriesIndex, dataPointIndex, w }) {
                const value = series[seriesIndex][dataPointIndex];
                const isExpense = value < 0;

                const color = isExpense ? "#EF4444" : "#10B981";
                const title = isExpense ? "Exp" : "Inc";

                const formattedValue = new Intl.NumberFormat(undefined, {
                    style: "currency",
                    currency: currency,
                    minimumFractionDigits: currency === "JPY" ? 0 : 2,
                }).format(value);

                return `
                        <div style="
                            background:#212121;
                            border-color:#2F2F2F;
                            border-radius:10px;
                            padding:10px 12px;
                            color:white;
                            font-family:Inter, sans-serif;
                            min-width:180px;
                            box-shadow:0 12px 30px rgba(0,0,0,.6);
                        ">
                            <div style="
                                font-size:13px;
                                font-weight:600;
                                margin-bottom:6px;
                            ">
                                ${title}
                            </div>

                            <div style="
                                display:flex;
                                align-items:center;
                                gap:8px;
                                font-size:14px;
                            ">
                                <span style="
                                    width:10px;
                                    height:10px;
                                    border-radius:50%;
                                    background:${color};
                                    display:inline-block;
                                "></span>

                                <span style="color:#e5e7eb;">
                                    Amount:
                                </span>

                                <span style="
                                    font-weight:600;
                                    color:${color};
                                ">
                                    ${formattedValue}
                                </span>
                            </div>
                        </div>`;
            },
        },

        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                type: "vertical",
                opacityFrom: 1,
                opacityTo: 0.6,
            },
        },
    };

    const el = document.querySelector("#financeChart");
    if (el) {
        const chart = new ApexCharts(el, options);
        chart.render();
    }
});
