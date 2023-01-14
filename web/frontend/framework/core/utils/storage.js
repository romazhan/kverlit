const storage = (prefix => {
    const storageObj = window[`${prefix}Storage`] = {
        set: (key, value) => storageObj[key] = value,

        get: key => storageObj[key] || null,
    
        remove: key => delete storageObj[key]
    };

    return storageObj;
})(`__${Math.random().toString(36)}`);

export { storage };
