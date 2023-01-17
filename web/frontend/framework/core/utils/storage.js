const storage = (prefix => {
    const storageWindowObj = window[`${prefix}Storage`] = {
        get: prop => storageWindowObj.storage[prop] || null,

        set: (prop, value) => storageWindowObj.storage[prop] = value,

        remove: prop => delete storageWindowObj.storage[prop],

        storage: {}
    };

    /*return new Proxy(storageWindowObj, {
        get: (target, prop) => target.get(prop),

        set: (target, prop, value) => target.set(prop, value),

        deleteProperty: (target, prop) => target.remove(prop)
    });*/

    return storageWindowObj;
})(`__${Math.random().toString(36)}`);

export { storage };
