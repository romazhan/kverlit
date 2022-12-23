const getUrlPath = () => window.location.pathname;

const setUrl = url => window.history.pushState(null, '', url);

export { getUrlPath, setUrl };
