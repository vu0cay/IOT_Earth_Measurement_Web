import IMDFGeoJSON from '../../map/custom/IMDFGeoJSON';

let CACHED_ANCHORS_IMDFGeoJSON = null;

export async function createAnchorSource() {
    if (CACHED_ANCHORS_IMDFGeoJSON) {
        return CACHED_ANCHORS_IMDFGeoJSON;
    }

    try {
        const response = await fetch('http://127.0.0.1:8000/api/anchors');
        const data = await response.json();

        const format = new IMDFGeoJSON();
        CACHED_ANCHORS_IMDFGeoJSON = format.readFeatures(data, {
            featureProjection: 'EPSG:4326',
        });

        return CACHED_ANCHORS_IMDFGeoJSON;
    } catch (error) {
        console.error('Error creating unit source:', error);
        throw error;
    }
}
