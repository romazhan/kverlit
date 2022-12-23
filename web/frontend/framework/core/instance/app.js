class App {
    constructor(mapper = null) {
        this._mapper = mapper;
    }

    _initMapper() {
        if(!this._mapper) return;

        this._mapper.init();
    }

    init() {
        this._initMapper();
    }
}

export { App };
