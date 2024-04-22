<script>

// Find the JavaScript code that initializes the ApexChart
var radialbarWidget1 = new ApexCharts(document.querySelector("#radialbarWidget1"), {
    series: [30, 40, 50, 60], // Modify this array to change the data values
    chart: {
        type: 'radialBar',
        height: 350
    },
    labels: ['Label 1', 'Label 2', 'Label 3', 'Label 4'] // Update labels as needed
});

// Render the chart
radialbarWidget1.render();

</script>
