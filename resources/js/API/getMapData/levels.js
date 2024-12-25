import IMDFGeoJSON from '../../map/custom/IMDFGeoJSON';

let CACHED_LEVELS_IMDFGeoJSON = null;

export async function createLevelSource() {
    if (CACHED_LEVELS_IMDFGeoJSON) {
        return CACHED_LEVELS_IMDFGeoJSON;
    }

    try {
        const response = await fetch('http://127.0.0.1:8000/api/levels');
        const data = await response.json();

        const format = new IMDFGeoJSON();
        CACHED_LEVELS_IMDFGeoJSON = format.readFeatures(data, {
            featureProjection: 'EPSG:4326',
        });

        return CACHED_LEVELS_IMDFGeoJSON;
    } catch (error) {
        console.error('Error creating unit source:', error);
        throw error;
    }
}
