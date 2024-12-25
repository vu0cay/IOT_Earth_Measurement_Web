/* import GeoJSON from 'ol/format/GeoJSON.js';
import VectorLayer from 'ol/layer/Vector.js';
import VectorSource, { VectorSourceEvent } from 'ol/source/Vector.js';
import { Map, View } from 'ol';
import TileLayer from 'ol/layer/Tile';
import { Icon } from 'ol/style.js';
import { Fill, Stroke, Style } from 'ol/style';
import OSM from 'ol/source/OSM';

import { room } from "./features/unit";
import IMDFGeoJSON from './custom/IMDFGeoJSON';
import { filterRoomsByFloor } from './functions/fillterRoom';

const geojsonFeature = `{
  "type": "FeatureCollection",
  "features": [
    {
      "id": "11111111-1111-1111-1111-111111111112",
      "type": "Feature",
      "feature_type": "anchor",
      "geometry": {
        "type": "Point",
        "coordinates": [
          11774154.073719107, 1122426.0055894663
        ]
      },
      "properties": {
        "address_id": "11111111-1111-1111-1111-111111111111",
        "unit_id": "5f7c0d66-1d1a-49cf-8c80-74b72cd18a08"
      }
    }
  ],
  "crs": {
        "type": "name",
        "properties": {
            "name": "urn:ogc:def:crs:EPSG::404000"
        }
    }
}`


export const anchorVectorSource = new VectorSource({
  features: new IMDFGeoJSON().readFeatures(geojsonFeature, {
    featureProjection: 'EPSG:4326' // Ensure the coordinates are in the correct projection
  }),
});
anchorVectorSource.forEachFeature(function (feature) {
      console.log(feature.get('feature_type'));
  });

  const sensorIconUrl = '/sensor.svg'

const anchors = new VectorLayer({
  source: anchorVectorSource,
  style: new Style({
    image: new Icon({
    //  crossOrigin: 'anonymous',
      scale: 0.05,
      src: sensorIconUrl,

    }),
  })
});


const global = {
  selectedFeature: null,

  room: room,

  anchors: anchors,

  map: null
};

global.map = new Map({
  layers: [
    new TileLayer({
      source: new OSM(),
    }),
    global.room,
    global.anchors
  ],
  target: 'map',
  view: new View({
    center: [11774144.287902, 1122409.9996554],
    zoom: 20
  })
});

/* window.onload = function() {
  const floorSelector = document.getElementById('floor-select');
  floorSelector.value = 'c8c333cd-764b-49c8-aae0-34628489b209';
  floorSelector.dispatchEvent(new Event('change'));
}; */
//export { global };
// */
