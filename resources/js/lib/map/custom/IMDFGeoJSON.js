import GeoJSON from "ol/format/GeoJSON";

class IMDFGeoJSON extends GeoJSON {
        constructor(options) {
            console.log('IMDFGeoJSON constructor called with options:', options);
            super(options);
        }
        dsafdsfadfdadfaf
/*     readFeatures(object, opt_options) {
      const features = super.readFeatures(object, opt_options);

      // Manually add `feature_type` to each feature if it exists in the GeoJSON
      object.features.forEach((geojsonFeature, index) => {
        if (geojsonFeature.feature_type) {
          features[index].set('feature_type', geojsonFeature.feature_type);
        }
      });
      return features;
    } */

      readFeatures(object, opt_options) {
        console.log('IMDFGeoJSON readFeatures called with object:', object);
        // Call the parent class readFeatures method to get features
        const JSONobject = JSON.parse(object);
        console.log('IMDFGeoJSON readFeatures called with JSONobject:', JSONobject);
        const features = super.readFeatures(object, opt_options);

        // Check if object is structured as expected
        if (JSONobject && Array.isArray(JSONobject.features)) {
            JSONobject.features.forEach((geojsonFeature, index) => {
                if (geojsonFeature.feature_type) {
                    features[index].set('feature_type', geojsonFeature.feature_type);
                }
            });
        } else {
            console.warn('GeoJSON JSONobject structure is unexpected:', JSONobject);
        }

        return features;
    }
  }

  export default IMDFGeoJSON;
