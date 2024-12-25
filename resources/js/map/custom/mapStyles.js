import { scale } from 'ol/coordinate';
import { Fill, Stroke, Style} from 'ol/style';
import { Icon } from 'ol/style.js';


const unitStyles = {
    default: {
        fillColor : 'rgba(230,230,230,1)',
        strokeColor : 'rgba(190,190,190,1)',
    },
    room: {
        fillColor : 'rgba(238,238,238,1)',
        strokeColor : 'rgba(190,190,190,1)',
    },
    restroom: {
        fillColor : 'rgba(231,220,237,1)',
    },
    "restroom.female": {
        fillColor : 'rgba(231,220,237,1)',
    },
    "restroom.male": {
        fillColor : 'rgba(231,220,237,1)',
    },
    stairs: {
        fillColor : 'rgba(205,220,229,1)',
    },
    storage: {
        fillColor : 'rgba(210,210,210,1)',
    },
    unenclosedarea: {
        fillColor : 'rgba(80,180,250,0.1)',
    },
    walkway: {
        fillColor : 'rgba(0,0,0,0)',
    }

}

export function getUnitStyle(feature) {
    const unitCategory = feature.get('category');

    const newStyle = unitStyles[unitCategory] || unitStyles.default;
    return new Style({
        fill: new Fill({
            color: newStyle.fillColor,
        }),
        stroke: new Stroke({
            color: unitStyles.default.strokeColor,
            width: 1,
        }),
    })
}


const amenityStyles = {
    default: {
        iconUrl: './eye.png',
        scale: 0.1
    },
    stairs: {
        iconUrl: './stairs.png',
        scale: 0.05
    }
  }

export function getAmenityStyle(feature) {
    const amenityCategory = feature.get('category');

    const newStyle = amenityStyles[amenityCategory] || amenityStyles.default;

    return new Style({
        image: new Icon({
          crossOrigin: 'anonymous',
          scale: newStyle.scale,
          src: newStyle.iconUrl,
        }),
      })
}


export const venueStyle = new Style({
    fill: new Fill({
        color: 'rgba(80,180,250,0.1)',
    }),
    stroke: new Stroke({
        color: 'gray',
        width: 2,
    }),
});

export const levelStyle = new Style({
    fill: new Fill({
        color: 'white',
    }),
    stroke: new Stroke({
        color: 'rgba(190,190,190,1)',
        width: 2,
    }),
})

export const openingStyle = new Style({
    stroke: new Stroke({
        color: 'white',
        width: 4,
    }),
})

export const anchorStyle = new Style({
    image: new Icon({
      crossOrigin: 'anonymous',
      scale: 0.1,
      src: './sensor.png',
    }),
  })


