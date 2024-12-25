
export async function search(queryString) {
  const response = await fetch(`http://127.0.0.1:8000/api/search?query=${queryString}`);
  const data = await response.json();
  console.log(data);
  return data;
}
