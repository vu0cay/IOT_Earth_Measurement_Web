
import { global } from "../../init/global";
import { getSensorInfos, getSensorData } from "../../../API/sensorThings/getSensorInfos";

const content = document.getElementById('popup-content');



export async function popUp(evt) {
  const coordinate = evt.coordinate;
  content.innerHTML = `${evt.coordinate}<br><h1>Loading</h1>`;
  global.overlay.setPosition(coordinate);
  content.innerHTML = await processEvent(evt);

}

async function processEvent(evt) {
    const featuresAtPixel = [];
    global.map.forEachFeatureAtPixel(evt.pixel, function (feature, layer) {
        featuresAtPixel.push({ feature, layer });
    });

    // Process features one by one
    for (const { feature, layer } of featuresAtPixel) {
        if (layer === global.anchors) {
            // const sensorInfos = await getSensorInfos(feature.getId());
            // const sensorData = await getSensorData(feature.getId())
            // const token = 'pWn3VuR5FKFglahFP3MehC63x8qWYne6hbnZhKYQljNpTzamtAutbqNgHXG9';
            let sensorData = await getSensorData();

            
            // const timestamp = new Date(sensorData.time.replace(" ", "T")).getTime();;
            
            let str = '';
            
            
            for(const nutrient of sensorData.nutrients) {
                const arr = Object.values(nutrient);

                str = str.concat(`${arr[0]}: ${arr[1]} - ${arr[2]}<br>`);
            }
            console.log(str);

            let nutrients_measurement = '';
            nutrients_measurement = nutrients_measurement.concat(
                `N: ${sensorData.N_measure}<br>
                P: ${sensorData.P_measure}<br>
                K: ${sensorData.K_measure}<br>
                S: ${sensorData.S_measure}<br>
                Ca: ${sensorData.Ca_measure}<br>`);
            if(sensorData) {
                return `
                <h1><strong>Tọa độ:</strong><br>${evt.coordinate}</h1>
                <h1><strong>Cây phù hợp:</strong> ${sensorData.tree_name}</h1>
                <h1><strong>Loại:</strong> ${sensorData.tree_category}</h1>
                <h1><strong>Dinh dưỡng đo được:</strong><br>${nutrients_measurement}</h1>
                <h1><strong>Dinh dưỡng phù hợp:</strong><br>${str}</h1>
                `;
            }
        }
    }

    // Default fallback if no features match
    return `${evt.coordinate}<br><p>No feature information available</p>`;
}


// function timeAgo(timestamp) {
//     const now = Date.now(); // Current time in milliseconds
//     console.log(new Date(now).toLocaleString());

//     const elapsed = now - timestamp; // Difference in milliseconds

//     // Convert elapsed time to units
//     const seconds = Math.floor(elapsed / 1000);
//     const minutes = Math.floor(seconds / 60);
//     const hours = Math.floor(minutes / 60);
//     const days = Math.floor(hours / 24);
//     const weeks = Math.floor(days / 7);
//     const months = Math.floor(days / 30); // Approximation: 30 days in a month
//     const years = Math.floor(days / 365); // Approximation: 365 days in a year

//     // Determine the most appropriate unit to display
//     if (seconds < 60) {
//         return `${seconds} seconds ago`;
//     } else if (minutes < 60) {
//         return `${minutes} minutes ago`;
//     } else if (hours < 24) {
//         return `${hours} hours ago`;
//     } else if (days < 7) {
//         return `${days} days ago`;
//     } else if (weeks < 4) {
//         return `${weeks} weeks ago`;
//     } else if (months < 12) {
//         return `${months} months ago`;
//     } else {
//         return `${years} years ago`;
//     }
// }
