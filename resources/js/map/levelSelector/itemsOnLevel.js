import VectorSource from 'ol/source/Vector.js';

import { IMDFData } from "../init/data";
import { global } from "../init/global";
import { isNullOrUndef } from 'chart.js/helpers';

export async function setMapLevel(ordinal) {
    const level = await levelOnOrdinal(ordinal);
    const levelsource = new VectorSource({
        features: level
    });


    let units = [];
    level.forEach(function (l) {
        units = units.concat(IMDFData.units.filter(unit => unit.values_.level_id === l.id_));
    });
    const unitsource = new VectorSource({
        features: units
    });


    let anchors = [];
    units.forEach(function (u) {
        anchors = anchors.concat(IMDFData.anchors.filter(anchor => anchor.values_.unit_id === u.id_));
    });
    const anchorsource = new VectorSource({
        features: anchors
    });
    
        console.log(IMDFData.amenities);
        let amenities = [];
        units.forEach(function (u) {
            amenities = amenities.concat(IMDFData.amenities.filter(amenity => amenity.values_.unit_ids[0] === u.id_));
        });
        const amenitiesource = new VectorSource({
            features: amenities
        });
    


    let openings = [];
    level.forEach(function (l) {
        openings = openings.concat(IMDFData.openings.filter(opening => opening.values_.level_id === l.id_));
    });
    const openingsource = new VectorSource({
        features: openings
    });



    global.levels.setSource(levelsource);
    global.units.setSource(unitsource);
    global.anchors.setSource(anchorsource);
    global.amenities.setSource(amenitiesource);
    global.openings.setSource(openingsource);
    //return unit;
}


async function levelOnOrdinal(ordinal) {
    return IMDFData.levels.filter(level => String(level.values_.ordinal) === String(ordinal));
}




