const router = (() => {
    const navigate = url => {
        window.history.pushState({}, '', url);
        window.dispatchEvent(new Event('popstate'));
    };

    return {navigate};
})();

export { router };
