import IMDFGeoJSON from '../../map/custom/IMDFGeoJSON';

let CACHED_FOOTPRINTS_IMDFGeoJSON = null;

export async function createFootprintSource() {
    if (CACHED_FOOTPRINTS_IMDFGeoJSON) {
        return CACHED_FOOTPRINTS_IMDFGeoJSON;
    }

    try {
        const response = await fetch('http://127.0.0.1:8000/api/footprints');
        const data = await response.json();

        const format = new IMDFGeoJSON();
        CACHED_FOOTPRINTS_IMDFGeoJSON = format.readFeatures(data, {
            featureProjection: 'EPSG:4326',
        });

        return CACHED_FOOTPRINTS_IMDFGeoJSON;
    } catch (error) {
        console.error('Error creating unit source:', error);
        throw error;
    }
}
