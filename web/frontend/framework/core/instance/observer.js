class Observer extends MutationObserver {
    constructor() {
        super(mutations => {
            mutations.forEach(mutation => this._handleMutation(mutation));
        });

        this._attributeHandlers = [];
    }
    
    pushAttributeHandler(callback) {
        this._attributeHandlers.push(callback);
    }

    _handleMutation(mutation) {
        switch(mutation.type) {
            case 'attributes':
                const {attributeName, target} = mutation;
                const newValue = target.getAttribute(attributeName);

                this._attributeHandlers.forEach(h => h(attributeName, newValue));

                break;
        }
    }
}

export { Observer };
