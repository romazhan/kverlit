const router = (() => {
    const navigate = url => {
        window.history.pushState({}, '', url);
        window.dispatchEvent(new Event('popstate'));
    };

    const replace = url => window.location.replace(url);

    return {navigate, replace};
})();

export { router };
