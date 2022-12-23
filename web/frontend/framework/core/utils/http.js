const http = (method, url, data = {}) => new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();

    xhr.open(method, url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onload = () => {
        if(xhr.status >= 200 && xhr.status < 300) {
            resolve(xhr.response);
        } else {
            reject(xhr.statusText);
        }
    };

    xhr.onerror = () => reject(xhr.statusText);

    xhr.send(JSON.stringify(data));
});

const httpGet = url => http('GET', url);

const httpPost = (url, data = {}) => http('POST', url, data);

export { httpGet, httpPost };
