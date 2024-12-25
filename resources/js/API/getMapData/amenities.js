import IMDFGeoJSON from '../../map/custom/IMDFGeoJSON';

let CACHED_AMENITIES_IMDFGeoJSON = null;

export async function createAmenitySource() {
    if (CACHED_AMENITIES_IMDFGeoJSON) {
        return CACHED_AMENITIES_IMDFGeoJSON;
    }

    try {
        const response = await fetch('http://127.0.0.1:8000/api/amenities');
        const data = await response.json();

        const format = new IMDFGeoJSON();
        CACHED_AMENITIES_IMDFGeoJSON = format.readFeatures(data, {
            featureProjection: 'EPSG:4326',
        });

        return CACHED_AMENITIES_IMDFGeoJSON;
    } catch (error) {
        console.error('Error creating unit source:', error);
        throw error;
    }
}
