
import { Panel } from "../../../main";
import { global } from "../../../map/init/global";
import { getSensorInfos } from "../../../API/sensorThings/getSensorInfos";
//import { zoomInto } from "../functions/zoom";


export function toggleSidePanel(evt) {

    let foundFeature = null;
    global.map.forEachFeatureAtPixel(evt.pixel, function (feature, layer) {
      if (layer === global.anchors) {
        // Handle icon click

        foundFeature = feature;
        //sensorInfos = getSensorInfos(foundFeature.getId());
        return true; // Stop checking other layers
      }
/*       if (layer === global.units) {
        // Handle room click
        console.log("Room");
        foundFeature = feature;
      } */
    })


        if (foundFeature) {
          var panelContent;
          //console.log(foundFeature.getProperties());
          if (String(foundFeature.get('feature_type')) === "anchor") {
            panelContent = '<h3>Sensor</h3>';
            panelContent += '<p>- ID: ' + foundFeature.getId() + '</p>';
            panelContent += '<p>- feature_type: ' + foundFeature.get('feature_type') + '</p>';
            panelContent += '<p>- address_id: ' + foundFeature.get('address_id') + '</p>';
            panelContent += '<p>- unit_id: ' + foundFeature.get('unit_id') + '</p>';
            panelContent += '<p>- Geometry Type: ' + foundFeature.getGeometry().getType() + '</p>';
            panelContent += '<p>- Coordinates: ' + JSON.stringify(foundFeature.getGeometry().getCoordinates()) + '</p>';
          }
          else if (String(foundFeature.getGeometry().getType()) === "Polygon") {
            panelContent = '<h1>' + foundFeature.get('name').vi + '</h1>';
            panelContent += '<p>- ID: ' + foundFeature.getId() + '</p>';
            panelContent += '<p>- feature_type: ' + foundFeature.get('feature_type') + '</h3>';
            panelContent += '<p>- address_id: ' + foundFeature.get('address_id') + '</p>';
            panelContent += '<p>- Category: ' + foundFeature.get('category') + '</p>';
            panelContent += '<p>- Level ID: ' + foundFeature.get('level_id') + '</p>';
            panelContent += '<p>- Geometry Type: ' + foundFeature.getGeometry().getType() + '</p>';
            panelContent += '<p>- Coordinates: ' + JSON.stringify(foundFeature.getGeometry().getCoordinates()) + '</p>';
          }

          Panel.sidePanelContent.innerHTML = panelContent;
          Panel.sidePanel.style.right = '0px';
        } else {
          Panel.sidePanel.style.right = '-400px';
        }
        return;
}
