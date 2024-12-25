  import { Chart } from "chart.js/auto";
  import { LinearScale, CategoryScale, Title, Tooltip, Legend } from "chart.js";
  Chart.register(LinearScale, CategoryScale, Title, Tooltip, Legend);
  window.onload = function() {
          var ctx = document.getElementById('lineChart').getContext('2d');
          
          // Tạo một Line Chart
          var lineChart = new Chart(ctx, {
              type: 'line',
              data: {
                  labels: ['1', '2', '3', '4', '5', '6', '7','8','9','10','11'], 
                  datasets: [{
                      label: 'DATA1',
                      data: [65, 59, 80, 81, 56, 55, 40,22,33,13,45,64],
                      fill: false, 
                      borderColor: '#00afef',
                      tension: 0.1
                  },
                  {
                    label: 'DATA2',
                    data: [15, 53, 30, 71, 16, 25, 30,62,23,13,65,55], 
                    fill: false, 
                    borderColor: '#1f5ca9', 
                    tension: 0.1 
                },
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
      }
