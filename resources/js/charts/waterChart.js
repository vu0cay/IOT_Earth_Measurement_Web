import { Chart } from "chart.js/auto";
import { LinearScale, CategoryScale, Title, Tooltip, Legend } from "chart.js";
import { getAllObservations } from "../API/sensorThings/getSensorInfos";
import { isNullOrUndef } from "chart.js/helpers";
Chart.register(LinearScale, CategoryScale, Title, Tooltip, Legend);
document.addEventListener("DOMContentLoaded",function () {

    

    setInterval(async () => {
        var waterData = []
            
        waterData = await generateRandomArray();
        // waterData.then(res => {
        //     console.log("turbidity: ");
        // })
        // console.log(promise);
        // promise.then(
        //     res => {
        //         // console.log(res); 
        //         waterData = res;
        //     }
        // );
        // // if(!waterData) waterData = []
        // if(waterData.length() > 0) {
        waterlineChart.data.datasets[0].data = waterData.reverse();
        waterlineChart.update();
        // }

    }, 5000 );

    async function generateRandomArray() {
        // const randomArray = Array.from({ length: 12 }, () => Math.floor(Math.random() * 8)); //
        // console.log("Generated array:", randomArray);
        const arr = [];
        try{
            const observations = await getAllObservations(11);
            console.log(observations);
            if(observations.length > 0){
                observations.forEach(element => {
                    if (element.result && element.result[0] && element.result[0].turbidity !== undefined) {
                        const input = element.result[0].turbidity;
                        
                        const numericPart = input.match(/[\d.]+/)[0];
                        if(numericPart) {
                            arr.push(parseFloat(numericPart));
                        }
                }
                });
            }
            
        } catch(error) {
            console.log("12312412", error.message);
        }
        // console.log(arr);
        return arr;
    }

    var ctx = document.getElementById('waterChart').getContext('2d');

    // Tạo một Line Chart
    const labels = Array.from({ length: 206 }, (_, i) => i + 1); // Labels: 1 to 1000

    var waterlineChart = new Chart(ctx, {
        type: 'line',
        data: {
            // labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            labels: labels,
            datasets: [{
                label: 'Độ đục nước (NTU)',
                data: [65, 59, 80, 81, 56, 55, 40, 22, 33, 13, 45, 64],
                fill: false,
                borderColor: '#1f5ca9',
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

    // async function updateChart() {
    //     console.log("data: ",waterData);
    //     waterlineChart.data.datasets[0].data = waterData
    //     waterlineChart.update();
    // }

    // setInterval(updateChart, 2000)
})