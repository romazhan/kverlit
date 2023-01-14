const pubsub = (prefix => {
    const pubsubWindowObj = window[`${prefix}Pubsub`] = {
        pub: (eventName, data = {}) => {
            if(!pubsubWindowObj.events[eventName]) return;

            pubsubWindowObj.events[eventName].forEach(e => {
                e.callback(data);
                e.isDisposable && pubsubWindowObj.unsub(eventName, e.callback);
            });
        },

        sub: (eventName, callback, isDisposable = false) => {
            if(!pubsubWindowObj.events[eventName]) {
                pubsubWindowObj.events[eventName] = [];
            }

            pubsubWindowObj.events[eventName].push({
                callback, isDisposable
            });
        },

        unsub: (eventName, callback) => {
            if(!pubsubWindowObj.events[eventName]) return;

            pubsubWindowObj.events[eventName] = pubsubWindowObj.events[eventName]
                .filter(e => e.callback !== callback);
        },

        events: {}
    };

    return pubsubWindowObj;
})(`__${Math.random().toString(36)}`);

export { pubsub };
