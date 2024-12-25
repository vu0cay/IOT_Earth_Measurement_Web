const fetchWithToken = async (url) => {
    const response = await fetch(url);
    if (!response.ok) {
    throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
  };

const getSensorId = async (anchor_id) => {
    const url = `http://127.0.0.1:8080/sensorids/${anchor_id}`;
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
}


export const getSensorInfos = async (anchor_id) => {
    const res = await getSensorId(anchor_id);
    const getSensorthingInfosurl = `http://sensingapi.cusc.vn/api/get/sensors(${res.sensor_id})`;
    const response = await fetchWithToken(getSensorthingInfosurl);
    return response.value[0];
}

// export const getSensorData = async (sensor_id) => {
export const getSensorData = async () => {
    
    const getSensorthingInfosurl = `http://127.0.0.1:8080/api/sensorthings/observations`;
    const response = await fetchWithToken(getSensorthingInfosurl);
    // console.log(response.value);
    return response.value;
    
}


//// chart controller 
export const getAllObservations = async (sensor_id) => {

  const getSensorthingInfosurl = `http://sensingapi.cusc.vn/api/get/sensors(${sensor_id})/datastreams/observations?$top=500&$order=id desc`;
  const response = await fetchWithToken(getSensorthingInfosurl);
  // console.log(response.value);

  return response.value;
}