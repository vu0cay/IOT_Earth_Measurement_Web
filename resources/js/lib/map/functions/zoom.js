
import { global } from '../global';
import { roomGEOJSON } from '../features/unit';
import { transform } from "ol/proj";
import { highlightFeature } from '../onClick/hightLight';
import { toggleSidePanel } from '../onClick/sidePanel';

export function zoomInto(id) {
    let coordinates ;
  
    roomGEOJSON.forEachFeature(function (feature) {
      if (String(feature.getId()) === String(id)) {
        coordinates = feature.get('display_point').coordinates;
        console.log(feature.get('display_point').coordinates);
      }
    });
    const coord4326 = [coordinates[1], coordinates[0]];
    const coord3857 = transform(coord4326, "EPSG:4326", "EPSG:3857");
    console.log(coord3857);

    global.map.getView().animate({
        center: coord3857, // Set center to the feature's coordinates
        zoom: 22, // Adjust zoom level as required
        duration: 1000 // Smooth animation (in milliseconds)
      }); 
    return;
  }