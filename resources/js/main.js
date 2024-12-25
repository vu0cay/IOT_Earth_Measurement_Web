import { global } from './map/init/global';
import { setMapLevel } from './map/levelSelector/itemsOnLevel';
import { toggleSidePanel } from './map/functions/onClick/sidePanel';
import { highlightFeature } from './lib/map/onClick/hightLight';
import { popUp } from './map/functions/onClick/popUp';

import './style.css'


export const Panel = {
  sidePanel : document.getElementById('side-panel'),
  sidePanelContent : document.getElementById('side-panel-content'),
  closeBtn : document.getElementById('close-btn')
};
const floorSelector = document.getElementById('floor-select');


//side panel close button
Panel.closeBtn.onclick= function () {
  Panel.sidePanel.style.right = '-400px';
};

//click events


const content = document.getElementById('popup-content');
const closer = document.getElementById('popup-closer');

console.log('Attaching map click event...');
global.map.on('click', async function (evt) {
    // console.log(1);
  highlightFeature(evt);
  // toggleSidePanel(evt);

  await popUp(evt);
});
global.map.on('click', function (evt) {
    // console.log(1);
  console.log("vhc");
});

closer.onclick = function () {
    console.log("hi");
    global.overlay.setPosition(undefined);
    closer.blur();
    return false;
  };
setMapLevel(0);
 //floor change
floorSelector.addEventListener('change', function (event) {
    setMapLevel(event.target.value);
});

/*
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

 */


