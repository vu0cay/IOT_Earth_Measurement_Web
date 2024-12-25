import { Chart } from "chart.js/auto";
import { LinearScale, CategoryScale, Title, Tooltip, Legend } from "chart.js";
import { getAllObservations } from "../API/sensorThings/getSensorInfos";
Chart.register(LinearScale, CategoryScale, Title, Tooltip, Legend);

// var airData = []
// var waterData = []


//-------fake data------------------------//
// function generateRandomArray() {
//     const randomArray = Array.from({ length: 11 }, () => Math.floor(Math.random() * 100)); //
//     // console.log("Generated array:", randomArray);
//     return randomArray;
// }

// setInterval(() => {
//     airData = generateRandomArray()
//     waterData = generateRandomArray()
//     console.log(airData)
// }, 800);


//----------------------------------------------------------//
document.addEventListener("DOMContentLoaded",function () {

    
    setInterval(async () => {
        var airData = []
        // console.log("dust: ",airData);    

        airData = await generateRandomArray()

        airlineChart.data.datasets[0].data = airData.reverse();
        airlineChart.update();


        // console.log(airData)
    }, 5000);

    async function generateRandomArray() {
        // const randomArray = Array.from({ length: 12 }, () => Math.floor(Math.random() * 15)); //
        // console.log("Generated array:", randomArray);
        // console.log("air chart: ",randomArray);
        const arr = [];
        try{
            const observations = await getAllObservations(10);
            if(observations.length > 0){
                observations.forEach(element => {
                    // console.log(element.result[0].dust);
                    if (element.result && element.result[0] && element.result[0].dust !== undefined) {
                        const input = element.result[0].dust;
                        const numericPart = input.match(/[\d.]+/)[0];
                        if(numericPart) {
                            arr.push(parseFloat(numericPart));
                        }
                    }
                });
            }

        } catch(error) {
            console.log("Error", error.message);
        }
        console.log(arr);
        return arr;
    }

    var ctx = document.getElementById('airChart').getContext('2d');

    // Tạo một Line Chart
    const labels = Array.from({ length: 206 }, (_, i) => i + 1); // Labels: 1 to 1000

    var airlineChart = new Chart(ctx, {
        type: 'line',
        data: {
            // labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            labels: labels,
            datasets: [{
                label: 'Bụi mịn (µg/m³)',
                data: [65, 59, 80, 81, 56, 55, 40, 22, 33, 13, 45, 64],
                fill: false,
                borderColor: '#00afef',
                tension: 0.1
            }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // function updateChart() {
    //     // console.log('air')
    //     airlineChart.data.datasets[0].data = airData
    //     airlineChart.update();
    // }

    // setInterval(updateChart, 2000)
})