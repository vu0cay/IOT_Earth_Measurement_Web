import VectorSource from 'ol/source/Vector';
import { global } from '../global';
import { roomGEOJSON } from '../features/unit';
import { anchorVectorSource } from '../global';

export function filterRoomsByFloor(floor) {
    let filteredRooms = [];
    roomGEOJSON.forEachFeature(function (feature) {
      if (String(feature.get('level_id')) === String(floor)) {
        filteredRooms.push(feature);
      }
    });
  
    let filteredSource = new VectorSource({
      features: filteredRooms
    });

    let filteredAnchor = [];
    anchorVectorSource.forEachFeature(function (feature) {
      filteredSource.forEachFeature(function (f) {
        //console.log("unit_id: " + feature.get('unit_id'));
        console.log("id: " + f.getId());

        if (String(feature.get('unit_id')) === String(f.getId())) {
          console.log("GOT INNNNN");
          console.log(feature.get('unit_id'));
          console.log(f.getId());
          filteredAnchor.push(feature);
        }
      })
    });

    let filteredAnchorSource = new VectorSource({
      features: filteredAnchor
    })
    global.room.setSource(filteredSource);
    global.anchors.setSource(filteredAnchorSource);
    return true;
  }