const encodeData = data => Object.keys(data).reduce(
    (pV, cV) => `${pV}${cV}=${encodeURIComponent(data[cV])}&`,
'');

const http = (method, url, data = {}) => new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();

    xhr.open(method, url, true);
    xhr.setRequestHeader(
        'Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8'
    );

    xhr.onload = () => {
        let res = xhr.response;

        try {
            res = JSON.parse(res);
        } catch(_) {}

        if(xhr.status >= 200 && xhr.status < 300) {
            return resolve(res);
        }

        return reject(res);
    };

    xhr.onerror = () => reject(xhr.statusText);

    xhr.send(encodeData(data));
});

const httpGet = url => http('GET', url);

const httpPost = (url, data = {}) => http('POST', url, data);

export { httpGet, httpPost };
