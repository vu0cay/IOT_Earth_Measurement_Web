// import VectorSource from 'ol/source/Vector.js';
// import VectorLayer from 'ol/layer/Vector';
// import { Fill, Stroke, Style} from 'ol/style';
// import GeoJSON from 'ol/format/GeoJSON.js';
// import IMDFGeoJSON from '../custom/IMDFGeoJSON';

// export const roomGEOJSON = new VectorSource({
//     url: 'http://127.0.0.1:9020/api/units',
//     format: new IMDFGeoJSON({
//         featureProjection: 'EPSG:4326'
//     }),
//   });

// /*   roomGEOJSON.on('addfeatures', function () {
//     console.log("Features loaded:");
//     roomGEOJSON.forEachFeature(function (feature) {
//       console.log(feature); // Log each feature after they are loaded
//     });
//   }); */

//   console.log("Room: ", roomGEOJSON);


// export const room = new VectorLayer({
//     source: roomGEOJSON,
//     style: new Style({
//         fill: new Fill({
//             color: 'rgba(80,180,250,0.5)',
//         }),
//         stroke: new Stroke({
//             color: 'gray',
//             width: 2,
//         })
//     })
// });
