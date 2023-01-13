import {
    router, getUrlPath, httpGet, delegate
} from '../utils/index.js';

import { createKvelement } from './kvelement.js';

class Mapper {
    constructor(map) {
        this._map = map;
        this._root = null;
    }

    mount(element) {
        this._root = element;

        return this;
    }

    init() {
        if(!this._root) throw Error('Mapper: root element is not defined');

        this._bindPopState();
        this._handleCurrentUrl();
    }

    _bindPopState() {
        window.addEventListener('popstate', () => this._handleCurrentUrl());
    }

    _handleCurrentUrl() {
        const url = getUrlPath();
        this._handleUrl(url);
    }
    
    _handleUrl(url) {
        const mapPath = this._getMapPath(url);
        if(!mapPath) return;

        this._createPageKvelement(mapPath);
    }

    _getMapPath(url) {
        return this._map[url] || this._map['404'] || null;
    }

    async _createPageKvelement(mapPath) {
        const pageContent = await httpGet(mapPath.template);

        const kvelement = createKvelement(mapPath.name, pageContent, {
            click: this._clickHandler()
        });

        this._root.innerHTML = kvelement.tag;
    }

    _clickHandler() {
        return delegate('a', e => {
            e.preventDefault();
            
            const url = e.target.getAttribute('href');
            // if(url === getUrlPath()) return; // CRUTCH

            router.navigate(url);
        })
    }
};

export { Mapper };
