import { Map, View } from 'ol';
import TileLayer from 'ol/layer/Tile';
import OSM from 'ol/source/OSM';
import {Overlay} from 'ol';

import { layers } from './data';
/* const geojsonFeature = `{
    "type": "FeatureCollection",
    "features": [
        {
            "id": "5f7c0d66-1d1a-49cf-8c80-74b72cd18a00",
            "type": "Feature",
            "feature_type": "unit",
            "geometry": {
                "type": "Polygon",
                "coordinates": [
                    [
                        [
                            11774121.676852,
                            1122393.2313399
                        ],
                        [
                            11774133.689595,
                            1122407.0971625
                        ],
                        [
                            11774138.281527,
                            1122403.0667454
                        ],
                        [
                            11774134.277278,
                            1122398.4448055
                        ],
                        [
                            11774138.86921,
                            1122394.4143894
                        ],
                        [
                            11774130.860715,
                            1122385.1705118
                        ],
                        [
                            11774121.676852,
                            1122393.2313399
                        ]
                    ]
                ]
            },
            "properties": {
                "category": "room",
                "restriction": null,
                "accessibility": null,
                "name": {
                    "vi": "Thư viện",
                    "en": "Library"
                },
                "alt_name": null,
                "display_point": {
                    "type": "Point",
                    "coordinates": [
                        10.0310003,
                        105.7688155
                    ]
                },
                "level_id": "c8c333cd-764b-49c8-aae0-34628489b209"
            }
        },
        {
            "id": "5f7c0d66-1d1a-49cf-8c80-74b72cd18a01",
            "type": "Feature",
            "feature_type": "unit",
            "geometry": {
                "type": "Polygon",
                "coordinates": [
                    [
                        [
                            11774138.281527,
                            1122403.0667454
                        ],
                        [
                            11774142.873458,
                            1122399.0363283
                        ],
                        [
                            11774138.86921,
                            1122394.4143894
                        ],
                        [
                            11774134.277278,
                            1122398.4448055
                        ],
                        [
                            11774138.281527,
                            1122403.0667454
                        ]
                    ]
                ]
            },
            "properties": {
                "category": "room",
                "restriction": null,
                "accessibility": null,
                "name": {
                    "vi": "PHÒNG ĐÀO TẠO CHỨNG CHỈ TIN HỌC"
                },
                "alt_name": null,
                "display_point": {
                    "type": "Point",
                    "coordinates": [
                        10.031039,
                        105.768889
                    ]
                },
                "level_id": "c8c333cd-764b-49c8-aae0-34628489b209"
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
    fill: new Fill({
        color: 'rgba(80,180,250,0.5)',
    }),
    stroke: new Stroke({
        color: 'gray',
        width: 2,
    })
})
}); */

//const a = await unit();

const popup = document.getElementById('popup');
const global = {
  selectedFeature: null,

  amenities: layers.amenities ?? null,

  anchors: layers.anchors ?? null,

  building: layers.buildings ?? null,

  footprints: layers.footprints ?? null,

  levels: layers.levels ?? null,

  venue: layers.venues ?? null,

  units: layers.units ?? null,

  openings: layers.openings ?? null,

  overlay : new Overlay({
    element: popup,
    autoPan: {
      animation: {
        duration: 250,
      },
    },
  }),

  map: null
};

global.map = new Map({
  layers: [
    new TileLayer({
      source: new OSM(),
    }),
    global.venue,
    global.footprints,
    global.building,
    global.levels,
    global.units,
    global.amenities,
    global.anchors,
    global.openings
  ],
  overlays: [global.overlay],
  target: 'map',
  view: new View({
    // center: [11774144.287902, 1122409.9996554],
    center: [11774638.24804442,1123268.7034423382],
    zoom: 20
  })
});


export { global };
