import { Fill, Stroke, Style} from 'ol/style';

import { global } from '../../../map/init/global';



const highlightStyle = new Style({
    stroke: new Stroke({
      color: 'rgba(190,190,190,1)',
      width: 1,
    }),
    fill: new Fill({
      color: 'rgba(108, 235, 237, 1)',
    }),
  });

export function highlightFeature(evt) {
    if (global.selectedFeature) {
      global.selectedFeature.setStyle(undefined);  // This is allowed
    }

    global.map.forEachFeatureAtPixel(evt.pixel, function (feature) {
      if (String(feature.getGeometry().getType()) === "Polygon") {
        global.selectedFeature = feature;  // Updating property is allowed
        feature.setStyle(highlightStyle);
      }
      return true;
    });
}
