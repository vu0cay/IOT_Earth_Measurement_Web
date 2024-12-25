import { Map, View } from 'ol';
import TileLayer from 'ol/layer/Tile';
import OSM from 'ol/source/OSM';

import { global } from './lib/map/global';
import { filterRoomsByFloor } from './lib/map/functions/fillterRoom';
import {highlightFeature} from './lib/map/onClick/hightLight';
import {roomGEOJSON} from './lib/map/features/unit';

import './style.css'
import { toggleSidePanel } from './lib/map/onClick/sidePanel';
import { search } from './lib/API/Search';
import { zoomInto } from './lib/map/functions/zoom';
import { Zoomify } from 'ol/source';
/* const vectorLayer = new VectorLayer({
  source: new VectorSource({
    url: 'https://geoserver.ctu.edu.vn/geoserver/ctu/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=ctu%3Acantho_university_units&maxFeatures=50&outputFormat=application%2Fjson',
    format: new GeoJSON(),
*/
export const Panel = {
  sidePanel : document.getElementById('side-panel'),
  sidePanelContent : document.getElementById('side-panel-content'),
  closeBtn : document.getElementById('close-btn')
};
const floorSelector = document.getElementById('floor-select');


//side panel close button
Panel.closeBtn.onclick = function () {
  Panel.sidePanel.style.right = '-400px';
};

//click events
global.map.on('click', function (evt) {
  highlightFeature(evt);
  toggleSidePanel(evt);
});

//floor change
floorSelector.addEventListener('change', function (event) {
  const selectedFloor = String(event.target.value);
  filterRoomsByFloor(selectedFloor);
});


//search bar

const searchBar = document.getElementById('search-bar');
const dropdown = document.getElementById('dropdown');
// Simulating the API function
function debounceAsync(func, delay) {
  let timer;
  let inDebounce = false;

  return async function (...args) {
      clearTimeout(timer);
      timer = setTimeout(async () => {
          if (!inDebounce) {
              console.log("Debounce triggered");
              inDebounce = true;
              await func.apply(this, args);
              console.log("Debounce function completed");
              inDebounce = false;
          }
      }, delay);
  };
}

// Event listener for input changes
//searchBar.replaceWith(searchBar.cloneNode(true));
searchBar.addEventListener('input', debounceAsync(async (e) => {
  const query = e.target.value.trim();
  dropdown.innerHTML = ''; // Clear previous results
  if (query) {
      const results = await search(query); // Call the API
      if (results.length) {
          dropdown.style.display = 'block';
          results.forEach(item => {
              const div = document.createElement('div');
              div.textContent = item.value;
              div.addEventListener('click', () => {
                  searchBar.value = item.value; // Update the search bar
                  zoomInto(item.feature_id);
                  dropdown.style.display = 'none'; // Hide the dropdown
              });
              dropdown.appendChild(div);
          });
      } else {
          dropdown.style.display = 'none'; // Hide if no results
      }
  } else {
      dropdown.style.display = 'none'; // Hide if query is empty
  }
}, 500));

// Hide dropdown when clicking outside
document.addEventListener('click', (e) => {
  if (!e.target.closest('.search-container')) {
      dropdown.style.display = 'none';
  }
});



class ImdfArchrive {
    static load() {
        const files = ["anchor", "amenity"]

        function fetchFeatureCollection(name){
            return fetch(`venue/${name}.geojson`).then(res => res.json())
        }

        return Promise.all(files.map(fetchFeatureCollection))
        .then(featureCollections => {
            const fetures = [];
            featureCollections.forEach(featureCollection => {
                features.push(...featureCollection.features)
            })
            return new ImdfArchrive(features)
        })
        }

        constructor(features) {
            this.features = features
            this.featureById = {};
            this.feaetureByType = {};
            features.forEach(feature => {
                this.featureById[feature.id] = feature;
                this.feaetureByType[feature.feature_type] =
                        this.feaetureByType[feature.feature_type] || [];
                this.feaetureByType[feature.feature_type].push(feature);
            })

        }
}
