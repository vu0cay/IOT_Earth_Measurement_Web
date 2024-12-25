import VectorSource from 'ol/source/Vector.js';
import VectorLayer from 'ol/layer/Vector';
import { Fill, Stroke, Style} from 'ol/style';

import IMDFGeoJSON from '../custom/IMDFGeoJSON';


import { createAddressSource } from '../../API/getMapData/addresses';
import { createAmenitySource } from '../../API/getMapData/amenities';
import { createAnchorSource } from '../../API/getMapData/anchors';
import { createBuildingSource } from '../../API/getMapData/buildings';
import { createFootprintSource } from '../../API/getMapData/footprints';
import { createLevelSource } from '../../API/getMapData/levels';
import { createVenueSource } from '../../API/getMapData/venues';
import { createUnitSource } from '../../API/getMapData/units';
import { createOpeningSource } from '../../API/getMapData/openings';
import { venueStyle, anchorStyle, levelStyle, openingStyle } from '../custom/mapStyles';
import { getUnitStyle, getAmenityStyle } from '../custom/mapStyles';


export const IMDFData = {
    addresses: await createAddressSource(),
    amenities: await createAmenitySource(),
    anchors: await createAnchorSource(),
    buildings: await createBuildingSource(),
    footprints: await createFootprintSource(),
    levels: await createLevelSource(),
    venues: await createVenueSource(),
    units: await createUnitSource(),
    openings: await createOpeningSource(),
};



export const sources = {
    anchors: new VectorSource({
        features: IMDFData.anchors
    }),
    buildings: new VectorSource({
        features: IMDFData.buildings
    }),
    footprints: new VectorSource({
        features: IMDFData.footprints
    }),
    levels: new VectorSource({
        features: IMDFData.levels
    }),
    venues: new VectorSource({
        features: IMDFData.venues
    }),
    units: new VectorSource({
        features: IMDFData.units
    }),
    amenities: new VectorSource({
        features: IMDFData.amenities
    }),
    openings: new VectorSource({
        features: IMDFData.openings
    })
};

export const layers = {
    anchors: new VectorLayer({
        source: sources.anchors,
        style: anchorStyle,
    }),
    buildings: new VectorLayer({
        source: sources.buildings,
        style: anchorStyle,
    }),
    footprints: new VectorLayer({
        source: sources.footprints,
        style: levelStyle,
    }),
    levels: new VectorLayer({
        source: sources.levels,
        style: levelStyle,
    }),
    venues: new VectorLayer({
        source: sources.venues,
        style: venueStyle,
    }),
    units: new VectorLayer({
        source: sources.units,
        style: getUnitStyle,
    }),
    amenities: new VectorLayer({
        source: sources.amenities,
        style: getAmenityStyle,
    }),
    openings: new VectorLayer({
        source: sources.openings,
        style: openingStyle,
    })
};


