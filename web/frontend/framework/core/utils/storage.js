const storage = (prefix => {
    const storageWindowObj = window[`${prefix}Storage`] = {
        get: key => storageWindowObj.storage[key] || null,

        set: (key, value) => storageWindowObj.storage[key] = value,

        remove: key => delete storageWindowObj.storage[key],

        storage: {}
    };

    return storageWindowObj;
})(`__${Math.random().toString(36)}`);

export { storage };
