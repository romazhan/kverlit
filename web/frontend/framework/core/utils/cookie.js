const cookie = (() => {
    const get = name => {
        const cookie = document.cookie.split(';').find(c => c.trim().startsWith(`${name}=`));
        return cookie ? cookie.split('=')[1] : null;
    };

    const set = (name, value, days = 30) => document.cookie = `${name}=${value}; expires=${
        new Date(Date.now() + days * 864e5).toUTCString()
    }; path=/`;

    const remove = name => set(name, '', -1);

    return {get, set, remove};
})();

export { cookie };
