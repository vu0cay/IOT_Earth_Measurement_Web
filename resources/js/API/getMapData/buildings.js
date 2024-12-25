import IMDFGeoJSON from '../../map/custom/IMDFGeoJSON';

let CACHED_BUILDINGS_IMDFGeoJSON = null;

export async function createBuildingSource() {
    if (CACHED_BUILDINGS_IMDFGeoJSON) {
        return CACHED_BUILDINGS_IMDFGeoJSON;
    }

    try {
        const response = await fetch('http://127.0.0.1:8000/api/buildings');
        const data = await response.json();

        const format = new IMDFGeoJSON();
        CACHED_BUILDINGS_IMDFGeoJSON = format.readFeatures(data, {
            featureProjection: 'EPSG:4326',
        });

        return CACHED_BUILDINGS_IMDFGeoJSON;
    } catch (error) {
        console.error('Error creating unit source:', error);
        throw error;
    }
}
