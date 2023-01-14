const pubsub = (() => {
    const pub = (eName, data, target = document) => {
        const event = new CustomEvent(eName, {detail: data});
        target.dispatchEvent(event);
    };

    const sub = (eName, callback, target = document) => {
        target.addEventListener(eName, callback);
    };

    return { pub, sub };
})();

export { pubsub };
