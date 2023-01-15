import { httpGet } from '../utils/index.js';
import { createKvelement } from './kvelement.js';

class App {
    constructor(mapper = null, kvelements = {}) {
        this._mapper = mapper;
        this._kvelements = kvelements;
    }

    init(onInit = () => {}) {
        this._initKvelements();
        this._initMapper();

        onInit();
    }

    _initMapper() {
        if(!this._mapper) return;

        this._mapper.init();
    }

    async _initKvelements() {
        if(!this._kvelements) return;

        Object.keys(this._kvelements).forEach(async kvelementName => {
            const kvelementContent = await httpGet(this._kvelements[kvelementName]);

            createKvelement(kvelementName, kvelementContent);
        });
    }
}

export { App };
